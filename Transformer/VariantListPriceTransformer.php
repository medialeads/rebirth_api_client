<?php

namespace Transformer;

require_once(__DIR__ . "/../Model/VariantListLink.php");

use Model\VariantListPrice;

class VariantListPriceTransformer
{
    public function fromArray($variantListPrice)
    {
        $supplierProfile = SupplierProfileTransformer::fromArray($variantListPrice['supplier_profile']);

        return new VariantListPrice($variantListPrice['id'], $variantListPrice['calculation_value'], $variantListPrice['reduced_value'], $variantListPrice['value'], $supplierProfile);
    }
}