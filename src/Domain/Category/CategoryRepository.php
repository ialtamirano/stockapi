<?php
declare(strict_types=1);

namespace App\Domain\Category;

interface CategoryRepository
{
    
    /*public function insert(array $category): int;
*/
     /**
     * @return Category[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function findById(int $id);

    public function create(array $category);

    public function update(int $id, array $category);
}