<?php
declare(strict_types=1);

namespace App\Application\Actions\Part;

use Psr\Http\Message\ResponseInterface as Response;

class ListPartAction extends PartAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $parts = $this->partRepository->findAll();

        $this->logger->info("Part list was viewed.");

        return $this->respondWithData($parts);
    }
}
