<?php
declare(strict_types=1);

namespace App\Application\Actions\Account;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateAccountAction extends AccountAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $accountId = (int) $this->resolveArg('id');
        $account = $this->getFormData();
       
        $account->id = $this->accountRepository->update($accountId,$account);

        $this->logger->info("Account of id `$account->id` was updated.");

        return $this->respondWithData($account);
    }
}
