<?php

namespace Model;

require_once(__DIR__ . '/AbstractImage.php');

class VariantImage extends AbstractImage
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