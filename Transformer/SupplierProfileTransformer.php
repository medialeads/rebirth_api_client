<?php

namespace Transformer;

require_once(__DIR__ . '/../Model/SupplierProfile.php');

use Model\SupplierProfile;

class SupplierProfileTransformer
{
    public function fromArray($supplierProfile)
    {
        return new SupplierProfile($supplierProfile['id'], $supplierProfile['country_code']);
    }
}