<?php
declare(strict_types=1);

namespace App\Application\Actions\PartNumber;

use App\Application\Actions\Action;
use App\Domain\PartNumber\Service\PartNumberList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListPartNumberAction extends Action
{

    
    private $partNumberList;

    public function __construct(LoggerInterface $logger,PartNumberList $partNumberList)
    {
        parent::__construct($logger);
       
        $this->partNumberList = $partNumberList;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $parts = $this->partNumberList->findAll();

        return $this->respondWithData($parts);
    }
}
