<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateLocationAction extends LocationAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $locationId = (int) $this->resolveArg('id');
        $location = $this->getFormData();
       
        $location->id = $this->locationRepository->update($locationId,$location);

        $this->logger->info("Location of id `$location->id` was updated.");

        return $this->respondWithData($location);
    }
}
