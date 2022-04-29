<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier;

use App\Application\Actions\Action;
use App\Domain\Supplier\Service\SupplierSearch;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SearchSupplierAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,SupplierSearch $service)
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
