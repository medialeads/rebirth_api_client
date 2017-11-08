<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class Marking
{
    /**
     * @var string
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
     * @var null|string
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
     * @param string $id
     * @param string $fullHierarchyName
     * @param string $projectId
     * @param null|string $parentId
     * @param array $hierarchy
     * @param string $name
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
    public function getId()
    {
        return $this->id;
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
     * @return null|string
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
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}