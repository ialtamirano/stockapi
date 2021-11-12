<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Scope;

use App\Domain\Scope\ScopeNotFoundException;
use App\Domain\Scope\ScopeRepository;

use PDO;
use \RedBeanPHP\R as R;

class ScopeModel implements ScopeRepository
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
        $scope = R::findAll('scope');

        return R::exportAll($scope);
    }

    public function findById($id)
    {

        $scope = R::load('scope', $id);

      
        if ( $scope->id == 0)
        {
            throw new ScopeNotFoundExceptionScope();
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
            throw new ScopeNotFoundExceptionScope();
        }

        R::trash( $scope);       
        return true;
    }



}