<?php
declare(strict_types=1);

namespace App\Domain\Part;

interface PartRepository
{
    
    /*public function insert(array $part): int;
*/
     /**
     * @return Part[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Part
     * @throws PartNotFoundException
     */
    public function findById(int $id);

    public function create(array $part);

    public function update(int $id, array $part);
}