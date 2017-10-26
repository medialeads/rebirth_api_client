<?php

namespace Transformer;

require_once(__DIR__ . '/AbstractTransformer.php');
require_once(__DIR__ . '/../Model/Category.php');

use Model\Category;

class CategoryTransformer extends AbstractTransformer
{
    public static function doFromArray(array $categories): array
    {
        $response = array();
        foreach ($categories as $category) {

            $response[] = new Category($category['id'], $category['full_hierarchy_name'], $category['project_id'], $category['parent_id'], $category['name'], $category['slug']);
        }

        return $response;
    }
}