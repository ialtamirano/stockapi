<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use Psr\Http\Message\ResponseInterface as Response;

class CreateBasketAction extends BasketAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $basket = $this->getFormData();
       
        $basket->id = $this->basketRepository->create($basket);

        $this->logger->info("Basket of id `$basket->id` was created.");

        return $this->respondWithData($basket);
    }
}
