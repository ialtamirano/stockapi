<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use App\Application\Actions\Action;
use App\Domain\Basket\Service\BasketUpdate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class UpdateBasketAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,BasketUpdate $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $data = $this->getFormData();
        $id = (int) $this->resolveArg('id');

        $data->id = $this->service->update($id,$data);

        $this->logger->info("Basket of id ".$data->id." was updated successfully.");

        return $this->respondWithData($data);
    }
}
