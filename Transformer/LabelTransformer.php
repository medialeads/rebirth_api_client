<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Label;

class LabelTransformer extends AbstractTransformer
{
    /**
     * @param array $labels
     *
     * @return array
     */
    public static function doFromArray($labels)
    {
        $response = array();
        foreach ($labels as $label) {
            $response[] = new Label($label['id'], $label['project_id'], $label['name'], $label['slug']);
        }

        return $response;
    }
}