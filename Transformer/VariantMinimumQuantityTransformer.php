<?php

namespace Transformer;

require_once(__DIR__ . '/../Model/VariantMinimumQuantity.php');

use Model\VariantMinimumQuantity;

class VariantMinimumQuantityTransformer
{
    public function fromArray($variantMinimumQuantity)
    {
        $projectId = null;
        if (array_key_exists('project_id', $variantMinimumQuantity)) {
            $projectId = $variantMinimumQuantity['project_id'];
        }

        $supplierProfile = SupplierProfileTransformer::fromArray($variantMinimumQuantity['supplier_profile']);

        return new VariantMinimumQuantity($variantMinimumQuantity['id'], $projectId, $variantMinimumQuantity['value'], $supplierProfile);
    }
}