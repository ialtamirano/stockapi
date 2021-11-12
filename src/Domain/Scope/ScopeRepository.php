<?php
declare(strict_types=1);

namespace App\Domain\Scope;

interface ScopeRepository
{
    
    /*public function insert(array $Scope): int;
*/
     /**
     * @return Scope[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Scope
     * @throws StreamNotFoundException
     */
    public function findById(int $id);

    public function create(array $Scope);

    public function update(int $id, array $Scope);

    public function delete(int $id);
}