<?php

namespace Model;

class Hierarchy
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $projectId;

    /** @var  int|null */
    private $parentId;

    /** @var  string|null */
    private $type;

    /** @var  string|null */
    private $value;

    /** @var  string|null */
    private $slug;

    /**
     * @param int $id
     * @param string $projectId
     * @param mixed $parentId
     * @param mixed $type
     * @param mixed $value
     * @param mixed $slug
     */
    public function __construct(int $id, string $projectId, mixed $parentId, mixed $type, mixed $value, mixed $slug)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->parentId = $parentId;
        $this->type = $type;
        $this->value = $value;
        $this->slug = $slug;
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
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return null|string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}