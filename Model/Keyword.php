<?php

namespace ES\RebirthApiClient\Model;

class Keyword implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $value;

    /**
     * @var string|null
     */
    private $slug;

    /**
     * @param string $id
     * @param string|null $value
     * @param string|null $slug
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
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
