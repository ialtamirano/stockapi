<?php
declare(strict_types=1);

namespace App\Application\Actions\Comment;

use App\Application\Actions\Action;
use App\Domain\Comment\Service\CommentCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateCommentAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CommentCreate $service)
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

        $this->logger->info("Comment of id ".$formData->id." was created successfully.");

        return $this->respondWithData($formData);
    }
}
