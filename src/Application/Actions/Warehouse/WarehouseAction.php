<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use App\Application\Actions\Action;
use App\Domain\Warehouse\WarehouseRepository;
use Psr\Log\LoggerInterface;

abstract class WarehouseAction extends Action
{
    /**
     * @var WarehouseRepository
     */
    protected $warehouseRepository;

    /**
     * @param LoggerInterface $logger
     * @param WarehouseRepository $warehouseRepository
     */
    public function __construct(
        LoggerInterface $logger,
        WarehouseRepository $warehouseRepository
    ) {
        parent::__construct($logger);
        $this->warehouseRepository = $warehouseRepository;
    }
}
