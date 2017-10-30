<?php

namespace ES\APIv2Client\Model;

class DynamicVariablePrice extends Price
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
     */
    public function __construct($id, $calculationValue, $reducedValue, $fromQuantity, $value)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value);

        $this->fromQuantity = $fromQuantity;
    }

    /**
     * @return int
     */
    public function getFromQuantity()
    {
        return $this->fromQuantity;
    }
}