<?php

namespace Model;

class ProductImage extends AbstractImage
{
    /**
     * @param string $originalFilename
     * @param int $id
     * @param string $url
     */
    public function __construct(string $originalFilename, int $id, string $url)
    {
        parent::__construct($originalFilename, $id, $url);
    }
}