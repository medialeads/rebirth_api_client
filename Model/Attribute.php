<?php

namespace ES\RebirthApiClient\Model;

class Attribute implements ModelInterface
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
    private $value;

    /**
     * @var string
     */
    private $fullHierarchyValue;

    /**
     * @var string|null
     */
    private $additionalTextData;

    /**
     * @var string
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
     * @param string $value
     * @param string $fullHierarchyValue
     * @param string|null $additionalTextData
     * @param string $slug
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
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
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
     * @return string
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
