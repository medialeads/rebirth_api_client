<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\PartialSupplierProfile;

class PartialSupplierProfileTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('PartialSupplierProfile_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return PartialSupplierProfile
     */
    protected function transform(array $data)
    {
        return new PartialSupplierProfile($data['id'], $data['country_code']);
    }
}
