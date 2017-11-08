<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Supplier;

/**
 * @author Dagan MENEZ
 */
class SupplierTransformer extends AbstractTransformer
{
    /**
     * @param array $suppliers
     *
     * @return array
     */
    public static function doFromArray($suppliers)
    {
        $response = array();
        foreach ($suppliers as $supplier) {
            $supplierProfiles = SupplierProfileTransformer::fromArray($supplier['supplier_profiles']);
            $response[] = new Supplier($supplier['id'], $supplier['project_id'], $supplier['vat_identification_number'], $supplierProfiles, $supplier['name'], $supplier['legal_name'], $supplier['slug']);
        }

        return $response;
    }
}