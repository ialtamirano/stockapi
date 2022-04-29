<?php
declare(strict_types=1);

namespace App\Application\Actions\Receipt;

use App\Application\Actions\Action;
use App\Domain\Receipt\Service\ReceiptUpdate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class UpdateReceiptAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,ReceiptUpdate $service)
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
        $Id = (int) $this->resolveArg('id');

        $formData->id = $this->service->update($Id,$formData);

        $this->logger->info("Receipt of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
