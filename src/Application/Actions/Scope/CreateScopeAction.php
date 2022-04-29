<?php
declare(strict_types=1);

namespace App\Application\Actions\Scope;

use App\Application\Actions\Action;
use App\Domain\Scope\Service\ScopeCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateScopeAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,ScopeCreate $service)
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

        $this->logger->info("Scope of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
