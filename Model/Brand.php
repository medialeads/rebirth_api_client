<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class Brand
{
    /**
     * @var string
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
    private $suffix;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param string $id
     * @param string $projectId
     * @param string $name
     * @param string $suffix
     * @param string $slug
     */
    public function __construct($id, $projectId, $name, $suffix, $slug)
    {
        $this->id = $id;
        $this->projectId = $projectId;
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
     * @return string
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