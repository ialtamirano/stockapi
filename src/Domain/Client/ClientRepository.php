<?php
declare(strict_types=1);

namespace App\Domain\Client;

interface ClientRepository
{
    
    /*public function insert(array $client): int;
*/
     /**
     * @return Client[]
     */
    public function findAll():array;

    /**
     * @param int $id
     * @return Client
     * @throws ClientNotFoundException
     */
    public function findById(int $id);

    public function create(array $Client);

    public function update(int $id, array $Client);

    public function delete(int $id);
}