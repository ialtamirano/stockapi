<?php
declare(strict_types=1);

namespace App\Domain\Basket;

interface BasketRepository
{
    
    /*public function insert(array $basket): int;
*/
     /**
     * @return Basket[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Basket
     * @throws BasketNotFoundException
     */
    public function findById(int $id);

    public function create(array $basket);

    public function update(int $id, array $basket);

    
}