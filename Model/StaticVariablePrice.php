<?php

namespace Model;

class StaticVariablePrice extends Price
{
    /**
     * @param int $id
     * @param mixed $calculationValue
     * @param float $reducedValue
     * @param int $fromQuantity
     * @param mixed $value
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, SupplierProfile $supplierProfile)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value, $supplierProfile);
    }
}