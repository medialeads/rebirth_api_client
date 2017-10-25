<?php

namespace Model;

require_once(__DIR__ . '/Price.php');

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
    public function __construct(int $id, $calculationValue, float $reducedValue, $value, SupplierProfile $supplierProfile, int $fromQuantity)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value, $supplierProfile);

        $this->fromQuantity = $fromQuantity;
    }

    /**
     * @return int
     */
    public function getFromQuantity(): int
    {
        return $this->fromQuantity;
    }
}