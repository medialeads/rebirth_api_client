<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\MarkingPositionInterface;

class MarkingPosition extends AbstractModel implements MarkingPositionInterface
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
    private $slug;

    /**
     * @param string $id
     * @param string|null $name
     * @param string|null $slug
     */
    public function __construct($id, $name, $slug)
    {
        $this->id = $id;
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
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
