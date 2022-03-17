<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use App\Application\Actions\Action;
use App\Domain\Basket\Service\BasketList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListBasketAction extends Action
{

    
    private $service;

    public function __construct(LoggerInterface $logger,BasketList $service)
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
