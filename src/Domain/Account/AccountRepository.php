<?php
declare(strict_types=1);

namespace App\Domain\Account;

interface AccountRepository
{
    
    /*public function insert(array $account): int;
*/
     /**
     * @return Account[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Account
     * @throws StreamNotFoundException
     */
    public function findById(int $id);

    public function create(array $account);

    public function update(int $id, array $account);

    public function delete(int $id);

    public function login(string $user, string $password);
}