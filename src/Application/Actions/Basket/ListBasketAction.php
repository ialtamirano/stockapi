<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use Psr\Http\Message\ResponseInterface as Response;

class ListBasketAction extends BasketAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $baskets = $this->basketRepository->findAll();

        $this->logger->info("Basket list was viewed.");

        return $this->respondWithData($baskets);
    }
}
