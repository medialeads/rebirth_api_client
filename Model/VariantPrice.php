<?php

namespace ES\APIv2Client\Model;

class VariantPrice extends Price
{
    /**
     * @var int
     */
    private $fromQuantity;

    /**
     * @param string $id
     * @param float $calculationValue
     * @param float $reducedValue
     * @param float $value
     * @param SupplierProfileInterface $supplierProfile
     * @param int $fromQuantity
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, SupplierProfileInterface $supplierProfile, $fromQuantity)
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