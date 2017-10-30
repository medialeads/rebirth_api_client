<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\SupplierMarking;

class SupplierMarkingTransformer extends AbstractTransformer
{
    /**
     * @param array $supplierMarkings
     *
     * @return array
     */
    public static function doFromArray($supplierMarkings)
    {
        $response = array();
        foreach ($supplierMarkings as $supplierMarking) {
            $response[] =  new SupplierMarking($supplierMarking['id'], $supplierMarking['name_complement'], $supplierMarking['code'], $supplierMarking['project_id'], $supplierMarking['comment']);
        }

        return $response;
    }
}