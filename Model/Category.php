<?php

namespace ES\RebirthApiClient\Model;

class Category implements ModelInterface
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
     * @param string $id
     * @param string|null $name
     * @param string|null $fullHierarchyName
     * @param string|null $slug
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
}
