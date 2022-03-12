<?php
declare(strict_types=1);

namespace App\Application\Actions\PartNumber;

use App\Application\Actions\Action;
use App\Domain\PartNumber\Service\PartNumberCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreatePartNumberAction extends Action
{

    
    private $partNumberCreate;

    public function __construct( LoggerInterface $logger,PartNumberCreate $partNumberCreate)
    {
        parent::__construct($logger);
       
        $this->partNumberCreate = $partNumberCreate;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $partNumberFormData = $this->getFormData();

        $partNumberFormData->id = $this->partNumberCreate->create($partNumberFormData);

        $this->logger->info("PartNumber of id ".$partNumberFormData->id." was created successfully.");

        return $this->respondWithData($partNumberFormData);
    }
}
