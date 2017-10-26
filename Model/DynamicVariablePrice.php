<?php

namespace ES\APIv2Client\Model;

class DynamicVariablePrice extends Price
{
    /**
     * @param int $id
     * @param mixed $calculationValue
     * @param float $reducedValue
     * @param int $fromQuantity
     * @param mixed $value
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $fromQuantity, $value, $supplierProfile)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $fromQuantity, $value, $supplierProfile);
    }
}