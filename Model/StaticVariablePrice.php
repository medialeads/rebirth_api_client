<?php

namespace ES\APIv2Client\Model;

class StaticVariablePrice extends Price
{
    /**
     * @var int
     */
    private $fromQuantity;

    /**
     * @param string $id
     * @param float $calculationValue
     * @param float $reducedValue
     * @param int $fromQuantity
     * @param mixed $value
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $fromQuantity, $value, SupplierProfileInterface $supplierProfile)
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