<?php
declare(strict_types=1);

namespace App\Domain\Receipt;

interface ReceiptRepository
{
    

     /**
     * @return Receipt[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Receipt
     * @throws ReceiptNotFoundException
     */
    public function findById(int $id);

    public function create(array $receipt);

    public function update(int $id, array $receipt);
}
