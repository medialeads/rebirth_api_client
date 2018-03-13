<?php

namespace ES\RebirthApiClient\Model;

class Marking extends AbstractModel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $fullHierarchyName;

    /**
     * @var string|null
     */
    private $slug;

    /**
     * @var Marking|null
     */
    private $parent;

    /**
     * @param string $id
     * @param string|null $name
     * @param string|null $fullHierarchyName
     * @param string|null $slug
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
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getFullHierarchyName()
    {
        return $this->fullHierarchyName;
    }

    /**
     * @return string|null
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
