<?php

namespace ES\APIv2Client\Model;

class SupplierMarking
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var null|string
     */
    private $nameComplement;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var null|string
     */
    private $comment;

    public function __construct($id, $nameComplement, $code, $projectId, $comment)
    {
        $this->id = $id;
        $this->nameComplement = $nameComplement;
        $this->code;
        $this->projectId = $projectId;
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getNameComplement()
    {
        return $this->nameComplement;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return null|string
     */
    public function getComment()
    {
        return $this->comment;
    }
}