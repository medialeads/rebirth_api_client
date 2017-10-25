<?php

namespace Transformer;

require_once(__DIR__ . '/../Model/Product.php');
require_once(__DIR__ . '/../Model/Label.php');

use Model\Label;

class LabelTransformer
{
    public function fromArray($label)
    {
        return new Label($label['id'], $label['project_id'], $label['name'], $label['slug']);
    }
}