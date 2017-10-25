<?php

namespace Transformer;

require_once(__DIR__ . '/../Model/VariantPrice.php');

use Model\VariantPrice;

class VariantPriceTransformer
{
    public function fromArray($variantPrice)
    {
        $supplierProfile = SupplierProfileTransformer::fromArray($variantPrice['supplier_profile']);

        return new VariantPrice($variantPrice['id'], $variantPrice['calculation_value'], $variantPrice['reduced_value'], $variantPrice['value'], $supplierProfile, $variantPrice['from_quantity']);
    }
}