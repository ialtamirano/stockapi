<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use App\Application\Actions\Action;
use App\Domain\Warehouse\Service\WarehouseView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewWarehouseAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,WarehouseView $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        
        $Id = (int) $this->resolveArg('id');

        $formData = $this->service->view($Id);

        $this->logger->info("Warehouse of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
