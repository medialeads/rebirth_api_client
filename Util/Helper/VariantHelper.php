<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthApiClient\Model\SupplierProfileInterface;
use ES\RebirthApiClient\Model\Variant;
use ES\RebirthApiClient\Model\VariantPrice;
use ES\RebirthApiClient\Util\Model\CalculatedPrice;
use ES\RebirthApiClient\Util\Model\SelectedVariantMarking;
use ES\RebirthApiClient\Util\Model\VariantMarkingCalculatedPrice;
use Money\Money;

class VariantHelper
{
    /**
     * @param Variant $variant
     * @param SupplierProfileInterface $supplierProfile
     * @param int $quantity
     * @param SelectedVariantMarking[] $selectedVariantMarkings
     *
     * @return CalculatedPrice
     */
    public static function getCalculatedPrice(Variant $variant, SupplierProfileInterface $supplierProfile, $quantity,
        array $selectedVariantMarkings)
    {
        $calculatedPrice = new CalculatedPrice();

        $quantity = intval($quantity);
        // if the provided quantity is negative => on quote
        if ($quantity < 1) {
            return $calculatedPrice;
        }

        foreach ($variant->getVariantMinimumQuantities() as $variantMinimumQuantity) {
            if ($variantMinimumQuantity->getSupplierProfile()->getId() !== $supplierProfile->getId()) {
                continue;
            }

            // if the provided quantity is inferior than the matching minimum quantity => on quote
            if ($quantity < $variantMinimumQuantity->getValue()) {
                return $calculatedPrice;
            }

            break;
        }

        // if the marking is mandatory but not a single selected variant marking was provided => on quote
        if ($variant->isMandatoryMarking() && empty($selectedVariantMarkings)) {
            return $calculatedPrice;
        }

        $matchingVariantPrice = null;
        /* @var VariantPrice $variantPrice */
        foreach (array_filter($variant->getVariantPrices(), function (VariantPrice $variantPrice) use ($supplierProfile, $quantity) {
            return $supplierProfile->getId() === $variantPrice->getSupplierProfile()->getId() && $variantPrice->getFromQuantity() <= $quantity;
        }) as $variantPrice) {
            if (!$matchingVariantPrice instanceof VariantPrice) {
                $matchingVariantPrice = $variantPrice;

                continue;
            }

            $fromQuantity = $variantPrice->getFromQuantity();
            $matchingFromQuantity = $matchingVariantPrice->getFromQuantity();
            // if two variant prices are set for the same from quantity => on quote
            if ($fromQuantity === $matchingFromQuantity) {
                return $calculatedPrice;
            }

            if ($fromQuantity > $matchingFromQuantity) {
                $matchingVariantPrice = $variantPrice;
            }
        }

        // if there is no matching variant price => on quote
        if (!$matchingVariantPrice instanceof VariantPrice) {
            return $calculatedPrice;
        }

        if (!empty($selectedVariantMarkings)) {
            $totalPriceCount = 0;
            $variantMarkingCalculatedPrices = array();
            $selectedVariantMarkingsVariables = VariantMarkingHelper::getVariables($selectedVariantMarkings, $quantity);
            /* @var SelectedVariantMarking $selectedVariantMarking */
            foreach ($selectedVariantMarkings as $selectedVariantMarking) {
                $selectedVariantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, $selectedVariantMarkingsVariables, $supplierProfile, $quantity);
                // if one variant marking calculated price is on quote => on quote
                if ($selectedVariantMarkingCalculatedPrice->isOnQuote()) {
                    return $calculatedPrice;
                }

                $variantMarkingCalculatedPrices[] = $selectedVariantMarkingCalculatedPrice;

                if ($selectedVariantMarkingCalculatedPrice->isTotalPrice()) {
                    // if there is more than one total price => on quote
                    if (2 === ++$totalPriceCount) {
                        return $calculatedPrice;
                    }
                }
            }

            switch ($totalPriceCount) {
                case 0:
                    $calculatedPrice->add($matchingVariantPrice->getCalculationValue()->multiply($quantity));
                case 1:
                    /* @var VariantMarkingCalculatedPrice $variantMarkingCalculatedPrice */
                    foreach ($variantMarkingCalculatedPrices as $variantMarkingCalculatedPrice) {
                        $calculatedPrice->add(Money::EUR($variantMarkingCalculatedPrice->getAmount()));
                    }

                    break;
                default:
                    throw new \LogicException();
            }
        } else {
            $calculatedPrice->add($matchingVariantPrice->getCalculationValue()->multiply($quantity));
        }

        $calculatedPrice->setOnQuote(false);

        return $calculatedPrice;
    }
}
