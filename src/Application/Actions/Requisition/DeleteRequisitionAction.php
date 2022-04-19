<?php
declare(strict_types=1);

namespace App\Application\Actions\Requisition;

use App\Application\Actions\Action;
use App\Domain\Requisition\Service\RequisitionDelete;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DeleteRequisitionAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,RequisitionDelete $service)
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

        $result = $this->service->delete($Id);

        $this->logger->info("Requisition of id ".$Id." was deleted successfully.");

        return $this->respondWithData($result);
    }
}
