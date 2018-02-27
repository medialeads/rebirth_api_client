<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthApiClient\Exception\NotImplementedException;
use ES\RebirthApiClient\Model\DynamicFixedPrice;
use ES\RebirthApiClient\Model\DynamicVariablePrice;
use ES\RebirthApiClient\Model\DynamicVariablePriceHolder;
use ES\RebirthApiClient\Model\StaticFixedPrice;
use ES\RebirthApiClient\Model\StaticVariablePrice;
use ES\RebirthApiClient\Model\StaticVariablePriceHolder;
use ES\RebirthApiClient\Model\SupplierProfileInterface;
use ES\RebirthApiClient\Util\Model\SelectedVariantMarking;
use ES\RebirthApiClient\Util\Model\VariantMarkingCalculatedPrice;
use ES\RebirthCommon\VariantMarkingOptionsInterface;
use Money\Money;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class VariantMarkingHelper
{
    /**
     * @param SelectedVariantMarking $selectedVariantMarking
     * @param array $variables
     * @param SupplierProfileInterface $supplierProfile
     * @param int $quantity
     *
     * @return VariantMarkingCalculatedPrice
     */
    public static function getVariantMarkingCalculatedPrice(SelectedVariantMarking $selectedVariantMarking,
        array $variables, SupplierProfileInterface $supplierProfile, $quantity)
    {
        $variantMarkingCalculatedPrice = new VariantMarkingCalculatedPrice();

        $quantity = intval($quantity);
        // if the provided quantity is negative => on quote
        if ($quantity < 1) {
            return $variantMarkingCalculatedPrice;
        }

        $variantMarking = $selectedVariantMarking->getVariantMarking();
        // if the provided quantity is inferior than the variant marking minimum quantity => on quote
        if (null !== $variantMarking->getMinimumQuantity() && $quantity < $variantMarking->getMinimumQuantity()) {
            return $variantMarkingCalculatedPrice;
        }

        // if the provided quantity is superior than the variant marking maximum quantity => on quote
        if (null !== $variantMarking->getMaximumQuantity() && $quantity > $variantMarking->getMaximumQuantity()) {
            return $variantMarkingCalculatedPrice;
        }

        $expressionLanguage = new ExpressionLanguage();
        $dynamicFixedPrices = array_filter($variantMarking->getDynamicFixedPrices(),
            function (DynamicFixedPrice $dynamicFixedPrice) use ($variables, $supplierProfile, $expressionLanguage) {
                return $dynamicFixedPrice->getSupplierProfile()->getId() === $supplierProfile->getId() &&
                    (null === $dynamicFixedPrice->getCondition() ||
                    $expressionLanguage->evaluate($dynamicFixedPrice->getCondition(), $variables));
        });
        $staticFixedPrices = array_filter($variantMarking->getStaticFixedPrices(),
            function (StaticFixedPrice $staticFixedPrice) use ($variables, $supplierProfile, $expressionLanguage) {
                return $staticFixedPrice->getSupplierProfile()->getId() === $supplierProfile->getId() &&
                    (null === $staticFixedPrice->getCondition() ||
                        $expressionLanguage->evaluate($staticFixedPrice->getCondition(), $variables));
        });
        $dynamicVariablePriceHolders = array_filter($variantMarking->getDynamicVariablePriceHolders(),
            function (DynamicVariablePriceHolder $dynamicVariablePriceHolder) use ($variables, $supplierProfile, $expressionLanguage) {
                return $dynamicVariablePriceHolder->getSupplierProfile()->getId() === $supplierProfile->getId() &&
                    (null === $dynamicVariablePriceHolder->getCondition() ||
                        $expressionLanguage->evaluate($dynamicVariablePriceHolder->getCondition(), $variables));
        });
        $staticVariablePriceHolders = array_filter($variantMarking->getStaticVariablePriceHolders(),
            function (StaticVariablePriceHolder $staticVariablePriceHolder) use ($variables, $supplierProfile, $expressionLanguage) {
                return $staticVariablePriceHolder->getSupplierProfile()->getId() === $supplierProfile->getId() &&
                    (null === $staticVariablePriceHolder->getCondition() ||
                        $expressionLanguage->evaluate($staticVariablePriceHolder->getCondition(), $variables));
            });

        // if there is no matching variant marking price
        if (empty($dynamicFixedPrices) && empty($staticFixedPrices) && empty($dynamicVariablePriceHolders) && empty($staticVariablePriceHolders)) {
            // if the variant marking price is included in variant prices and the variant marking options perfectly
            // match the selected variant marking options, then the case is valid / else => on quote
            if ($variantMarking->isIncludedInVariantPrices() &&
                $variantMarking->getLength() === $selectedVariantMarking->getLength() &&
                $variantMarking->getWidth() === $selectedVariantMarking->getWidth() &&
                $variantMarking->getSquaredSize() === $selectedVariantMarking->getSquaredSize() &&
                $variantMarking->getDiameter() === $selectedVariantMarking->getDiameter() &&
                $variantMarking->getNumberOfColors() === $selectedVariantMarking->getNumberOfColors() &&
                $variantMarking->getNumberOfPositions() === $selectedVariantMarking->getNumberOfPositions() &&
                $variantMarking->getNumberOfLogos() === $selectedVariantMarking->getNumberOfLogos() &&
                $variantMarking->isFullColor() === $selectedVariantMarking->isFullColor()) {
                $variantMarkingCalculatedPrice->setOnQuote(false);
            }

            return $variantMarkingCalculatedPrice;
        }

        $markingFees = array();
        /* @var DynamicFixedPrice $dynamicFixedPrice */
        foreach ($dynamicFixedPrices as $dynamicFixedPrice) {
            $value = $expressionLanguage->evaluate($dynamicFixedPrice->getCalculationValue(), $variables);
            if (!is_numeric($value)) {
                return $variantMarkingCalculatedPrice;
            }

            $variantMarkingCalculatedPrice->add(Money::EUR(intval($value * 1000)));

            // if one variant marking price is the total price, we consider every other as total price too
            if ($dynamicFixedPrice->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($dynamicFixedPrice->getMarkingFees() as $markingFee) {
                $markingFeeId = $markingFee->getId();
                if (!isset($markingFees[$markingFeeId])) {
                    $markingFees[$markingFeeId] = $markingFee;
                }
            }
        }

        /* @var StaticFixedPrice $staticFixedPrice */
        foreach ($staticFixedPrices as $staticFixedPrice) {
            $variantMarkingCalculatedPrice->add($staticFixedPrice->getCalculationValue());

            // if one variant marking price is the total price, we consider every other as total price too
            if ($staticFixedPrice->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($staticFixedPrice->getMarkingFees() as $markingFee) {
                $markingFeeId = $markingFee->getId();
                if (!isset($markingFees[$markingFeeId])) {
                    $markingFees[$markingFeeId] = $markingFee;
                }
            }
        }

        /* @var DynamicVariablePriceHolder $dynamicVariablePriceHolder */
        foreach ($dynamicVariablePriceHolders as $dynamicVariablePriceHolder) {
            $matchingDynamicVariablePrice = null;
            /* @var DynamicVariablePrice $dynamicVariablePrice */
            foreach (array_filter($dynamicVariablePriceHolder->getDynamicVariablePrices(),
                function (DynamicVariablePrice $dynamicVariablePrice) use ($quantity) {
                    return $dynamicVariablePrice->getFromQuantity() <= $quantity;
            }) as $dynamicVariablePrice) {
                if (!$matchingDynamicVariablePrice instanceof DynamicVariablePrice) {
                    $matchingDynamicVariablePrice = $dynamicVariablePrice;

                    continue;
                }

                $fromQuantity = $dynamicVariablePrice->getFromQuantity();
                $matchingFromQuantity = $matchingDynamicVariablePrice->getFromQuantity();
                // if two dynamic variable prices are set for the same from quantity => on quote
                if ($fromQuantity === $matchingFromQuantity) {
                    return new VariantMarkingCalculatedPrice();
                }

                if ($fromQuantity > $matchingFromQuantity) {
                    $matchingDynamicVariablePrice = $dynamicVariablePrice;
                }
            }

            if (!$matchingDynamicVariablePrice instanceof DynamicVariablePrice) {
                continue;
            }

            $value = $expressionLanguage->evaluate($matchingDynamicVariablePrice->getCalculationValue(), $variables);
            if (!is_numeric($value)) {
                return $variantMarkingCalculatedPrice;
            }

            $variantMarkingCalculatedPrice->add(Money::EUR(intval($value * 1000)));

            // if one variant marking price is the total price, we consider every other as total price too
            if ($dynamicVariablePriceHolder->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($dynamicVariablePriceHolder->getMarkingFees() as $markingFee) {
                $markingFeeId = $markingFee->getId();
                if (!isset($markingFees[$markingFeeId])) {
                    $markingFees[$markingFeeId] = $markingFee;
                }
            }
        }

        /* @var StaticVariablePriceHolder $staticVariablePriceHolder */
        foreach ($staticVariablePriceHolders as $staticVariablePriceHolder) {
            $matchingStaticVariablePrice = null;
            /* @var StaticVariablePrice $staticVariablePrice */
            foreach (array_filter($staticVariablePriceHolder->getStaticVariablePrices(),
                function (StaticVariablePrice $staticVariablePrice) use ($quantity) {
                    return $staticVariablePrice->getFromQuantity() <= $quantity;
                }) as $staticVariablePrice) {
                if (!$matchingStaticVariablePrice instanceof StaticVariablePrice) {
                    $matchingStaticVariablePrice = $staticVariablePrice;

                    continue;
                }

                $fromQuantity = $staticVariablePrice->getFromQuantity();
                $matchingFromQuantity = $matchingStaticVariablePrice->getFromQuantity();
                // if two dynamic variable prices are set for the same from quantity => null
                if ($fromQuantity === $matchingFromQuantity) {
                    return new VariantMarkingCalculatedPrice();
                }

                if ($fromQuantity > $matchingFromQuantity) {
                    $matchingStaticVariablePrice = $staticVariablePrice;
                }
            }

            if (!$matchingStaticVariablePrice instanceof StaticVariablePrice) {
                continue;
            }

            $variantMarkingCalculatedPrice->add($matchingStaticVariablePrice->getCalculationValue()->multiply($quantity));

            // if one variant marking price is the total price, we consider every other as total price too
            if ($staticVariablePriceHolder->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($staticVariablePriceHolder->getMarkingFees() as $markingFee) {
                $markingFeeId = $markingFee->getId();
                if (!isset($markingFees[$markingFeeId])) {
                    $markingFees[$markingFeeId] = $markingFee;
                }
            }
        }

        $variantMarkingCalculatedPrice->setMarkingFees($markingFees);

        return $variantMarkingCalculatedPrice;
    }

    /**
     * @param array $selectedVariantMarkings
     * @param int $quantity
     *
     * @return array
     *
     * @throws NotImplementedException
     */
    public static function getVariables(array $selectedVariantMarkings, $quantity)
    {
        $keys = array();
        $stack = array();
        /* @var SelectedVariantMarking $selectedVariantMarking */
        foreach ($selectedVariantMarkings as $selectedVariantMarking) {
            $variantMarking = $selectedVariantMarking->getVariantMarking();

            $key = $variantMarking->getKey();
            $keys[] = $key;

            switch ($variantMarking->getType()) {
                case 'simple':
                    $variantMarkingShortType = 's';

                    break;
                case 'supplier':
                    $variantMarkingShortType = 'f';

                    break;
                default:
                    throw new NotImplementedException();
            }

            $stack[sprintf('marquage_%s_%s', $variantMarkingShortType, $key)] = array(
                VariantMarkingOptionsInterface::LENGTH => $selectedVariantMarking->getLength(),
                VariantMarkingOptionsInterface::WIDTH => $selectedVariantMarking->getWidth(),
                VariantMarkingOptionsInterface::SQUARED_SIZE => $selectedVariantMarking->getSquaredSize(),
                VariantMarkingOptionsInterface::DIAMETER => $selectedVariantMarking->getDiameter(),
                VariantMarkingOptionsInterface::NUMBER_OF_COLORS => $selectedVariantMarking->getNumberOfColors(),
                VariantMarkingOptionsInterface::NUMBER_OF_POSITIONS => $selectedVariantMarking->getNumberOfPositions(),
                VariantMarkingOptionsInterface::NUMBER_OF_LOGOS => $selectedVariantMarking->getNumberOfLogos(),
                VariantMarkingOptionsInterface::FULL_COLOR => $selectedVariantMarking->getLength(),
                VariantMarkingOptionsInterface::QUANTITY => $quantity
            );
        }

        $markingsCount = count($keys);
        $variables = array();
        foreach ($stack as $otherMarkingKey => $row) {
            $otherMarkings = array();
            foreach ($stack as $otherMarkingKey2 => $row2) {
                if ($otherMarkingKey2 !== $otherMarkingKey) {
                    $otherMarkings[$otherMarkingKey2] = $row2;
                }
            }

            $variables[] = array_merge($row, array(
                VariantMarkingOptionsInterface::KEYS => $keys,
                VariantMarkingOptionsInterface::MARKINGS_COUNT => $markingsCount
            ), $otherMarkings);
        }

        return $variables;
    }
}
