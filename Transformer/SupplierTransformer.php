<?php

namespace Transformer;

require_once(__DIR__ . '/AbstractTransformer.php');
require_once(__DIR__ . '/SupplierProfileTransformer.php');
require_once(__DIR__ . '/../Model/Supplier.php');

use Model\Supplier;

class SupplierTransformer extends AbstractTransformer
{
    public static function doFromArray(array $suppliers): array
    {
        $response = array();
        foreach ($suppliers as $supplier) {
            $supplierProfiles = SupplierProfileTransformer::fromArray($supplier['supplier_profiles']);
            $response[] = new Supplier($supplier['id'], $supplier['project_id'], $supplier['vat_identification_number'], $supplierProfiles, $supplier['name'], $supplier['legal_name'], $supplier['slug']);
        }

        return $response;
    }
}