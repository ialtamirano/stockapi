<?php
declare(strict_types=1);

namespace App\Application\Actions\Stream;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteStreamAction extends StreamAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $streamId = (int) $this->resolveArg('id');
        $stream = $this->streamRepository->delete($streamId);

        $this->logger->info("Stream of id `${streamId}` was deleted.");

        return $this->respondWithData($stream);
    }
}
