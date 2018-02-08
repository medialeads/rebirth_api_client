<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\SupplierProfile;

class SupplierProfileTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('SupplierProfile_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return SupplierProfile
     */
    protected function transform(array $data)
    {
        return new SupplierProfile($data['id'], $data['name'], $data['country_code'], $data['association']);
    }
}
