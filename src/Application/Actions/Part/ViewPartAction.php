<?php
declare(strict_types=1);

namespace App\Application\Actions\Part;

use Psr\Http\Message\ResponseInterface as Response;

class ViewPartAction extends PartAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $partId = (int) $this->resolveArg('id');
        $part = $this->partRepository->findById($partId);

        $this->logger->info("Part of id `${partId}` was viewed.");

        return $this->respondWithData($part);
    }
}
