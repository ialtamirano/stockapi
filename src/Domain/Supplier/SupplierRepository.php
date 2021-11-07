<?php
declare(strict_types=1);

namespace App\Domain\Supplier;

interface SupplierRepository
{
    
    /*public function insert(array $supplier): int;
*/
     /**
     * @return Supplier[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Supplier
     * @throws StreamNotFoundException
     */
    public function findById(int $id);

    public function create(array $supplier);

    public function update(int $id, array $supplier);

    public function delete(int $id);
}