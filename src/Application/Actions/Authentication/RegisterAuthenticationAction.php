<?php
declare(strict_types=1);

namespace App\Application\Actions\Authentication;

use App\Application\Actions\Action;
use App\Domain\Authentication\Service\AuthenticationRegister;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class RegisterAuthenticationAction extends Action
{

    
    private $authenticationRegister;

    public function __construct( LoggerInterface $logger,AuthenticationRegister $authenticationRegister)
    {
        parent::__construct($logger);
       
        $this->authenticationRegister = $authenticationRegister;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $authentication = $this->getFormData();

        $authentication->id = $this->authenticationRegister->register($authentication);

        $this->logger->info("Authentication of id ".$authentication->id." was created successfully.");

        return $this->respondWithData($authentication);
    }
}
