<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use Psr\Http\Message\ResponseInterface as Response;

class ListLocationAction extends LocationAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $locations = $this->locationRepository->findAll();

        $this->logger->info("Location list was viewed.");

        return $this->respondWithData($locations);
    }
}
