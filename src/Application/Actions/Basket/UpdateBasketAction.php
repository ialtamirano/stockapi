<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateBasketAction extends BasketAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $basketId = (int) $this->resolveArg('id');
        $basket = $this->getFormData();
       
        $basket->id = $this->basketRepository->update($basketId,$basket);

        $this->logger->info("Basket of id `$basket->id` was updated.");

        return $this->respondWithData($basket);
    }
}
