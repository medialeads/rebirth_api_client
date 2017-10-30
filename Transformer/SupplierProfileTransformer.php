<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\SupplierProfile;
use ES\APIv2Client\Model\PartialSupplierProfile;

class SupplierProfileTransformer extends AbstractTransformer
{
    /**
     * @var array
     */
    protected static $_instances = array();

    /**
     * @param array $supplierProfiles
     *
     * @return array
     */
    public static function doFromArray($supplierProfiles)
    {
        $response = array();
        foreach ($supplierProfiles as $supplierProfile) {
            if (isset(self::$_instances[$supplierProfile['id']])) {
                $response[] =  self::$_instances[$supplierProfile['id']];
                break;
            }
            if (isset($supplierProfile['name'])) {
                $supplierProfile = new SupplierProfile($supplierProfile['id'], $supplierProfile['country_code'], $supplierProfile['project_id'], $supplierProfile['name'], $supplierProfile['association'], $supplierProfile['display_prices'], $supplierProfile['status']);
            } else {
                $supplierProfile = new PartialSupplierProfile($supplierProfile['id'], $supplierProfile['country_code']);
            }
            self::$_instances[$supplierProfile->getId()] = $supplierProfile;
            $response[] =  $supplierProfile;
        }

        return $response;
    }
}