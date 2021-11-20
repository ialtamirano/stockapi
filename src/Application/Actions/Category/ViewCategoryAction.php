<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

class ViewCategoryAction extends CategoryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $categoryId = (int) $this->resolveArg('id');
        $category = $this->categoryRepository->findById($categoryId);

        $this->logger->info("Category of id `${categoryId}` was viewed.");

        return $this->respondWithData($category);
    }
}
