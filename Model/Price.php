<?php

namespace ES\APIv2Client\Model;

class Price
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var float
     */
    private $calculationValue;

    /**
     * @var float
     */
    private $reducedValue;

    /**
     * @var float
     */
    private $value;

    /**
     * @param string $id
     * @param float $calculationValue
     * @param float $reducedValue
     * @param float $value
     */
    public function __construct($id, $calculationValue, $reducedValue, $value)
    {
        $this->id = $id;
        $this->calculationValue = $calculationValue;
        $this->reducedValue = $reducedValue;
        $this->value = $value;
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
    public function getCalculationValue()
    {
        return $this->calculationValue;
    }

    /**
     * @return float
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}
