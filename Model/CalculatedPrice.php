<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class CalculatedPrice
{
    /**
     * @var float
     */
    private $value;

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     *
     * @return CalculatedPrice
     */
    public function setValue($value)
    {
        $value = floatval($value);
        if ($value <= 0.0) {
            $value = null;
        }

        $this->value = $value;

        return $this;
    }

    /**
     * @param float $value
     *
     * @return CalculatedPrice
     */
    public function addValue($value)
    {
        $value = floatval($value);
        if ($value > 0.0) {
            if (null === $this->value) {
                $this->value = 0.0;
            }

            $this->value += $value;
        }

        return $this;
    }
}
