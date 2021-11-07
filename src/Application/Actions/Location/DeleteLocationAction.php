<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteLocationAction extends LocationAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $locationId = (int) $this->resolveArg('id');
        $location = $this->locationRepository->delete($locationId);

        $this->logger->info("Location of id `${locationId}` was deleted.");

        return $this->respondWithData($location);
    }
}
