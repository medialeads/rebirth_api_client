<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/Product.php');
require_once(__DIR__ . '/../Model/Label.php');

use Model\Label;

class LabelTransformer extends AbstractTransformer
{
    public static function doFromArray(array $labels): array
    {
        $response = array();
        foreach ($labels as $label) {
            $response[] = new Label($label['id'], $label['project_id'], $label['name'], $label['slug']);
        }

        return $response;
    }
}