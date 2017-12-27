<?php

namespace ES\APIv2Client\Model;

class VariantPackagingSize
{
    /**
     * @var string
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
     * @var float
     */
    private $value;

    /**
     * @param string $id
     * @param string $projectId
     * @param string $type
     * @param float $value
     */
    public function __construct($id, $projectId, $type, $value)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->type = $type;
        $this->value = $value;
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
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}