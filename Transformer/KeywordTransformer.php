<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Keyword;

class KeywordTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Keyword_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Keyword
     */
    protected function transform(array $data)
    {
        return new Keyword($data['id'], $data['value'], $data['slug']);
    }
}
