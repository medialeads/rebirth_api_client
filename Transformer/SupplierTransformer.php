<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Supplier;

class SupplierTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Supplier_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Supplier
     */
    protected function transform(array $data)
    {
        return new Supplier($data['id'], $data['vat_identification_number'], $data['name'], $data['legal_name'],
            $data['slug'], SupplierProfileTransformer::create()->transformMultiple($data['supplier_profiles']));
    }
}
