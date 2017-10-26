<?php

namespace ES\APIv2Client\Model;

class Marking
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
     * @var array
     */
    private $hierarchy;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
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
    public function __construct($id, $fullHierarchyName, $projectId, $parentId, $hierarchy, $name, $slug)
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
    public function getFullHierarchyName()
    {
        return $this->fullHierarchyName;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
    public function getSlug()
    {
        return $this->slug;
    }
}