<?php

namespace Model;

abstract class AbstractImage
{
    /** @var  string */
    private $originalFilename;

    /** @var  int */
    private $id;

    /** @var  string */
    private $url;

    /**
     * @param string $originalFilename
     * @param int $id
     * @param string $url
     */
    public function __construct(string $originalFilename, int $id, string $url)
    {
        $this->originalFilename = $originalFilename;
        $this->id = $id;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getOriginalFilename(): string
    {
        return $this->originalFilename;
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
    public function getUrl(): string
    {
        return $this->url;
    }
}