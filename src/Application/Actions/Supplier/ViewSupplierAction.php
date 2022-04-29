<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier;

use App\Application\Actions\Action;
use App\Domain\Supplier\Service\SupplierView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewSupplierAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,SupplierView $service)
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

        $this->logger->info("Supplier of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
