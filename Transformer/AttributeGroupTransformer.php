<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\AttributeGroup;

class AttributeGroupTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('AttributeGroup_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return AttributeGroup
     */
    protected function transform(array $data)
    {
        return new AttributeGroup($data['id'], $data['type'], $data['name'], $data['additional_text_data_type'],
            $data['slug']);
    }
}
