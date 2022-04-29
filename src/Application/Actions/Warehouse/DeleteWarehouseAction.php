<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use App\Application\Actions\Action;
use App\Domain\Warehouse\Service\WarehouseDelete;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DeleteWarehouseAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,WarehouseDelete $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        //$partNumberFormData = $this->getFormData();
        $Id = (int) $this->resolveArg('id');

        $result = $this->service->delete($Id);

        $this->logger->info("Warehouse of id ".$Id." was deleted successfully.");

        return $this->respondWithData($result);
    }
}
