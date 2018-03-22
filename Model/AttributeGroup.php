<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\AttributeGroupInterface;

class AttributeGroup extends AbstractModel implements AttributeGroupInterface
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
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $additionalTextDataType;

    /**
     * @var string|null
     */
    private $slug;

    /**
     * @param string $id
     * @param string $type
     * @param string|null $name
     * @param string|null $additionalTextDataType
     * @param string|null $slug
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
     * @return string|null
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
     * @return string|null
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
