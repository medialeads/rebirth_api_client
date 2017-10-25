<?php

namespace Model;

class StaticVariablePriceHolder
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var
     */
    private $condition;

    /**
     * @var bool
     */
    private $totalPrice;

    /**
     * @var int
     */
    private $projectId;

    /**
     * @var array
     */
    private $markingFees;

    /**
     * @var array
     */
    private $staticVariablePrices;

    /**
     * @var SupplierProfile
     */
    private $supplierProfile;

    /**
     * @param $condition
     * @param bool $totalPrice
     * @param string $projectId
     * @param array $markingFees
     * @param array $staticVariablePrices
     * @param int $id
     */
    public function __construct(int $id, $condition, bool $totalPrice, string $projectId, array $markingFees, array $staticVariablePrices, SupplierProfile $supplierProfile)
    {
        foreach ($markingFees as $markingFee) {
            if (!$markingFee instanceof MarkingFee) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($staticVariablePrices as $staticVariablePrice) {
            if (!$staticVariablePrice instanceof StaticVariablePrice) {
                throw new \InvalidArgumentException();
            }
        }

        if (!$supplierProfile instanceof SupplierProfile)
        {
            throw new InvalidArgumentException();
        }

        $this->id = $id;
        $this->condition = $condition;
        $this->totalPrice = $totalPrice;
        $this->markingFees = $markingFees;
        $this->staticVariablePrices = $staticVariablePrices;
        $this->supplierProfile = $supplierProfile;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @return bool
     */
    public function isTotalPrice(): bool
    {
        return $this->totalPrice;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return array
     */
    public function getMarkingFees(): array
    {
        return $this->markingFees;
    }

    /**
     * @return array
     */
    public function getStaticVariablePrices(): array
    {
        return $this->staticVariablePrices;
    }

    /**
     * @return SupplierProfile
     */
    public function getSupplierProfile(): SupplierProfile
    {
        return $this->supplierProfile;
    }
}