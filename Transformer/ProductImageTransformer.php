<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\ProductImage;

class ProductImageTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('ProductImage_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return ProductImage
     */
    protected function transform(array $data)
    {
        return new ProductImage($data['id'], $data['original_filename'], $data['url']);
    }
}
