<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\ModelInterface;

abstract class AbstractModel implements ModelInterface
{
    /**
     * @return string
     */
    public function getUniqueId()
    {
        return sprintf('%s_%s', get_class($this), $this->getId());
    }

    /**
     * @return string
     */
    abstract public function getId();
}
