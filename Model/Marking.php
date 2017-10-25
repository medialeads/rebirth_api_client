<?php

namespace Model;

class Marking
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $fullHierarchyName;

    /** @var  string */
    private $projectId;

    /** @var  int */
    private $parentId;

    /** @var  array */
    private $hierarchy;

    /** @var  string */
    private $name;

    /** @var  string */
    private $slug;

    /**
     * @param string $fullHierarchyName
     * @param string $projectId
     * @param int $parentId
     * @param array $hierarchy
     * @param string $name
     * @param int $id
     * @param string $slug
     */
    public function __construct(int $id, string $fullHierarchyName, string $projectId, int $parentId, array $hierarchy, string $name, string $slug)
    {
        $this->id = $id;
        $this->fullHierarchyName = $fullHierarchyName;
        $this->projectId = $projectId;
        $this->hierarchy = $hierarchy;
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getFullHierarchyName(): string
    {
        return $this->fullHierarchyName;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getSlug(): string
    {
        return $this->slug;
    }
}