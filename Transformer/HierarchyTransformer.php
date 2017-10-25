<?php

namespace Transformer;

require_once(__DIR__ . "/../Model/Hierarchy.php");

use Model\Hierarchy;

class HierarchyTransformer
{
    public function fromArray($hierarchy)
    {
        $type = null;
        if (array_key_exists('type', $hierarchy)) {
            $type = $hierarchy['type'];
        }

        $value = null;
        if (array_key_exists('value', $hierarchy)) {
            $value = $hierarchy['value'];
        }

        $slug = null;
        if (array_key_exists('slug', $hierarchy)) {
            $slug = $hierarchy['slug'];
        }

        return new Hierarchy($hierarchy['id'], $hierarchy['project_id'], $hierarchy['parent_id'], $type, $value, $slug);
    }
}