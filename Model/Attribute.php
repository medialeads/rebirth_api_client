<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\AttributeInterface;

class Attribute implements ModelInterface, AttributeInterface
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
    private $value;

    /**
     * @var string|null
     */
    private $fullHierarchyValue;

    /**
     * @var string|null
     */
    private $additionalTextData;

    /**
     * @var string|null
     */
    private $slug;

    /**
     * @var Attribute|null
     */
    private $parent;

    /**
     * @var AttributeGroup
     */
    private $attributeGroup;

    /**
     * @param string $id
     * @param string $type
     * @param string|null $value
     * @param string|null $fullHierarchyValue
     * @param string|null $additionalTextData
     * @param string|null $slug
     * @param Attribute|null $parent
     * @param AttributeGroup $attributeGroup
     */
    public function __construct($id, $type, $value, $fullHierarchyValue, $additionalTextData, $slug,
        Attribute $parent = null, AttributeGroup $attributeGroup)
    {
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
        $this->fullHierarchyValue = $fullHierarchyValue;
        $this->additionalTextData = $additionalTextData;
        $this->slug = $slug;
        $this->parent = $parent;
        $this->attributeGroup = $attributeGroup;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getFullHierarchyValue()
    {
        return $this->fullHierarchyValue;
    }

    /**
     * @return string|null
     */
    public function getAdditionalTextData()
    {
        return $this->additionalTextData;
    }

    /**
     * @return string|null
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return Attribute|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return AttributeGroup
     */
    public function getAttributeGroup()
    {
        return $this->attributeGroup;
    }
}
