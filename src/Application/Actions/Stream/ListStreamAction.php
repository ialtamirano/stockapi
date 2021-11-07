<?php
declare(strict_types=1);

namespace App\Application\Actions\Stream;

use Psr\Http\Message\ResponseInterface as Response;

class ListStreamAction extends StreamAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $streams = $this->streamRepository->findAll();

        $this->logger->info("Stream list was viewed.");

        return $this->respondWithData($streams);
    }
}
