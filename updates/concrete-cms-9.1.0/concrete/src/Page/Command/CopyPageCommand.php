<?php

namespace Concrete\Core\Page\Command;

class CopyPageCommand extends PageCommand
{
    /**
     * @var int
     */
    protected $destinationPageID;

    /**
     * @var bool
     */
    protected $isMultilingual;

    /**
     * @var string
     */
    protected $copyBatchID;

    public function __construct(int $pageID, string $copyBatchID, int $destinationPageID, bool $isMultilingual = false)
    {
        parent::__construct($pageID);
        $this->setDestinationPageID($destinationPageID);
        $this->copyBatchID = $copyBatchID;
        $this->isMultilingual = $isMultilingual;
    }

    public function getDestinationPageID(): int
    {
        return $this->destinationPageID;
    }

    /**
     * @return $this
     */
    public function setDestinationPageID(int $destinationPageID): object
    {
        $this->destinationPageID = $destinationPageID;

        return $this;
    }

    public function isMultilingualCopy(): bool
    {
        return $this->isMultilingual;
    }

    /**
     * @return string
     */
    public function getCopyBatchID(): string
    {
        return $this->copyBatchID;
    }


}
