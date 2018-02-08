<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthApiClient\Model\SupplierProfileInterface;
use ES\RebirthApiClient\Util\Model\CalculatedPrice;
use ES\RebirthApiClient\Util\Model\SelectedVariantMarking;

class VariantMarkingHelper
{
    /**
     * @param SelectedVariantMarking $selectedVariantMarking
     * @param SupplierProfileInterface $supplierProfile
     * @param int $quantity
     *
     * @return CalculatedPrice
     */
    public static function getCalculatedPrice(SelectedVariantMarking $selectedVariantMarking, SupplierProfileInterface $supplierProfile, $quantity)
    {
        $variantMarking = $variantMarkingModel->getVariantMarking();
        if (!$variantMarking instanceof VariantMarking) {
            throw new \UnexpectedValueException($variantMarking, VariantMarking::class);
        }

        $variantMarkingOptionsValues = array_merge($variantMarking->getOptionsValues(), $variantMarkingModel->getOptionsValues(), array(
            'quantite' => $quantity
        ));
        $expressionLanguage = new ExpressionLanguage();
        $calculatedPrice = new VariantSimpleMarkingCalculatedPrice();

        $isTotalPrice = true;

        foreach (array_merge(array_filter($variantMarking->getDynamicFixedPrices(), (function (DynamicFixedPrice $variantSimpleMarkingDynamicFixedPrice) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingDynamicFixedPrice->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingDynamicFixedPrice->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingDynamicFixedPrice->getCondition(), $variantMarkingOptionsValues));
        })), array_filter($variantMarking->getStaticFixedPrices(), (function (StaticFixedPrice $variantSimpleMarkingStaticFixedPrice) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingStaticFixedPrice->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingStaticFixedPrice->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingStaticFixedPrice->getCondition(), $variantMarkingOptionsValues));
        }))) as $variantSimpleMarkingFixedPrice) {
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

        foreach (array_merge(array_filter($variantMarking->getDynamicVariablePriceHolders(), (function (DynamicVariablePriceHolder $variantSimpleMarkingDynamicVariablePriceHolder) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingDynamicVariablePriceHolder->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingDynamicVariablePriceHolder->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingDynamicVariablePriceHolder->getCondition(), $variantMarkingOptionsValues));
        })), array_filter($variantMarking->getStaticVariablePriceHolders(), (function (StaticVariablePriceHolder $variantSimpleMarkingStaticVariablePriceHolder) use ($supplierProfile, $expressionLanguage, $variantMarkingOptionsValues) {
            return $variantSimpleMarkingStaticVariablePriceHolder->getSupplierProfile() === $supplierProfile &&
                (null === $variantSimpleMarkingStaticVariablePriceHolder->getCondition() ||
                    $expressionLanguage->evaluate($variantSimpleMarkingStaticVariablePriceHolder->getCondition(), $variantMarkingOptionsValues));
        }))) as $variantSimpleMarkingVariablePriceHolder) {
            $value = null;

            if ($variantSimpleMarkingVariablePriceHolder instanceof DynamicVariablePriceHolder) {
                $matchingVariantSimpleMarkingDynamicVariablePrice = null;
                /** @var DynamicVariablePrice $variantSimpleMarkingDynamicVariablePrice */
                foreach (array_filter($variantSimpleMarkingVariablePriceHolder->getDynamicVariablePrices(), (function (DynamicVariablePrice $variantSimpleMarkingDynamicVariablePrice) use ($quantity) {
                    return $variantSimpleMarkingDynamicVariablePrice->getFromQuantity() <= $quantity;
                })) as $variantSimpleMarkingDynamicVariablePrice) {
                    if (!$matchingVariantSimpleMarkingDynamicVariablePrice instanceof DynamicVariablePrice || ($variantSimpleMarkingDynamicVariablePrice->getFromQuantity() > $matchingVariantSimpleMarkingDynamicVariablePrice->getFromQuantity())) {
                        $matchingVariantSimpleMarkingDynamicVariablePrice = $variantSimpleMarkingDynamicVariablePrice;
                    }
                }

                if ($matchingVariantSimpleMarkingDynamicVariablePrice instanceof DynamicVariablePrice) {
                    $value = floatval($expressionLanguage->evaluate($matchingVariantSimpleMarkingDynamicVariablePrice->getCalculationValue(), $variantMarkingOptionsValues));
                }
            } elseif ($variantSimpleMarkingVariablePriceHolder instanceof StaticVariablePriceHolder) {
                $matchingVariantSimpleMarkingStaticVariablePrice = null;
                /** @var StaticVariablePrice $variantSimpleMarkingStaticVariablePrice */
                foreach (array_filter($variantSimpleMarkingVariablePriceHolder->getStaticVariablePrices(), (function (StaticVariablePrice $variantSimpleMarkingStaticVariablePrice) use ($quantity) {
                    return $variantSimpleMarkingStaticVariablePrice->getFromQuantity() <= $quantity;
                })) as $variantSimpleMarkingStaticVariablePrice) {
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
