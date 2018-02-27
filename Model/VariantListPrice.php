<?php

namespace ES\RebirthApiClient\Model;

use Money\Money;

class VariantListPrice implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Money
     */
    private $value;

    /**
     * @var Money|null
     */
    private $reducedValue;

    /**
     * @var Money
     */
    private $calculationValue;

    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param Money $value
     * @param Money|null $reducedValue
     * @param Money $calculationValue
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, Money $value, Money $reducedValue = null, Money $calculationValue,
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
     * @return Money
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Money|null
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return Money
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
