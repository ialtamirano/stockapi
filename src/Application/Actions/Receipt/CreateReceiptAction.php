<?php
declare(strict_types=1);

namespace App\Application\Actions\Receipt;

use App\Application\Actions\Action;
use App\Domain\Receipt\Service\ReceiptCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateReceiptAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,ReceiptCreate $service)
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

        $this->logger->info("Receipt of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
