<?php
declare(strict_types=1);

namespace App\Application\Actions\Requisition;

use App\Application\Actions\Action;
use App\Domain\Requisition\Service\RequisitionSearch;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SearchRequisitionAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,RequisitionSearch $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

       
        $queryString =  $this->resolveArg('query');

        $formData = $this->service->search($queryString);

        return $this->respondWithData($formData);
    }
}
