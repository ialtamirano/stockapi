<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use App\Application\Actions\Action;
use App\Domain\Warehouse\Service\WarehouseCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateWarehouseAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,WarehouseCreate $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $formData = $this->getFormData();

        $formData->id = $this->service->create($formData);

        $this->logger->info("Warehouse of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
