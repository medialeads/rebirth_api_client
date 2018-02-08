<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Brand;

class BrandTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Brand_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Brand
     */
    protected function transform(array $data)
    {
        return new Brand($data['id'], $data['name'], $data['suffix'], $data['slug']);
    }
}
