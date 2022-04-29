<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use App\Application\Actions\Action;
use App\Domain\Warehouse\Service\WarehouseSearch;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SearchWarehouseAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,WarehouseSearch $service)
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
