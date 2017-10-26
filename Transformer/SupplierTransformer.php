<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Supplier;

class SupplierTransformer extends AbstractTransformer
{
    /**
     * @param array $suppliers
     *
     * @return array
     */
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