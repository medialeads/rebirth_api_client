<?php

namespace ES\RebirthApiClient\Model;

class VariantPrice implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $fromQuantity;

    /**
     * @var float
     */
    private $value;

    /**
     * @var float|null
     */
    private $reducedValue;

    /**
     * @var float
     */
    private $calculationValue;

    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param int $fromQuantity
     * @param float $value
     * @param float|null $reducedValue
     * @param float $calculationValue
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $fromQuantity, $value, $reducedValue, $calculationValue,
        SupplierProfileInterface $supplierProfile)
    {
        $this->id = $id;
        $this->fromQuantity = $fromQuantity;
        $this->value = $value;
        $this->reducedValue = $reducedValue;
        $this->calculationValue = $calculationValue;
        $this->supplierProfile = $supplierProfile;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFromQuantity()
    {
        return $this->fromQuantity;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return float|null
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return float
     */
    public function getCalculationValue()
    {
        return $this->calculationValue;
    }

    /**
     * @return SupplierProfileInterface
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}
