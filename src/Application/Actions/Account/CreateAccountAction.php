<?php
declare(strict_types=1);

namespace App\Application\Actions\Account;

use Psr\Http\Message\ResponseInterface as Response;

class CreateAccountAction extends AccountAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $account = $this->getFormData();
       
        $account->id = $this->accountRepository->create($account);

        $this->logger->info("Account of id `$account->id` was created.");

        return $this->respondWithData($account);
    }
}
