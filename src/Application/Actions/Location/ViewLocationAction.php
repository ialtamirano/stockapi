<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use App\Application\Actions\Action;
use App\Domain\Location\Service\LocationView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewLocationAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,LocationView $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        
        $Id = (int) $this->resolveArg('id');

        $formData = $this->service->view($Id);

        $this->logger->info("Location of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
