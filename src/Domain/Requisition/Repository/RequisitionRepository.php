<?php
declare(strict_types=1);

namespace App\Domain\Requisition\Repository;


use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\DomainException\DomainNotCommittedException;


use PDO;
use \RedBeanPHP\R as R;

class RequisitionModel implements RequisitionRepository
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
        $requisitions = R::findAll('requisition');

        return R::exportAll($requisitions);
    }

    public function findById($id)
    {
        R::debug(true);
        $requisition = R::load('requisition', $id);

       
        if ( $requisition->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        $requisition->ownRequisitionitemList = $requisition->ownRequisitionitemList;
        
        return $requisition;
    }

    public function search($query):array
    {
        
        $requisitions = R::find('requisition', 'number LIKE ? OR subject LIKE ? OR description LIKE ? ', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($requisitions) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($requisitions);
    }

    public function create($requisition)
    {
        R::begin();

        try{
            
            

            $requisitionBean = R::dispense('requisition');

            $requisitionBean->folio = $requisition->folio;
            
            $requisitionBean->title = $requisition->title;
            $requisitionBean->requisition_date =$requisition->requisition_date;
            $requisitionBean->locationId = $requisition->locationId;
            $requisitionBean->orderTypeId = $requisition->orderTypeId;
                     
            foreach ($requisition->ownRequisitionitem as $item) {

                $requisitionItemBean = R::dispense('requisitionitem');
                $requisitionItemBean->import($item);

                $requisitionBean->ownRequisitionItemList[] = $requisitionItemBean;
                
                //Create Inventory Log
                /*$inventoryLog = R::dispense('inventorylog');
                $inventoryLog->begLocationId = $requisitionBean->locationId;
                $inventoryLog->endLocationId = $requisitionBean->locationId;
                $inventoryLog->changeQty = $requisitionItemBean->quantity;
                $inventoryLog->partId = $requisitionItemBean->partId;
                $inventoryLog->logTypeId = 1;

                $inventoryLog->id = R::store($inventoryLog);*/
            } 

            $id = R::store($requisitionBean);
            return $id;
            

            R::commit();
        }
        catch( Exception $e ) {
            R::rollback();
            throw new DomainNotCommittedException();
        }  
    }
    
    public function update($id, $requisition)
    {

        $bean = R::load('requisition', $id);

        $bean->import($requisition);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $requisition = R::load('requisition', $id);

        if ( $requisition->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $requisition);

      

        return true;
    }



}
