<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Company;


use App\Domain\Company\CompanyNotFoundException;
use App\Domain\Company\CompanyRepository;

use PDO;
use \RedBeanPHP\R as R;

class CompanyModel implements CompanyRepository
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

  

    public function findAll():array{

        $companies = R::findAll('company');

        return R::exportAll($companies);;

       
    }

    public function findById($id)
    {

        $company = R::load( 'company', $id );

      
        if ( $company->id == 0) {
            throw new CompanyNotFoundException();
        }



        return $company;
    }

    public function create($company){

        $bean = R::dispense('company');

        $bean->import($company);

        return $id = R::store($bean);

    }
    
    public function update($id, $company){

        $bean = R::load( 'company', $id );

        $bean->import($company);

        return $id = R::store($bean);
    }

}