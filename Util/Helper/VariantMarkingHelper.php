<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthApiClient\Exception\NotImplementedException;
use ES\RebirthApiClient\Util\Model\SelectedVariantMarking;
use ES\RebirthApiClient\Util\Model\VariantMarkingCalculatedPrice;
use ES\RebirthCommon\DynamicFixedPriceInterface;
use ES\RebirthCommon\DynamicVariablePriceHolderInterface;
use ES\RebirthCommon\DynamicVariablePriceInterface;
use ES\RebirthCommon\StaticFixedPriceInterface;
use ES\RebirthCommon\StaticVariablePriceHolderInterface;
use ES\RebirthCommon\StaticVariablePriceInterface;
use ES\RebirthCommon\SupplierProfileInterface;
use ES\RebirthCommon\VariantMarkingInterface;
use ES\RebirthCommon\VariantMarkingOptionsInterface;
use Money\Money;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

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
        $minimumQuantity = $variantMarking->getMinimumQuantity();
        if (null !== $minimumQuantity && $quantity < $minimumQuantity) {
            return $variantMarkingCalculatedPrice;
        }

        // if the provided quantity is superior than the variant marking maximum quantity => on quote
        $maximumQuantity = $variantMarking->getMaximumQuantity();
        if (null !== $maximumQuantity && $quantity > $maximumQuantity) {
            return $variantMarkingCalculatedPrice;
        }

        $expressionLanguage = new ExpressionLanguage();

        $filteredDynamicFixedPrices = array();
        foreach ($variantMarking->getDynamicFixedPrices() as $dynamicFixedPrice) {
            $condition = $dynamicFixedPrice->getCondition();
            try {
                if ($dynamicFixedPrice->getSupplierProfile()->getUniqueId() === $supplierProfile->getUniqueId() &&
                    (null === $condition || $expressionLanguage->evaluate($condition, $variables))) {
                    $filteredDynamicFixedPrices[] = $dynamicFixedPrice;
                }
            } catch (SyntaxError $e) {
                return $variantMarkingCalculatedPrice;
            }
        }

        $filteredStaticFixedPrices = array();
        foreach ($variantMarking->getStaticFixedPrices() as $staticFixedPrice) {
            $condition = $staticFixedPrice->getCondition();
            try {
                if ($staticFixedPrice->getSupplierProfile()->getUniqueId() === $supplierProfile->getUniqueId() &&
                    (null === $condition || $expressionLanguage->evaluate($condition, $variables))) {
                    $filteredStaticFixedPrices[] = $staticFixedPrice;
                }
            } catch (SyntaxError $e) {
                return $variantMarkingCalculatedPrice;
            }
        }

        $filteredDynamicVariablePriceHolders = array();
        foreach ($variantMarking->getDynamicVariablePriceHolders() as $dynamicVariablePriceHolder) {
            $condition = $dynamicVariablePriceHolder->getCondition();
            try {
                if ($dynamicVariablePriceHolder->getSupplierProfile()->getUniqueId() === $supplierProfile->getUniqueId() &&
                    (null === $condition || $expressionLanguage->evaluate($condition, $variables))) {
                    $filteredDynamicVariablePriceHolders[] = $dynamicVariablePriceHolder;
                }
            } catch (SyntaxError $e) {
                return $variantMarkingCalculatedPrice;
            }
        }

        $filteredStaticVariablePriceHolders = array();
        foreach ($variantMarking->getStaticVariablePriceHolders() as $staticVariablePriceHolder) {
            $condition = $staticVariablePriceHolder->getCondition();
            try {
                if ($staticVariablePriceHolder->getSupplierProfile()->getUniqueId() === $supplierProfile->getUniqueId() &&
                    (null === $condition || $expressionLanguage->evaluate($condition, $variables))) {
                    $filteredStaticVariablePriceHolders[] = $staticVariablePriceHolder;
                }
            } catch (SyntaxError $e) {
                return $variantMarkingCalculatedPrice;
            }
        }

        // if there is no matching variant marking price
        if (empty($filteredDynamicFixedPrices) && empty($filteredStaticFixedPrices) && empty($filteredDynamicVariablePriceHolders) && empty($filteredStaticVariablePriceHolders)) {
            // if the variant marking price is included in variant prices and the variant marking options perfectly
            // match the selected variant marking options, then the case is valid / else => on quote
            if ($variantMarking->isIncludedInVariantPrices() &&
                $variantMarking->getLength() === $selectedVariantMarking->getLength() &&
                $variantMarking->getWidth() === $selectedVariantMarking->getWidth() &&
                $variantMarking->getSquaredSize() === $selectedVariantMarking->getSquaredSize() &&
                $variantMarking->getDiameter() === $selectedVariantMarking->getDiameter() &&
                $variantMarking->getNumberOfColors() === $selectedVariantMarking->getNumberOfColors() &&
                $variantMarking->getNumberOfPositions() === $selectedVariantMarking->getNumberOfPositions() &&
                $variantMarking->getNumberOfLogos() === $selectedVariantMarking->getNumberOfLogos()) {
                $variantMarkingCalculatedPrice->setOnQuote(false);
            }

            return $variantMarkingCalculatedPrice;
        }

        $markingFees = array();
        /* @var DynamicFixedPriceInterface $dynamicFixedPrice */
        foreach ($filteredDynamicFixedPrices as $dynamicFixedPrice) {
            try {
                $value = $expressionLanguage->evaluate($dynamicFixedPrice->getCalculationValue(), $variables);
            } catch (SyntaxError $e) {
                return $variantMarkingCalculatedPrice;
            }

            if (!is_numeric($value)) {
                return $variantMarkingCalculatedPrice;
            }

            $variantMarkingCalculatedPrice->add(Money::EUR(intval($value * 1000)));

            // if one variant marking price is the total price, we consider every other as total price too
            if ($dynamicFixedPrice->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($dynamicFixedPrice->getMarkingFees() as $markingFee) {
                $markingFeeUniqueId = $markingFee->getUniqueId();
                if (!isset($markingFees[$markingFeeUniqueId])) {
                    $markingFees[$markingFeeUniqueId] = $markingFee;
                }
            }
        }

        /* @var StaticFixedPriceInterface $staticFixedPrice */
        foreach ($filteredStaticFixedPrices as $staticFixedPrice) {
            $calculationValue = $staticFixedPrice->getCalculationValue();
            if (!$calculationValue instanceof Money) {
                $calculationValue = Money::EUR(intval($calculationValue * 1000));
            }

            $variantMarkingCalculatedPrice->add($calculationValue);

            // if one variant marking price is the total price, we consider every other as total price too
            if ($staticFixedPrice->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($staticFixedPrice->getMarkingFees() as $markingFee) {
                $markingFeeUniqueId = $markingFee->getUniqueId();
                if (!isset($markingFees[$markingFeeUniqueId])) {
                    $markingFees[$markingFeeUniqueId] = $markingFee;
                }
            }
        }

        /* @var DynamicVariablePriceHolderInterface $dynamicVariablePriceHolder */
        foreach ($filteredDynamicVariablePriceHolders as $dynamicVariablePriceHolder) {
            $matchingDynamicVariablePrice = null;
            foreach ($dynamicVariablePriceHolder->getDynamicVariablePrices() as $dynamicVariablePrice) {
                $fromQuantity = $dynamicVariablePrice->getFromQuantity();
                if ($fromQuantity > $quantity) {
                    continue;
                }

                if (!$matchingDynamicVariablePrice instanceof DynamicVariablePriceInterface) {
                    $matchingDynamicVariablePrice = $dynamicVariablePrice;

                    continue;
                }

                $matchingFromQuantity = $matchingDynamicVariablePrice->getFromQuantity();
                // if two dynamic variable prices are set for the same from quantity => on quote
                if ($fromQuantity === $matchingFromQuantity) {
                    return new VariantMarkingCalculatedPrice();
                }

                if ($fromQuantity > $matchingFromQuantity) {
                    $matchingDynamicVariablePrice = $dynamicVariablePrice;
                }
            }

            if (!$matchingDynamicVariablePrice instanceof DynamicVariablePriceInterface) {
                continue;
            }

            try {
                $value = $expressionLanguage->evaluate($matchingDynamicVariablePrice->getCalculationValue(), $variables);
            } catch (SyntaxError $e) {
                return $variantMarkingCalculatedPrice;
            }

            if (!is_numeric($value)) {
                return $variantMarkingCalculatedPrice;
            }

            $variantMarkingCalculatedPrice->add(Money::EUR(intval($value * 1000)));

            // if one variant marking price is the total price, we consider every other as total price too
            if ($dynamicVariablePriceHolder->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($dynamicVariablePriceHolder->getMarkingFees() as $markingFee) {
                $markingFeeUniqueId = $markingFee->getUniqueId();
                if (!isset($markingFees[$markingFeeUniqueId])) {
                    $markingFees[$markingFeeUniqueId] = $markingFee;
                }
            }
        }

        /* @var StaticVariablePriceHolderInterface $staticVariablePriceHolder */
        foreach ($filteredStaticVariablePriceHolders as $staticVariablePriceHolder) {
            $matchingStaticVariablePrice = null;
            foreach ($staticVariablePriceHolder->getStaticVariablePrices() as $staticVariablePrice) {
                $fromQuantity = $staticVariablePrice->getFromQuantity();
                if ($fromQuantity > $quantity) {
                    continue;
                }

                if (!$matchingStaticVariablePrice instanceof StaticVariablePriceInterface) {
                    $matchingStaticVariablePrice = $staticVariablePrice;

                    continue;
                }

                $matchingFromQuantity = $matchingStaticVariablePrice->getFromQuantity();
                // if two dynamic variable prices are set for the same from quantity => null
                if ($fromQuantity === $matchingFromQuantity) {
                    return new VariantMarkingCalculatedPrice();
                }

                if ($fromQuantity > $matchingFromQuantity) {
                    $matchingStaticVariablePrice = $staticVariablePrice;
                }
            }

            if (!$matchingStaticVariablePrice instanceof StaticVariablePriceInterface) {
                continue;
            }

            $calculationValue = $matchingStaticVariablePrice->getCalculationValue();
            if (!$calculationValue instanceof Money) {
                $calculationValue = Money::EUR(intval($calculationValue * 1000));
            }

            $variantMarkingCalculatedPrice->add($calculationValue->multiply($quantity));

            // if one variant marking price is the total price, we consider every other as total price too
            if ($staticVariablePriceHolder->isTotalPrice()) {
                $variantMarkingCalculatedPrice->setTotalPrice(true);
            }

            foreach ($staticVariablePriceHolder->getMarkingFees() as $markingFee) {
                $markingFeeUniqueId = $markingFee->getUniqueId();
                if (!isset($markingFees[$markingFeeUniqueId])) {
                    $markingFees[$markingFeeUniqueId] = $markingFee;
                }
            }
        }

        $variantMarkingCalculatedPrice->setMarkingFees($markingFees);

        if ($variantMarkingCalculatedPrice->getAmount() > 0) {
            $variantMarkingCalculatedPrice->setOnQuote(false);
        }

        return $variantMarkingCalculatedPrice;
    }

    /**
     * @param array $selectedVariantMarkings
     * @param int $quantity
     *
     * @return array
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
                case VariantMarkingInterface::TYPE_SIMPLE:
                    $variantMarkingShortType = 's';

                    break;
                case VariantMarkingInterface::TYPE_SUPPLIER:
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
                VariantMarkingOptionsInterface::FULL_COLOR => $variantMarking->isFullColor(),
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
