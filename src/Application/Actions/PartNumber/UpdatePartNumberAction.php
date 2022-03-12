<?php
declare(strict_types=1);

namespace App\Application\Actions\PartNumber;

use App\Application\Actions\Action;
use App\Domain\PartNumber\Service\PartNumberUpdate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class UpdatePartNumberAction extends Action
{

    
    private $partNumberUpdate;

    public function __construct( LoggerInterface $logger,PartNumberUpdate $partNumberUpdate)
    {
        parent::__construct($logger);
       
        $this->partNumberUpdate = $partNumberUpdate;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $partNumberFormData = $this->getFormData();
        $partNumberId = (int) $this->resolveArg('id');

        $partNumberFormData->id = $this->partNumberUpdate->update($partNumberId,$partNumberFormData);

        $this->logger->info("PartNumber of id ".$partNumberFormData->id." was updated successfully.");

        return $this->respondWithData($partNumberFormData);
    }
}
