<?php
declare(strict_types=1);

namespace App\Application\Actions\Requisition;

use App\Application\Actions\Action;
use App\Domain\Requisition\Service\RequisitionList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListRequisitionAction extends Action
{

    
    private $service;

    public function __construct(LoggerInterface $logger,RequisitionList $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $entity_name =  $this->request->getQueryParams()['entity_name'];
        $entity_id   =  $this->request->getQueryParams()['entity_id'];

        $data = $this->service->findAll( $entity_name,$entity_id);

        return $this->respondWithData($data);
    }
}
