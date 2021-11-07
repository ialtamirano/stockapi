<?php
declare(strict_types=1);

namespace App\Domain\Location;

interface LocationRepository
{
    
    /*public function insert(array $location): int;
*/
     /**
     * @return Location[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Location
     * @throws LocationNotFoundException
     */
    public function findById(int $id);

    public function create(array $location);

    public function update(int $id, array $location);
    
    public function delete(int $id);
}