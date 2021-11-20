<?php
declare(strict_types=1);

namespace App\Domain\Customer;

interface CustomerRepository
{
    
    /*public function insert(array $customer): int;
*/
     /**
     * @return Customer[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Customer
     * @throws CustomerNotFoundException
     */
    public function findById(int $id);

    public function create(array $customer);

    public function update(int $id, array $customer);
}