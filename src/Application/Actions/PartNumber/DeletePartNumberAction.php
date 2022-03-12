<?php
declare(strict_types=1);

namespace App\Application\Actions\PartNumber;

use App\Application\Actions\Action;
use App\Domain\PartNumber\Service\PartNumberDelete;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DeletePartNumberAction extends Action
{

    
    private $partNumberDelete;

    public function __construct( LoggerInterface $logger,PartNumberDelete $partNumberDelete)
    {
        parent::__construct($logger);
       
        $this->partNumberDelete = $partNumberDelete;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        //$partNumberFormData = $this->getFormData();
        $partNumberId = (int) $this->resolveArg('id');

        $boolPartNumber = $this->partNumberDelete->delete($partNumberId);

        $this->logger->info("PartNumber of id ".$partNumberId." was deleted successfully.");

        return $this->respondWithData($boolPartNumber);
    }
}
