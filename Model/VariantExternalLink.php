<?php

namespace ES\APIv2Client\Model;

class VariantExternalLink
{
    /**
     * @var  int
     */
    private $id;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $url;

    /**
     * @param int $id
     * @param string $projectId
     * @param string $type
     * @param string $url
     */
    public function __construct($id, $projectId, $type, $url)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->type = $type;
        $this->url = $url;
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
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


}