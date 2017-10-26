<?php

namespace Model;

class ProductImage extends AbstractImage
{
    /**
     * @param int $id
     * @param string $originalFilename
     * @param string $url
     */
    public function __construct(int $id, string $originalFilename, string $url)
    {
        parent::__construct($id, $originalFilename, $url);
    }
}