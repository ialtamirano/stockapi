<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use App\Application\Actions\Action;
use App\Domain\Location\LocationRepository;
use Psr\Log\LoggerInterface;

abstract class LocationAction extends Action
{
    /**
     * @var LocationRepository
     */
    protected $locationRepository;

    /**
     * @param LoggerInterface $logger
     * @param LocationRepository $locationRepository
     */
    public function __construct(
        LoggerInterface $logger,
        LocationRepository $locationRepository
    ) {
        parent::__construct($logger);
        $this->locationRepository = $locationRepository;
    }
}
