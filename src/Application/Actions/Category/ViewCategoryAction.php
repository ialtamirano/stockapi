<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Domain\Category\Service\CategoryView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewCategoryAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CategoryView $service)
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

        $this->logger->info("Category of id ".$formData->id." was updated successfully.");

        return $this->respondWithData($formData);
    }
}
