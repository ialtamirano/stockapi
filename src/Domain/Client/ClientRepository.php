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
    public function findClientOfId(int $id);
}