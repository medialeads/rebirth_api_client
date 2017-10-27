<?php

namespace ES\APIv2Client\Model;

class VariantSamplePrice extends Price
{
    /**
     * @param string $id
     * @param float $calculationValue
     * @param float $reducedValue
     * @param float $value
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, SupplierProfileInterface $supplierProfile)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value, $supplierProfile);
    }
}