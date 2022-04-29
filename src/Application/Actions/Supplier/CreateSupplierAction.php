<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier;

use App\Application\Actions\Action;
use App\Domain\Supplier\Service\SupplierCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateSupplierAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,SupplierCreate $service)
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

        $this->logger->info("Supplier of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
