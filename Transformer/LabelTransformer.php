<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Label;

class LabelTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Label_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Label
     */
    protected function transform(array $data)
    {
        return new Label($data['id'], $data['name'], $data['slug']);
    }
}
