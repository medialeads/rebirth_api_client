<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Synonym;

/**
 * @author Dagan MENEZ
 */
class SynonymTransformer extends AbstractTransformer
{
    /**
     * @param array $synonyms
     *
     * @return array
     */
    public static function doFromArray($synonyms)
    {
        $response = array();
        foreach ($synonyms as $synonym) {
            $response[] = new Synonym($synonym['id'], $synonym['project_id'], $synonym['name'], $synonym['slug']);
        }

        return $response;
    }
}