<?php

namespace Model;

abstract class AbstractImage
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $originalFilename;

    /** @var  string */
    private $url;

    /**
     * @param string $originalFilename
     * @param int $id
     * @param string $url
     */
    public function __construct(int $id, string $originalFilename, string $url)
    {
        $this->id = $id;
        $this->originalFilename = $originalFilename;
        $this->url = $url;
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
    public function getOriginalFilename(): string
    {
        return $this->originalFilename;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}