<?php
declare(strict_types=1);

namespace App\Application\Actions\Authentication;

use App\Application\Actions\Action;
use App\Domain\Authentication\Service\AuthenticationLogin;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class LoginAuthenticationAction extends Action
{

    private $authenticationLogin;

    public function __construct(LoggerInterface $logger, AuthenticationLogin $authenticationLogin)
    {
        parent::__construct($logger);
        $this->authenticationLogin = $authenticationLogin;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $data = $this->getFormData();

        $loginResponse = $this->authenticationLogin->login($data);

        $this->logger->info("Authentication of id ".$loginResponse->id." was created successfully.");

        return $this->respondWithData($loginResponse);
    }
}
