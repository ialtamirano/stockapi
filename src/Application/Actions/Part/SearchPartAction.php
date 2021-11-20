<?php
declare(strict_types=1);

namespace App\Application\Actions\Part;

use Psr\Http\Message\ResponseInterface as Response;

class SearchPartAction extends PartAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $query = $this->resolveArg('query');

        $parts = $this->partRepository->search($query);

        $this->logger->info("Part list was viewed.");

        return $this->respondWithData($parts);
    }
}
