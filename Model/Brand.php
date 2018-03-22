<?php

namespace ES\RebirthApiClient\Model;

class Brand extends AbstractModel
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
     * @var string|null
     */
    private $suffix;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param string $id
     * @param string $name
     * @param string|null $suffix
     * @param string $slug
     */
    public function __construct($id, $name, $suffix, $slug)
    {
        $this->id = $id;
        $this->name = $name;
        $this->suffix = $suffix;
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
     * @return string|null
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
