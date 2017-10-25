<?php

namespace Model;

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
    public function __construct(string $projectId, AttributeGroup $attributeGroup, int $parentId, array $hierarchy, int $id, string $type, string $value, string $slug)
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
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return AttributeGroup
     */
    public function getAttributeGroup(): AttributeGroup
    {
        return $this->attributeGroup;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @return array
     */
    public function getHierarchy(): array
    {
        return $this->hierarchy;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}