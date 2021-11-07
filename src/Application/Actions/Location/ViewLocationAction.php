<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use Psr\Http\Message\ResponseInterface as Response;

class ViewLocationAction extends LocationAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $locationId = (int) $this->resolveArg('id');
        $location = $this->locationRepository->findById($locationId);

        $this->logger->info("Location of id `${locationId}` was viewed.");

        return $this->respondWithData($location);
    }
}
