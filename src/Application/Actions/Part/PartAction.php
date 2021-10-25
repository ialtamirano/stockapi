<?php
declare(strict_types=1);

namespace App\Application\Actions\Part;

use App\Application\Actions\Action;
use App\Domain\Part\PartRepository;
use Psr\Log\LoggerInterface;

abstract class PartAction extends Action
{
    /**
     * @var PartRepository
     */
    protected $partRepository;

    /**
     * @param LoggerInterface $logger
     * @param PartRepository $partRepository
     */
    public function __construct(
        LoggerInterface $logger,
        PartRepository $partRepository
    ) {
        parent::__construct($logger);
        $this->partRepository = $partRepository;
    }
}
