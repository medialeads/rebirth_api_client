<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/Marking.php");

use Model\Marking;

class MarkingTransformer extends AbstractTransformer
{
    public static function doFromArray(array $markings): array
    {
        $response = array();
        foreach ($markings as $marking) {
            foreach ($marking['hierarchy'] as $hierarchy) {
                if (isset($hierarchy['id']) && $hierarchy['id'] = $marking['parent_id']) {
                    $parent = $hierarchy;
                }
            }
            $response[] = new Marking($marking['id'], $marking['full_hierarchy_name'], $marking['project_id'], $marking['parent_id'], $hierarchy, $marking['name'], $marking['slug']);
        }

        return $response;
    }
}