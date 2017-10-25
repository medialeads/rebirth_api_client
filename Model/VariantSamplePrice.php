<?php

namespace Model;

require_once(__DIR__ . '/Price.php');

class VariantSamplePrice extends Price
{
    /**
     * @param int $id
     * @param mixed $calculationValue
     * @param float $reducedValue
     * @param mixed $value
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, SupplierProfile $supplierProfile)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value, $supplierProfile);
    }
}