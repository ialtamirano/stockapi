<?php
declare(strict_types=1);

namespace App\Application\Actions\Comment;

use App\Application\Actions\Action;
use App\Domain\Comment\Service\CommentSearch;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SearchCommentAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,CommentSearch $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

       
        $queryString =  $this->resolveArg('query');

        $formData = $this->service->search($queryString);

        return $this->respondWithData($formData);
    }
}
