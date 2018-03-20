<?php

namespace ES\RebirthApiClient\Util\Model;

use ES\RebirthCommon\MarkingInterface;
use ES\RebirthCommon\SupplierMarkingInterface;
use ES\RebirthCommon\VariantMarkingOptionsInterface;

class MarkingProcessedVariantMarkingOption extends AbstractProcessedVariantMarkingOption
{
    /**
     * @var MarkingInterface
     */
    private $marking;

    /**
     * @var SupplierMarkingInterface|null
     */
    private $supplierMarking;

    /**
     * @param MarkingInterface $marking
     * @param SupplierMarkingInterface|null $supplierMarking
     */
    public function __construct(MarkingInterface $marking, SupplierMarkingInterface $supplierMarking = null)
    {
        parent::__construct(VariantMarkingOptionsInterface::MARKING);

        $this->marking = $marking;
        $this->supplierMarking = $supplierMarking;
    }

    /**
     * @return MarkingInterface
     */
    public function getMarking()
    {
        return $this->marking;
    }

    /**
     * @return SupplierMarkingInterface|null
     */
    public function getSupplierMarking()
    {
        return $this->supplierMarking;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        $uniqueId = sprintf('%s_%s_%s', get_class($this), $this->name, $this->marking->getUniqueId());
        if ($this->supplierMarking instanceof SupplierMarkingInterface && is_string($this->supplierMarking->getNameComplement())) {
            $uniqueId .= sprintf('_%s', $this->supplierMarking->getUniqueId());
        }

        return $uniqueId;
    }
}
