<?php
declare(strict_types=1);

namespace App\Application\Actions\Account;

use App\Application\Actions\Action;
use App\Domain\Account\Service\AccountCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateAccountAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,AccountCreate $service)
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

        $this->logger->info("Account of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
