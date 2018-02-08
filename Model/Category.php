<?php

namespace ES\RebirthApiClient\Model;

class Category implements ModelInterface
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
     * @param string $id
     * @param string $name
     * @param string $fullHierarchyName
     * @param string $slug
     */
    public function __construct($id, $name, $fullHierarchyName, $slug)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fullHierarchyName = $fullHierarchyName;
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
}
