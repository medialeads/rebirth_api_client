<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantSize;

class VariantSizeTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantSize_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantSize
     */
    protected function transform(array $data)
    {
        return new VariantSize($data['id'], $data['type'], $data['value']);
    }
}
