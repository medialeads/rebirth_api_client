<?php

namespace ES\APIv2Client\Model;

abstract class AbstractImage
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $originalFilename;

    /**
     * @var string
     */
    private $url;

    /**
     * @param string $id
     * @param string $originalFilename
     * @param string $url
     */
    public function __construct($id, $originalFilename, $url)
    {
        $this->id = $id;
        $this->originalFilename = $originalFilename;
        $this->url = $url;
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
    public function getOriginalFilename()
    {
        return $this->originalFilename;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}