<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class VariantImage extends AbstractImage
{
    /**
     * @param string $id
     * @param string $originalFilename
     * @param string $url
     */
    public function __construct($id, $originalFilename, $url)
    {
        parent::__construct($id, $originalFilename, $url);
    }
}