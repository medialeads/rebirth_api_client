<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantImage;

class VariantImageTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantImage_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantImage
     */
    protected function transform(array $data)
    {
        return new VariantImage($data['id'], $data['original_filename'], $data['url']);
    }
}
