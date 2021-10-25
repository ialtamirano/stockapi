<?php
declare(strict_types=1);

namespace App\Domain\Company;

interface CompanyRepository
{
    
    /*public function insert(array $company): int;
*/
     /**
     * @return Company[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Company
     * @throws CompanyNotFoundException
     */
    public function findById(int $id);

    public function create(array $company);

    public function update(int $id, array $company);
}