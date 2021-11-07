<?php
declare(strict_types=1);

namespace App\Application\Actions\Stream;

use Psr\Http\Message\ResponseInterface as Response;

class ViewStreamAction extends StreamAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $streamId = (int) $this->resolveArg('id');
        $stream = $this->streamRepository->findById($streamId);

        $this->logger->info("Stream of id `${streamId}` was viewed.");

        return $this->respondWithData($stream);
    }
}
