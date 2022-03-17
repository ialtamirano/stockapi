<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use App\Application\Actions\Action;
use App\Domain\Basket\Service\BasketView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewBasketAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,BasketView $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        
        $id = (int) $this->resolveArg('id');

        $data = $this->service->view($id);

        $this->logger->info("Basket of id ".$data->id." was updated successfully.");

        return $this->respondWithData($data);
    }
}
