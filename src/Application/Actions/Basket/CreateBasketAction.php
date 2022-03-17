<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use App\Application\Actions\Action;
use App\Domain\Basket\Service\BasketCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateBasketAction extends Action
{

    
    private $basketCreate;

    public function __construct( LoggerInterface $logger,BasketCreate $basketCreate)
    {
        parent::__construct($logger);
       
        $this->basketCreate = $basketCreate;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $formData = $this->getFormData();

        $formData->id = $this->basketCreate->create($formData);

        $this->logger->info("Basket of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
