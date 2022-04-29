<?php

namespace App\Domain\Receipt\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\DomainException\DomainNotCommittedException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class ReceiptRepository
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
        $receipts = R::findAll('receipt');

        return R::exportAll($receipts);
    }

    public function search($query):array
    {
        
        $receipts = R::find('receipt', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($receipts) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($receipts);
    }

   

    public function findById($id)
    {

        R::debug(true);
        $receipt = R::load('receipt', $id);

       
        if ( $receipt->id == 0)
        {
            throw new ReceiptNotFoundException();
        }

        $receipt->ownReceiptitemList = $receipt->ownReceiptitemList;
        
        return $receipt;
    }




    public function create($receipt) {

        R::begin();

        try{
            
            

            $receiptBean = R::dispense('receipt');

            $receiptBean->folio = $receipt->folio;
            
            $receiptBean->title = $receipt->title;
            $receiptBean->receipt_date =$receipt->receipt_date;
            $receiptBean->locationId = $receipt->locationId;
            $receiptBean->orderTypeId = $receipt->orderTypeId;
                     
            foreach ($receipt->ownReceiptitem as $item) {

                $receiptItemBean = R::dispense('receiptitem');
                $receiptItemBean->import($item);

                $receiptBean->ownReceiptItemList[] = $receiptItemBean;
                
                //Create Inventory Log
                $inventoryLog = R::dispense('inventorylog');
                $inventoryLog->begLocationId = $receiptBean->locationId;
                $inventoryLog->endLocationId = $receiptBean->locationId;
                $inventoryLog->changeQty = $receiptItemBean->quantity;
                $inventoryLog->partId = $receiptItemBean->partId;
                $inventoryLog->logTypeId = 1;

                $inventoryLog->id = R::store($inventoryLog);
            } 

            $id = R::store($receiptBean);
            return $id;
            

            R::commit();
        }
        catch( Exception $e ) {
            R::rollback();
            throw new DomainNotCommittedException();
        }  ;
    }

    public function update($id, $receipt)
    {

        $bean = R::load('receipt', $id);

        $bean->import($receipt);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $receipt = R::load('receipt', $id);

        if ( $receipt->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $receipt);

      

        return true;
    }




    public function findByCode($receiptCode)
    {

        $receipt = R::findOne('receipt', 'code =  ? ', [
            $receiptCode
        ]);

        if($receipt){
            if ( $receipt->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $receipt;
    }


    
}