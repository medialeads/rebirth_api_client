<?php

namespace ES\RebirthApiClient\Model;

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
     * @param string $id
     * @param int $fromQuantity
     * @param float $value
     * @param float|null $reducedValue
     * @param float $calculationValue
     */
    public function __construct($id, $fromQuantity, $value, $reducedValue, $calculationValue)
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
}
