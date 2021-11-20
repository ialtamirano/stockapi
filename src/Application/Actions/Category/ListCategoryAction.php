<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

class ListCategoryAction extends CategoryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $categorys = $this->categoryRepository->findAll();

        $this->logger->info("Category list was viewed.");

        return $this->respondWithData($categorys);
    }
}
