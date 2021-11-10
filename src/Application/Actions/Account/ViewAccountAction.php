<?php
declare(strict_types=1);

namespace App\Application\Actions\Account; 
//dcc

use Psr\Http\Message\ResponseInterface as Response;

class ViewAccountAction extends AccountAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $accountId = (int) $this->resolveArg('id');
        $account = $this->accountRepository->findById($accountId);

        $this->logger->info("account of id `${accountId}` was viewed.");

        return $this->respondWithData($account);
    }
}
