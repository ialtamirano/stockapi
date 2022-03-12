<?php
declare(strict_types=1);

namespace App\Application\Actions\PartNumber;

use App\Application\Actions\Action;
use App\Domain\PartNumber\Service\PartNumberSearch;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SearchPartNumberAction extends Action
{

    
    private $partNumberSearch;

    public function __construct( LoggerInterface $logger,PartNumberSearch $partNumberSearch)
    {
        parent::__construct($logger);
       
        $this->partNumberSearch = $partNumberSearch;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

       
        $queryString =  $this->resolveArg('query');

        $partNumberFormData = $this->partNumberSearch->search($queryString);

        return $this->respondWithData($partNumberFormData);
    }
}
