<?php

namespace ES\RebirthApiClient\Model;

class AttributeGroup implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $additionalTextDataType;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param string $id
     * @param string $type
     * @param string $name
     * @param string|null $additionalTextDataType
     * @param string $slug
     */
    public function __construct($id, $type, $name, $additionalTextDataType, $slug)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->additionalTextDataType = $additionalTextDataType;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getAdditionalTextDataType()
    {
        return $this->additionalTextDataType;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
