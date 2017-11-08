<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class VariantExternalLink
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $url;

    /**
     * @param string $id
     * @param string $type
     * @param string $url
     */
    public function __construct($id, $type, $url)
    {
        $this->id = $id;
        $this->type = $type;
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