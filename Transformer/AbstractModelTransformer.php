<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\ModelInterface;

abstract class AbstractModelTransformer implements TransformerInterface
{
    /**
     * @var array
     */
    private static $cache = array();

    /**
     * @return AbstractModelTransformer
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param array|null $data
     *
     * @return ModelInterface|null
     */
    public final function transformOne(array $data = null)
    {
        if (null === $data) {
            return null;
        }

        $id = $this->getId($data);
        if (!isset(self::$cache[$id])) {
            self::$cache[$id] = $this->transform($data);
        }

        return self::$cache[$id];
    }

    /**
     * @param array $data
     *
     * @return ModelInterface[]
     */
    public final function transformMultiple(array $data)
    {
        $stack = array();
        foreach ($data as $row) {
            $model = $this->transformOne($row);
            $stack[$model->getId()] = $model;
        }

        return $stack;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    abstract protected function getId(array $data);

    /**
     * @param array $data
     *
     * @return ModelInterface
     */
    abstract protected function transform(array $data);
}
