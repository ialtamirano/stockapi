<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use App\Application\Actions\Action;
use App\Domain\Company\Service\CompanyDelete;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DeleteCompanyAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CompanyDelete $service)
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

        $this->logger->info("Company of id ".$Id." was deleted successfully.");

        return $this->respondWithData($result);
    }
}
