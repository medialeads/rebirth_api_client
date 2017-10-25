<?php

namespace Model;

class SupplierMarking
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
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
     * @var string|null
     */
    private $comment;

    public function __construct(int $id, mixed $nameComplement, string $code, string $projectId, mixed $comment)
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
    public function getId(): int
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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
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