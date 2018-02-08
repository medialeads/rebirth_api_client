<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\SupplierMarking;

class SupplierMarkingTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('SupplierMarking_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return SupplierMarking
     */
    protected function transform(array $data)
    {
        return new SupplierMarking($data['id'], $data['code'], $data['name_complement'], $data['comment']);
    }
}
