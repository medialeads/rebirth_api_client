<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class Synonym
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
    private $value;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param $id
     * @param $projectId
     * @param $value
     * @param $slug
     */
    public function __construct($id, $projectId, $value, $slug)
    {
        $this->id = $id;
        $this->projectId = $projectId;
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
    public function getProjectId()
    {
        return $this->projectId;
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