<?php

namespace App\Domain\Company\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class CompanyRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    
    public function findAll():array
    {
        $companys = R::findAll('company');

        return R::exportAll($companys);
    }

    public function search($query):array
    {
        
        $companys = R::find('company', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($companys) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($companys);
    }

   

    public function findById($id)
    {

        $company = R::load('company', $id);

      
        if ( $company->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $company;
    }




    public function create($company) {

        $bean = R::dispense('company');

        $bean->import($company);
        
        return $id = R::store($bean);
    }

    public function update($id, $company)
    {

        $bean = R::load('company', $id);

        $bean->import($company);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $company = R::load('company', $id);

        if ( $company->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $company);

      

        return true;
    }




    public function findByCode($companyCode)
    {

        $company = R::findOne('company', 'code =  ? ', [
            $companyCode
        ]);

        if($company){
            if ( $company->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $company;
    }


    
}