<?php
declare(strict_types=1);

namespace App\Application\Actions\account;

use Psr\Http\Message\ResponseInterface as Response;

class ListAccountAction extends AccountAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $account = $this->AccountRepository->findAll();

        $this->logger->info("account list was viewed.");

        return $this->respondWithData($account);
    }
}
