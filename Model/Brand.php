<?php

namespace Model;

class Brand
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $suffix;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param int $id
     * @param string $projectId
     * @param string $name
     * @param string $suffix
     * @param string $slug
     */
    public function __construct(int $id, string $projectId, string $name, string $suffix, string $slug)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->name = $name;
        $this->suffix = $suffix;
        $this->slug = $slug;
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
     * @return string
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}