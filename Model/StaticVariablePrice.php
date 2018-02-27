<?php

namespace ES\RebirthApiClient\Model;

use Money\Money;

class StaticVariablePrice implements ModelInterface
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
     * @param string $id
     * @param int $fromQuantity
     * @param Money $value
     * @param Money|null $reducedValue
     * @param Money $calculationValue
     */
    public function __construct($id, $fromQuantity, Money $value, Money $reducedValue = null, Money $calculationValue)
    {
        $this->id = $id;
        $this->fromQuantity = $fromQuantity;
        $this->value = $value;
        $this->reducedValue = $reducedValue;
        $this->calculationValue = $calculationValue;
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
}
