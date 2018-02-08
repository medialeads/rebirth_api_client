<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\ModelInterface;

interface TransformerInterface
{
    /**
     * @param array|null $data
     *
     * @return ModelInterface|null
     */
    public function transformOne(array $data = null);

    /**
     * @param array $data
     *
     * @return ModelInterface[]
     */
    public function transformMultiple(array $data);
}
