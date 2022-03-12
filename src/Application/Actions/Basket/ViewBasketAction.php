<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use Psr\Http\Message\ResponseInterface as Response;

class ViewBasketAction extends BasketAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $basketId = (int) $this->resolveArg('id');
        $this->logger->info("Basket of id `${basketId}` parameter was viewed.");
        $basket = $this->basketRepository->findById($basketId);
        $this->logger->info("Basket of id `${basketId}` was viewed.");

        return $this->respondWithData($basket);
    }
}
