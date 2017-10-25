<?php

namespace Model;

class MarkingPosition
{
    /** @var  string */
    private $projectId;

    /** @var  string */
    private $name;

    /** @var  int */
    private $id;

    /** @var  string */
    private $slug;

    /**
     * @param string $projectId
     * @param string $name
     * @param int $id
     * @param string $slug
     */
    public function __construct(string $projectId, string $name, int $id, string $slug)
    {
        $this->projectId = $projectId;
        $this->name = $name;
        $this->id = $id;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}