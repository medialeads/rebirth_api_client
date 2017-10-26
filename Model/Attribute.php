<?php

namespace ES\APIv2Client\Model;

class Attribute
{
    /** @var  string */
    private $projectId;

    /** @var  AttributeGroup */
    private $attributeGroup;

    /** @var  int */
    private $parentId;

    /** @var  array */
    private $hierarchy;

    /** @var  int */
    private $id;

    /** @var  string */
    private $type;

    /** @var  string */
    private $value;

    /** @var  string */
    private $slug;

    /**
     * @param string $projectId
     * @param AttributeGroup $attributeGroup
     * @param int $parentId
     * @param array $hierarchy
     * @param int $id
     * @param string $type
     * @param string $value
     * @param string $slug
     */
    public function __construct($projectId, $attributeGroup, $parentId, $hierarchy, $id, $type, $value, $slug)
    {
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
     * @return int
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
     * @return int
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
    public function getSlug()
    {
        return $this->slug;
    }
}