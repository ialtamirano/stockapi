<?php
declare(strict_types=1);

namespace App\Application\Actions\Location;

use App\Application\Actions\Action;
use App\Domain\Location\Service\LocationDelete;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DeleteLocationAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,LocationDelete $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        //$partNumberFormData = $this->getFormData();
        $Id = (int) $this->resolveArg('id');

        $result = $this->service->delete($Id);

        $this->logger->info("Location of id ".$Id." was deleted successfully.");

        return $this->respondWithData($result);
    }
}
