<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Category;

class CategoryTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Category_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Category
     */
    protected function transform(array $data)
    {
        return new Category($data['id'], $data['name'], $data['full_hierarchy_name'], $data['slug']);
    }
}
