<?php

namespace Transformer;

use Model\Marking;

class MarkingTransformer extends AbstractTransformer
{
    public static function doFromArray(array $markings): array
    {
        $response = array();
        foreach ($markings as $marking) {
            $hierarchy = HierarchyTransformer::fromArray($marking['hierarchy']);
            $response[] = new Marking($marking['id'], $marking['full_hierarchy_name'], $marking['project_id'], $marking['parent_id'], $hierarchy, $marking['name'], $marking['slug']);
        }

        return $response;
    }
}