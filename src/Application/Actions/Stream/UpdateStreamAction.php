<?php
declare(strict_types=1);

namespace App\Application\Actions\Stream;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateStreamAction extends StreamAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $streamId = (int) $this->resolveArg('id');
        $stream = $this->getFormData();
       
        $stream->id = $this->streamRepository->update($streamId,$stream);

        $this->logger->info("Stream of id `$stream->id` was updated.");

        return $this->respondWithData($stream);
    }
}
