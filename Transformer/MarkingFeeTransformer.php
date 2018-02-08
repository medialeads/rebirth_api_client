<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\MarkingFee;

class MarkingFeeTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('MarkingFee_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return MarkingFee
     */
    protected function transform(array $data)
    {
        return new MarkingFee($data['id'], $data['name'], $data['slug']);
    }
}
