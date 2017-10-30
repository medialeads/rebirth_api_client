<?php

namespace ES\APIv2Client\Helper;

use ES\APIv2Client\Model\SupplierProfileInterface;
use ES\APIv2Client\Model\Variant;
use ES\APIv2Client\Model\CalculatedPrice;
use ES\APIv2Client\Model\VariantMarking;
use ES\APIv2Client\Model\VariantMarkingModel;
use ES\APIv2Client\Model\VariantPrice;
use ES\APIv2Client\Model\VariantSimpleMarkingCalculatedPrice;

class VariantHelper
{
    public static function getCalculatedPrice(Variant $variant, SupplierProfileInterface $supplierProfile, $quantity, array $variantMarkingModels = array())
    {
        $quantity = intval($quantity);
        if ($quantity < 1) {
            throw new \InvalidArgumentException('The quantity must be greater than 0.');
        }

        $calculatedPrice = new CalculatedPrice();
        if (!empty($variantMarkingModels)) {
            foreach ($variantMarkingModels as $variantMarkingModel) {
                if (!$variantMarkingModel instanceof VariantMarkingModel) {
                    throw new \UnexpectedValueException($variantMarkingModel, VariantMarkingModel::class);
                }

                $variantMarking = $variantMarkingModel->getVariantMarking();
                if (!$variantMarking instanceof VariantMarking) {
                    throw new \UnexpectedValueException($variantMarking, VariantMarking::class);
                }

                $variantMarkingCalculatedPrice = $variantMarking->getCalculatedPrice($supplierProfile, $quantity, $variantMarkingModel);
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
            throw new \InvalidArgumentException('The marking is mandatory but not a single VariantMarkingModel was given.');
        }

        $matchingVariantPrice = null;
        /* @var VariantPrice $variantPrice */
        foreach (array_filter($variant->getVariantPrices(), (function (VariantPrice $variantPrice) use ($supplierProfile, $quantity) {
            return $variantPrice->getSupplierProfile() === $supplierProfile &&
                $variantPrice->getFromQuantity() < $quantity;
        })) as $variantPrice) {
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