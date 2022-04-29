<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use App\Application\Actions\Action;
use App\Domain\Company\Service\CompanyList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListCompanyAction extends Action
{

    
    private $service;

    public function __construct(LoggerInterface $logger,CompanyList $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $data = $this->service->findAll();

        return $this->respondWithData($data);
    }
}
