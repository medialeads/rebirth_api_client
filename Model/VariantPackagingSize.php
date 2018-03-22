<?php

namespace ES\RebirthApiClient\Model;

class VariantPackagingSize extends AbstractModel
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
     * @var string
     */
    private $value;

    /**
     * @param string $id
     * @param string|null $type
     * @param string $value
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
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
