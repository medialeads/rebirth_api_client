<?php

namespace ES\RebirthApiClient\Model;

class DynamicVariablePrice implements ModelInterface
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
     * @var string
     */
    private $value;

    /**
     * @var string|null
     */
    private $reducedValue;

    /**
     * @var string
     */
    private $calculationValue;

    /**
     * @param string $id
     * @param int $fromQuantity
     * @param string $value
     * @param string|null $reducedValue
     * @param string $calculationValue
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
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return string
     */
    public function getCalculationValue()
    {
        return $this->calculationValue;
    }
}
