<?php

namespace ES\APIv2Client\Model;

class MarkingPosition
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param int $id
     * @param string $projectId
     * @param string $name
     * @param string $slug
     */
    public function __construct($id, $projectId, $name, $slug)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
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