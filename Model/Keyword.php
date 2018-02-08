<?php

namespace ES\RebirthApiClient\Model;

class Keyword implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param string $id
     * @param string $value
     * @param string $slug
     */
    public function __construct($id, $value, $slug)
    {
        $this->id = $id;
        $this->value = $value;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
