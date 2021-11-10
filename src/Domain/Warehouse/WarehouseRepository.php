<?php
declare(strict_types=1);

namespace App\Domain\Warehouse;

interface WarehouseRepository
{
    
    /*public function insert(array $warehouse): int;
*/
     /**
     * @return Warehouse[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Warehouse
     * @throws StreamNotFoundException
     */
    public function findById(int $id);

    public function create(array $warehouse);

    public function update(int $id, array $warehouse);

    public function delete(int $id);
}