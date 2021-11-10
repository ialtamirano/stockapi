<?php
declare(strict_types=1);

namespace App\Application\Actions\Account;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteAccountAction extends AccountAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $accountId = (int) $this->resolveArg('id');
        $account = $this->accountRepository->delete($accountId);

        $this->logger->info("Account of id `${accountId}` was deleted.");

        return $this->respondWithData($account);
    }
}
