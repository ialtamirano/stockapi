<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier;

use App\Application\Actions\Action;
use App\Domain\Supplier\SupplierRepository;
use Psr\Log\LoggerInterface;

abstract class SupplierAction extends Action
{
    /**
     * @var SupplierRepository
     */
    protected $supplierRepository;

    /**
     * @param LoggerInterface $logger
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(
        LoggerInterface $logger,
        SupplierRepository $supplierRepository
    ) {
        parent::__construct($logger);
        $this->supplierRepository = $supplierRepository;
    }
}
