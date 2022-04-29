<?php
declare(strict_types=1);

namespace App\Application\Actions\Stream;

use App\Application\Actions\Action;
use App\Domain\Stream\Service\StreamUpdate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class UpdateStreamAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,StreamUpdate $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $formData = $this->getFormData();
        $Id = (int) $this->resolveArg('id');

        $formData->id = $this->service->update($Id,$formData);

        $this->logger->info("Stream of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
