<?php
declare(strict_types=1);

namespace App\Application\Actions\Stream;

use Psr\Http\Message\ResponseInterface as Response;

class CreateStreamAction extends StreamAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $stream = $this->getFormData();
       
        $stream->id = $this->streamRepository->create($stream);

        $this->logger->info("Stream of id `$stream->id` was created.");

        return $this->respondWithData($stream);
    }
}
