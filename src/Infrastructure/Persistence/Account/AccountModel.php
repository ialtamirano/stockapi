<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Account;

use App\Domain\Account\AccountNotFoundException;
use App\Domain\Account\AccountRepository;

use PDO;
use \RedBeanPHP\R as R;

class AccountModel implements AccountRepository
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
        $account = R::findAll('account');

        return R::exportAll($account);
    }

    public function findById($id)
    {

        $account = R::load('account', $id);

      
        if ( $account->id == 0)
        {
            throw new AccountNotFoundException();
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
            throw new AccountNotFoundExceptionAccount();
        }

        R::trash( $account);       
        return true;
    }



}