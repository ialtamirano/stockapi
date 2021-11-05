<?php
declare(strict_types=1);

namespace App\Domain\Inbox;

interface InboxRepository
{
    
    /*public function insert(array $inbox): int;
*/
     /**
     * @return Inbox[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Inbox
     * @throws InboxNotFoundException
     */
    public function findById(int $id);

    public function create(array $inbox);

    public function update(int $id, array $inbox);
}