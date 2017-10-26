<?php

namespace ES\APIv2Client\Model;

class VariantSamplePrice extends Price
{
    /**
     * @param int $id
     * @param mixed $calculationValue
     * @param float $reducedValue
     * @param mixed $value
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, $supplierProfile)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value, $supplierProfile);
    }
}