<?php

namespace ES\APIv2Client\Model;

class ProductImage extends AbstractImage
{
    /**
     * @param int $id
     * @param string $originalFilename
     * @param string $url
     */
    public function __construct($id, $originalFilename, $url)
    {
        parent::__construct($id, $originalFilename, $url);
    }
}