<?php
declare(strict_types=1);

namespace App\Application\Actions\Part;

use Psr\Http\Message\ResponseInterface as Response;

class CreatePartAction extends PartAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $part = $this->getFormData();
       
        $part->id = $this->partRepository->create($part);

        $this->logger->info("Part of id `$part->id` was created.");

        return $this->respondWithData($part);
    }
}
