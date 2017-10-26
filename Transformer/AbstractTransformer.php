<?php

namespace Transformer;

abstract class AbstractTransformer
{
    public final static function fromArray($array)
    {
        if (null === $array) {
            return null;
        }
        reset($array);
        $key = key($array);
        $simple = false;
        if (!empty($array)) {
            $simple = !is_int($key) || $key !== 0;
            if ($simple) {
                $array = array($array);
            }
        }

        $response = static::doFromArray($array);

        if ($simple) {
            return reset($response);
        }

        return $response;
    }

    /**
     * @param array $array
     * @return array
     */
    abstract protected static function doFromArray(array $array): array;
}