<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Domain\Category\Service\CategoryUpdate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class UpdateCategoryAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CategoryUpdate $service)
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

        $this->logger->info("Category of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
