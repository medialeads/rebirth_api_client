<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/SupplierMarking.php");

use Model\SupplierMarking;

class SupplierMarkingTransformer extends AbstractTransformer
{
    public static function doFromArray(array $supplierMarkings): array
    {
        $response = array();
        foreach ($supplierMarkings as $supplierMarking) {
            $response[] =  new SupplierMarking($supplierMarking['id'], $supplierMarking['name_complement'], $supplierMarking['code'], $supplierMarking['project_id'], $supplierMarking['comment']);
        }

        return $response;
    }
}