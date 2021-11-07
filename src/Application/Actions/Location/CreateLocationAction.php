<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use Psr\Http\Message\ResponseInterface as Response;

class CreateLocationAction extends LocationAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $location = $this->getFormData();
       
        $location->id = $this->locationRepository->create($location);

        $this->logger->info("Location of id `$location->id` was created.");

        return $this->respondWithData($location);
    }
}
