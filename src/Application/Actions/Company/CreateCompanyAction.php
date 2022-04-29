<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use App\Application\Actions\Action;
use App\Domain\Company\Service\CompanyCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateCompanyAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CompanyCreate $service)
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

        $this->logger->info("Company of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
