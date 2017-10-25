<?php

namespace Transformer;

abstract class AbstractTransformer
{
    public final static function fromArray(array $array)
    {
        reset($array);
        $key = key($array);
        $simple = false;

        if (!is_int($key) || $key !== 0) {
            $array = array($array);
            $simple = true;
        }

        $response = static::fromArray($array);

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