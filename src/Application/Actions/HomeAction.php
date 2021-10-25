<?php

declare(strict_types=1);

namespace App\Application\Actions\Home;

use App\Application\Actions\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

 class HomeAction extends Action
{

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        
        return $this->respond(["hello" => "world"]);
    }


}