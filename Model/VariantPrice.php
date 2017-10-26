<?php

namespace ES\APIv2Client\Model;

class VariantPrice extends Price
{
    /**
     * @var int
     */
    private $fromQuantity;

    /**
     * @param int $id
     * @param mixed $calculationValue
     * @param float $reducedValue
     * @param mixed $value
     * @param SupplierProfile $supplierProfile
     * @param int $fromQuantity
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, $supplierProfile, $fromQuantity)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value, $supplierProfile);

        $this->fromQuantity = $fromQuantity;
    }

    /**
     * @return int
     */
    public function getFromQuantity()
    {
        return $this->fromQuantity;
    }
}