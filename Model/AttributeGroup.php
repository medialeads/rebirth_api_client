<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class AttributeGroup
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
    private $slug;

    /**
     * @var string
     */
    private $additionalTextDataType;

    /**
     * @param string $id
     * @param string $projectId
     * @param string $name
     * @param string $slug
     */
    public function __construct($id, $projectId, $name, $slug, $additionalTextDataType)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->name = $name;
        $this->slug = $slug;
        $this->additionalTextDataType = $additionalTextDataType;
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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getAdditionalTextDataType()
    {
        return $this->additionalTextDataType;
    }
}