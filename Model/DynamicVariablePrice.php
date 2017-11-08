<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class DynamicVariablePrice extends Price
{
    /**
     * @var int
     */
    private $fromQuantity;

    /**
     * @param string $id
     * @param float|string $calculationValue
     * @param float|string $reducedValue
     * @param int $fromQuantity
     * @param float|string $value
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