<?php

namespace ES\RebirthApiClient\Model;

class VariantSamplePrice implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

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
     * @param float $value
     * @param float|null $reducedValue
     * @param float $calculationValue
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $value, $reducedValue, $calculationValue,
        SupplierProfileInterface $supplierProfile)
    {
        $this->id = $id;
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
