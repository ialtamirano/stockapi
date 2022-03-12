<?php
declare(strict_types=1);

namespace App\Application\Actions\PartNumber;

use App\Application\Actions\Action;
use App\Domain\PartNumber\Service\PartNumberView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewPartNumberAction extends Action
{

    
    private $partNumberView;

    public function __construct( LoggerInterface $logger,PartNumberView $partNumberView)
    {
        parent::__construct($logger);
       
        $this->partNumberView = $partNumberView;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        
        $partNumberId = (int) $this->resolveArg('id');

        $partNumberFormData = $this->partNumberView->view($partNumberId);

        $this->logger->info("PartNumber of id ".$partNumberFormData->id." was updated successfully.");

        return $this->respondWithData($partNumberFormData);
    }
}
