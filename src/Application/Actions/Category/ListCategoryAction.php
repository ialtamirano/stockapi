<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Domain\Category\Service\CategoryList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListCategoryAction extends Action
{

    
    private $service;

    public function __construct(LoggerInterface $logger,CategoryList $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $data = $this->service->findAll();

        return $this->respondWithData($data);
    }
}
