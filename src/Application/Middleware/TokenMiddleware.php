<?php
declare(strict_types=1);

namespace App\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use App\Domain\User\Service\UserFindByEmail;

///Created by Ivan Altamirano on 2022-05-02
/**
 * Purpose: Put the current_user attribute on the request 
 */
class TokenMiddleware implements Middleware
{

    private $service;
    private $logger;

    public function __construct(LoggerInterface $logger,UserFindByEmail $service)
    {
        //parent::__construct();
       
        $this->service = $service;
        $this->logger = $logger;
    }


    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {




        $token = $request->getAttribute("token");


        if (isset($token)) {


            $user = $this->service->find($token['jti']);

            //$this->logger->info($user);
            $request = $request->withAttribute('current_user', $user);
        }

        return $handler->handle($request);
    }
}
