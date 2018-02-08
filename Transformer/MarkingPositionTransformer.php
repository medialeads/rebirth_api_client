<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\MarkingPosition;

class MarkingPositionTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('MarkingPosition_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return MarkingPosition
     */
    protected function transform(array $data)
    {
        return new MarkingPosition($data['id'], $data['name'], $data['slug']);
    }
}
