<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use App\Application\Actions\Action;
use App\Domain\Location\Service\LocationList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListLocationAction extends Action
{

    
    private $service;

    public function __construct(LoggerInterface $logger,LocationList $service)
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
