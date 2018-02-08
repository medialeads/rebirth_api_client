<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantPackagingSize;

class VariantPackagingSizeTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantPackagingSize_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantPackagingSize
     */
    protected function transform(array $data)
    {
        return new VariantPackagingSize($data['id'], $data['type'], $data['value']);
    }
}
