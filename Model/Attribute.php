<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class Attribute
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var AttributeGroup
     */
    private $attributeGroup;

    /**
     * @var string
     */
    private $parentId;

    /**
     * @var array
     */
    private $hierarchy;

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
    private $slug;

    /**
     * @param string $id
     * @param string $projectId
     * @param AttributeGroup $attributeGroup
     * @param string $parentId
     * @param array $hierarchy
     * @param string $type
     * @param string $value
     * @param string $slug
     */
    public function __construct($id, $projectId, AttributeGroup $attributeGroup, $parentId, $hierarchy, $type, $value, $slug)
    {
        if (!$attributeGroup instanceof AttributeGroup) {
            throw new \InvalidArgumentException();
        }

        $this->projectId = $projectId;
        $this->attributeGroup = $attributeGroup;
        $this->parentId = $parentId;
        $this->hierarchy = $hierarchy;
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
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
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return AttributeGroup
     */
    public function getAttributeGroup()
    {
        return $this->attributeGroup;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @return array
     */
    public function getHierarchy()
    {
        return $this->hierarchy;
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
    public function getSlug()
    {
        return $this->slug;
    }
}