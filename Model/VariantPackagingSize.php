<?php

namespace ES\RebirthApiClient\Model;

class VariantPackagingSize implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var float
     */
    private $value;

    /**
     * @param string $id
     * @param string|null $type
     * @param float $value
     */
    public function __construct($id, $type, $value)
    {
        $this->id = $id;
        $this->type = $type;
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
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}
