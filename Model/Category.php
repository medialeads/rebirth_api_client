<?php

namespace Model;

class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $fullHierarchyName;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var int
     */
    private $parentId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;


    /**
     * @param int $id
     * @param string $fullHierarchyName
     * @param string $projectId
     * @param int $parentId
     * @param string $name
     * @param string $slug
     */
    public function __construct(int $id, string $fullHierarchyName, string $projectId, int $parentId, string $name, string $slug)
    {
        $this->id = $id;
        $this->fullHierarchyName = $fullHierarchyName;
        $this->projectId = $projectId;
        $this->parentId = $parentId;
        $this->name = $name;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}