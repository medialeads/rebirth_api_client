<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/SupplierProfile.php');

use Model\SupplierProfile;

class SupplierProfileTransformer extends AbstractTransformer
{
    public static function doFromArray(array $supplierProfiles): array
    {
        $response = array();
        foreach ($supplierProfiles as $supplierProfile) {
            $response[] =  new SupplierProfile($supplierProfile['id'], $supplierProfile['country_code']);
        }

        return $response;
    }
}