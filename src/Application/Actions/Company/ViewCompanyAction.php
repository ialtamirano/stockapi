<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use App\Application\Actions\Action;
use App\Domain\Company\Service\CompanyView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewCompanyAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CompanyView $service)
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

        $this->logger->info("Company of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
