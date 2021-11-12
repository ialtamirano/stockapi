<?php
declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    
    /*public function insert(array $user): int;
*/
     /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws StreamNotFoundException
     */
    public function findById(int $id);

    public function create(array $user);

    public function update(int $id, array $user);

    public function delete(int $id);
}