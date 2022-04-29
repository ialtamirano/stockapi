<?php

namespace App\Domain\Account\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class AccountRepository
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
        $accounts = R::findAll('account');

        return R::exportAll($accounts);
    }

    public function search($query):array
    {
        
        $accounts = R::find('account', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($accounts) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($accounts);
    }

   

    public function findById($id)
    {

        $account = R::load('account', $id);

      
        if ( $account->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $account;
    }




    public function create($account) {

        $bean = R::dispense('account');

        $bean->import($account);
        
        return $id = R::store($bean);
    }

    public function update($id, $account)
    {

        $bean = R::load('account', $id);

        $bean->import($account);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $account = R::load('account', $id);

        if ( $account->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $account);

      

        return true;
    }




    public function findByCode($accountCode)
    {

        $account = R::findOne('account', 'code =  ? ', [
            $accountCode
        ]);

        if($account){
            if ( $account->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $account;
    }


    
}