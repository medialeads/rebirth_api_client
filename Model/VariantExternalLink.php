<?php

namespace Model;

class VariantExternalLink
{
    /**
     * @var  int
     */
    private $id;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $url;

    /**
     * @param int $id
     * @param string $projectId
     * @param string $type
     * @param string $url
     */
    public function __construct(int $id, string $projectId, string $type, string $url)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->type = $type;
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
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


}