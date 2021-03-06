<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use App\Application\Actions\Action;
use App\Domain\Customer\Service\CustomerList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListCustomerAction extends Action
{

    
    private $service;

    public function __construct(LoggerInterface $logger,CustomerList $service)
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
