<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Keyword;

/**
 * @author Dagan MENEZ
 */
class KeywordTransformer extends AbstractTransformer
{
    /**
     * @param array $keywords
     *
     * @return array
     */
    public static function doFromArray($keywords)
    {
        $response = array();
        foreach ($keywords as $keyword) {
            $response[] = new Keyword($keyword['id'], $keyword['project_id'], $keyword['value'], $keyword['slug']);
        }

        return $response;
    }
}