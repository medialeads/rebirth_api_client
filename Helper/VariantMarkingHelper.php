<?php

namespace ES\APIv2Client\Helper;

use ES\APIv2Client\Model\DynamicFixedPrice;
use ES\APIv2Client\Model\DynamicVariablePrice;
use ES\APIv2Client\Model\DynamicVariablePriceHolder;
use ES\APIv2Client\Model\StaticFixedPrice;
use ES\APIv2Client\Model\StaticVariablePrice;
use ES\APIv2Client\Model\StaticVariablePriceHolder;
use ES\APIv2Client\Model\SupplierProfileInterface;
use ES\APIv2Client\Model\CalculatedPrice;
use ES\APIv2Client\Model\VariantMarking;
use ES\APIv2Client\Model\VariantMarkingModel;
use ES\APIv2Client\Model\VariantSimpleMarkingCalculatedPrice;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class VariantMarkingHelper
{
    /**
     * @param VariantMarking $classVariantMarking
     * @param SupplierProfileInterface $supplierProfile
     * @param int $quantity
     * @param VariantMarkingModel $variantMarkingModel
     *
     * @return CalculatedPrice
     */
    public static function getCalculatedPrice(VariantMarking $classVariantMarking, SupplierProfileInterface $supplierProfile, $quantity, VariantMarkingModel $variantMarkingModel)
    {
        $variantMarking = $variantMarkingModel->getVariantMarking();
        if (!$variantMarking instanceof VariantMarking) {
            throw new \UnexpectedValueException($variantMarking, VariantMarking::class);
        }

        $variantMarkingOptionsValues = (array) $variantMarking;

        $expressionLanguage = new ExpressionLanguage();
        $calculatedPrice = new VariantSimpleMarkingCalculatedPrice();

        $isTotalPrice = true;

        foreach (array_merge($classVariantMarking->getDynamicFixedPrices()->filter(function (DynamicFixedPrice $variantSimpleMarkingDynamicFixedPrice) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingDynamicFixedPrice->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingDynamicFixedPrice->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingDynamicFixedPrice->getCondition(), $variantMarkingOptionsValues));
        })->toArray(), $classVariantMarking->getDynamicFixedPrices()->filter(function (StaticFixedPrice $variantSimpleMarkingStaticFixedPrice) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingStaticFixedPrice->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingStaticFixedPrice->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingStaticFixedPrice->getCondition(), $variantMarkingOptionsValues));
        })->toArray()) as $variantSimpleMarkingFixedPrice) {
            if ($variantSimpleMarkingFixedPrice instanceof DynamicFixedPrice) {
                $value = floatval($expressionLanguage->evaluate($variantSimpleMarkingFixedPrice->getCalculationValue(), $variantMarkingOptionsValues));
            } elseif ($variantSimpleMarkingFixedPrice instanceof StaticFixedPrice) {
                $value = $quantity * $variantSimpleMarkingFixedPrice->getCalculationValue();
            } else {
                throw new \LogicException();
            }

            if ($value < 0.0) {
                $calculatedPrice->setValue(null);

                return $calculatedPrice;
            }

            $calculatedPrice->addValue($value);

            $isTotalPrice = $isTotalPrice && $variantSimpleMarkingFixedPrice->isTotalPrice();
        }

        foreach (array_merge($classVariantMarking->getDynamicVariablePriceHolders()->filter(function (DynamicVariablePriceHolder $variantSimpleMarkingDynamicVariablePriceHolder) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingDynamicVariablePriceHolder->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingDynamicVariablePriceHolder->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingDynamicVariablePriceHolder->getCondition(), $variantMarkingOptionsValues));
        })->toArray(), $classVariantMarking->getStaticVariablePriceHolders()->filter(function (StaticVariablePriceHolder $variantSimpleMarkingStaticVariablePriceHolder) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingStaticVariablePriceHolder->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingStaticVariablePriceHolder->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingStaticVariablePriceHolder->getCondition(), $variantMarkingOptionsValues));
        })->toArray()) as $variantSimpleMarkingVariablePriceHolder) {
            $value = null;

            if ($variantSimpleMarkingVariablePriceHolder instanceof DynamicVariablePriceHolder) {
                $matchingVariantSimpleMarkingDynamicVariablePrice = null;
                /* @var DynamicVariablePrice $variantSimpleMarkingDynamicVariablePrice */
                foreach ($variantSimpleMarkingVariablePriceHolder->getDynamicVariablePrices()->filter(function (DynamicVariablePrice $variantSimpleMarkingDynamicVariablePrice) use ($quantity) {
                    return $variantSimpleMarkingDynamicVariablePrice->getFromQuantity() < $quantity;
                }) as $variantSimpleMarkingDynamicVariablePrice) {
                    if (!$matchingVariantSimpleMarkingDynamicVariablePrice instanceof DynamicVariablePrice || ($variantSimpleMarkingDynamicVariablePrice->getFromQuantity() > $matchingVariantSimpleMarkingDynamicVariablePrice->getFromQuantity())) {
                        $matchingVariantSimpleMarkingDynamicVariablePrice = $variantSimpleMarkingDynamicVariablePrice;
                    }
                }

                if ($matchingVariantSimpleMarkingDynamicVariablePrice instanceof DynamicVariablePrice) {
                    $value = floatval($expressionLanguage->evaluate($matchingVariantSimpleMarkingDynamicVariablePrice->getCalculationValue(), $variantMarkingOptionsValues));
                }
            } elseif ($variantSimpleMarkingVariablePriceHolder instanceof StaticVariablePriceHolder) {
                $matchingVariantSimpleMarkingStaticVariablePrice = null;
                /* @var StaticVariablePrice $variantSimpleMarkingStaticVariablePrice */
                foreach ($variantSimpleMarkingVariablePriceHolder->getStaticVariablePrices()->filter(function (StaticVariablePrice $variantSimpleMarkingStaticVariablePrice) use ($quantity) {
                    return $variantSimpleMarkingStaticVariablePrice->getFromQuantity() < $quantity;
                }) as $variantSimpleMarkingStaticVariablePrice) {
                    if (!$matchingVariantSimpleMarkingStaticVariablePrice instanceof StaticVariablePrice || ($variantSimpleMarkingStaticVariablePrice->getFromQuantity() > $matchingVariantSimpleMarkingStaticVariablePrice->getFromQuantity())) {
                        $matchingVariantSimpleMarkingStaticVariablePrice = $variantSimpleMarkingStaticVariablePrice;
                    }
                }

                if ($matchingVariantSimpleMarkingStaticVariablePrice instanceof StaticVariablePrice) {
                    $value = $quantity * $matchingVariantSimpleMarkingStaticVariablePrice->getCalculationValue();
                }
            } else {
                throw new \LogicException();
            }

            if (null === $value) {
                continue;
            }

            if ($value < 0.0) {
                $calculatedPrice->setValue(null);

                return $calculatedPrice;
            }

            $calculatedPrice->addValue($value);

            $isTotalPrice = $isTotalPrice && $variantSimpleMarkingVariablePriceHolder->isTotalPrice();
        }

        $calculatedPrice->setTotalPrice($isTotalPrice);

        return $calculatedPrice;
    }
}