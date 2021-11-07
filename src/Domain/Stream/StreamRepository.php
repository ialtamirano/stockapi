<?php
declare(strict_types=1);

namespace App\Domain\Stream;

interface StreamRepository
{
    
    /*public function insert(array $stream): int;
*/
     /**
     * @return Stream[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Stream
     * @throws StreamNotFoundException
     */
    public function findById(int $id);

    public function create(array $stream);

    public function update(int $id, array $stream);

    public function delete(int $id);
}