<?php

namespace ES\RebirthApiClient\Model;

class Marking implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $fullHierarchyName;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var Marking|null
     */
    private $parent;

    /**
     * @param string $id
     * @param string $name
     * @param string $fullHierarchyName
     * @param string $slug
     * @param Marking|null $parent
     */
    public function __construct($id, $name, $fullHierarchyName, $slug, Marking $parent = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fullHierarchyName = $fullHierarchyName;
        $this->slug = $slug;
        $this->parent = $parent;
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
    public function getName()
    {
        return $this->name;
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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return Marking|null
     */
    public function getParent()
    {
        return $this->parent;
    }
}
