<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Category;

/**
 * @author Dagan MENEZ
 */
class CategoryTransformer extends AbstractTransformer
{
    /**
     * @param array $categories
     *
     * @return array
     */
    public static function doFromArray($categories)
    {
        $response = array();
        foreach ($categories as $category) {
            if (isset($category['synonyms'])) {
                $synonyms = SynonymTransformer::fromArray($category['synonyms']);
            }

            $response[] = new Category($category['id'], $category['full_hierarchy_name'], $category['project_id'], $category['parent_id'], $category['name'], $category['slug'], $synonyms);
        }

        return $response;
    }
}