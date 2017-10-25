<?php

namespace Model;

class DynamicVariablePriceHolder
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
     * @var string
     */
    private $projectId;

    /**
     * @var array
     */
    private $markingFees;

    /**
     * @var array
     */
    private $dynamicVariablePrices;

    /**
     * @var SupplierProfile
     */
    private $supplierProfile;

    /**
     * @param int $id
     * @param $condition
     * @param bool $totalPrice
     * @param string $projectId
     * @param array $markingFees
     * @param array $dynamicVariablePrices
     * @param SupplierProfile $supplierProfile
     */
    public function __construct(int $id, $condition, bool $totalPrice, string $projectId, array $markingFees, array $dynamicVariablePrices, SupplierProfile $supplierProfile)
    {
        foreach ($markingFees as $markingFee) {
            if (!$markingFee instanceof MarkingFee) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($dynamicVariablePrices as $dynamicVariablePrice) {
            if (!$dynamicVariablePrice instanceof DynamicVariablePrice) {
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
        $this->dynamicVariablePrices = $dynamicVariablePrices;
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
    public function getDynamicVariablePrices(): array
    {
        return $this->dynamicVariablePrices;
    }

    /**
     * @return SupplierProfile
     */
    public function getSupplierProfile(): SupplierProfile
    {
        return $this->supplierProfile;
    }
}