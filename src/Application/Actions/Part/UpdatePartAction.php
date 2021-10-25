<?php
declare(strict_types=1);

namespace App\Application\Actions\Part;

use Psr\Http\Message\ResponseInterface as Response;

class UpdatePartAction extends PartAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $partId = (int) $this->resolveArg('id');
        $part = $this->getFormData();
       
        $part->id = $this->partRepository->update($partId,$part);

        $this->logger->info("Part of id `$part->id` was updated.");

        return $this->respondWithData($part);
    }
}
