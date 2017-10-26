<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Category;

class CategoryTransformer extends AbstractTransformer
{
    /**
     * @param array $categories
     *
     * @return array
     */
    public static function doFromArray(array $categories): array
    {
        $response = array();
        foreach ($categories as $category) {

            $response[] = new Category($category['id'], $category['full_hierarchy_name'], $category['project_id'], $category['parent_id'], $category['name'], $category['slug']);
        }

        return $response;
    }
}