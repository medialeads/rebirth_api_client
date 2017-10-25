<?php

namespace Transformer;

use Model\VariantSamplePrice;

class VariantSamplePriceTransformer
{
    public function fromArray($variantSamplePrice)
    {
        $supplierProfile = SupplierProfileTransformer::fromArray($variantSamplePrice['supplier_profile']);

        return new VariantSamplePrice($variantSamplePrice['id'], $variantSamplePrice['calculation_value'], $variantSamplePrice['reduced_value'], $variantSamplePrice['value'], $supplierProfile);
    }
}