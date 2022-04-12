<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Domain\Category\Service\CategoryCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateCategoryAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CategoryCreate $service)
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

        $formData->id = $this->service->create($formData);

        $this->logger->info("Category of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
