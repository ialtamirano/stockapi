<?php

namespace App\Domain\Scope\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class ScopeRepository
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
        $scopes = R::findAll('scope');

        return R::exportAll($scopes);
    }

    public function search($query):array
    {
        
        $scopes = R::find('scope', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($scopes) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($scopes);
    }

   

    public function findById($id)
    {

        $scope = R::load('scope', $id);

      
        if ( $scope->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $scope;
    }




    public function create($scope) {

        $bean = R::dispense('scope');

        $bean->import($scope);
        
        return $id = R::store($bean);
    }

    public function update($id, $scope)
    {

        $bean = R::load('scope', $id);

        $bean->import($scope);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $scope = R::load('scope', $id);

        if ( $scope->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $scope);

      

        return true;
    }




    public function findByCode($scopeCode)
    {

        $scope = R::findOne('scope', 'code =  ? ', [
            $scopeCode
        ]);

        if($scope){
            if ( $scope->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $scope;
    }


    
}