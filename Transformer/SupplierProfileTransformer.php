<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/SupplierProfile.php');

use Model\SupplierProfile;

class SupplierProfileTransformer extends AbstractTransformer
{
    /**
     * @var array
     */
    protected static $_instances = array();

    public static function doFromArray(array $supplierProfiles): array
    {
        $response = array();
        foreach ($supplierProfiles as $supplierProfile) {
            $supplierProfile = new SupplierProfile($supplierProfile['id'], $supplierProfile['country_code']);
            self::$_instances[$supplierProfile->getId()] = $supplierProfile;
            $response[] =  $supplierProfile;
        }

        return $response;
    }
}