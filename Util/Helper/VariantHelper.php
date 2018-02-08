<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthApiClient\Model\SupplierProfileInterface;
use ES\RebirthApiClient\Model\Variant;
use ES\RebirthApiClient\Model\VariantPrice;
use ES\RebirthApiClient\Util\Model\CalculatedPrice;
use ES\RebirthApiClient\Util\Model\SelectedVariantMarking;

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
    public static function getCalculatedPrice(Variant $variant, SupplierProfileInterface $supplierProfile, $quantity, array $selectedVariantMarkings = array())
    {
        $calculatedPrice = new CalculatedPrice();

        $quantity = intval($quantity);
        if ($quantity < 1) {
            return $calculatedPrice;
        }

        foreach ($variant->getVariantMinimumQuantities() as $variantMinimumQuantity) {
            if ($variantMinimumQuantity->getSupplierProfile()->getId() !== $supplierProfile->getId()) {
                continue;
            }

            if ($quantity < $variantMinimumQuantity->getValue()) {
                return $calculatedPrice;
            }

            break;
        }

        if (!empty($selectedVariantMarkings)) {
            /* @var SelectedVariantMarking $selectedVariantMarking */
            foreach ($selectedVariantMarkings as $selectedVariantMarking) {
                $variantMarkingCalculatedPrice = VariantMarkingHelper::getCalculatedPrice($selectedVariantMarking, $supplierProfile, $quantity);
                if (null === $variantMarkingCalculatedPrice->getValue()) {
                    return $calculatedPrice;
                }

                if ($variantMarkingCalculatedPrice instanceof VariantSimpleMarkingCalculatedPrice) {
                    if ($variantMarkingCalculatedPrice->isTotalPrice()) {
                        if (1 === count($variantMarkingModels)) {
                            $calculatedPrice->setValue($variantMarkingCalculatedPrice->getValue());
                        }

                        return $calculatedPrice;
                    }
                }

                $calculatedPrice->addValue($variantMarkingCalculatedPrice->getValue());
            }
        } elseif ($variant->isMandatoryMarking()) {
            return $calculatedPrice;
        }

        $matchingVariantPrice = null;
        /* @var VariantPrice $variantPrice */
        foreach (array_filter($variant->getVariantPrices(), function (VariantPrice $variantPrice) use ($supplierProfile, $quantity) {
            return $supplierProfile->getId() === $variantPrice->getSupplierProfile()->getId() && $variantPrice->getFromQuantity() < $quantity;
        }) as $variantPrice) {
            if (!$matchingVariantPrice instanceof VariantPrice || ($variantPrice->getFromQuantity() > $matchingVariantPrice->getFromQuantity())) {
                $matchingVariantPrice = $variantPrice;
            }
        }

        if ($matchingVariantPrice instanceof VariantPrice) {
            $calculatedPrice->addValue($quantity * $matchingVariantPrice->getCalculationValue());
        }

        return $calculatedPrice;
    }
}
