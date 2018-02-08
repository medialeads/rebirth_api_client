<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantExternalLink;

class VariantExternalLinkTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantExternalLink_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantExternalLink
     */
    protected function transform(array $data)
    {
        return new VariantExternalLink($data['id'], $data['type'], $data['url']);
    }
}
