<?php

namespace ES\APIv2Client\Model;

class Price
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var float|string
     */
    private $calculationValue;

    /**
     * @var float|string
     */
    private $reducedValue;

    /**
     * @var float|string
     */
    private $value;

    /**
     * @param string $id
     * @param float|string $calculationValue
     * @param float|string $reducedValue
     * @param float|string $value
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
     * @return float|string
     */
    public function getCalculationValue()
    {
        return $this->calculationValue;
    }

    /**
     * @return float|string
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return float|string
     */
    public function getValue()
    {
        return $this->value;
    }
}
