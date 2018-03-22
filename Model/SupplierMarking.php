<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\SupplierMarkingInterface;

class SupplierMarking extends AbstractModel implements SupplierMarkingInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string|null
     */
    private $nameComplement;

    /**
     * @var string|null
     */
    private $comment;

    /**
     * @param string $id
     * @param string $code
     * @param string|null $nameComplement
     * @param string|null $comment
     */
    public function __construct($id, $code, $nameComplement, $comment)
    {
        $this->id = $id;
        $this->code = $code;
        $this->nameComplement = $nameComplement;
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getNameComplement()
    {
        return $this->nameComplement;
    }

    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }
}
