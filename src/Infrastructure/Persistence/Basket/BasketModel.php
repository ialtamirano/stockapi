<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Basket;

use App\Domain\Basket\BasketNotFoundException;
use App\Domain\Basket\BasketRepository;

use PDO;
use \RedBeanPHP\R as R;

class BasketModel implements BasketRepository
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
        $baskets = R::findAll('basket');

        return R::exportAll($baskets);
    }

    public function findById($id)
    {
        //R::debug(true);
        $basket = R::load('basket', $id);

       //var_dump($basket);
       //exit;
        if ( $basket->id == 0)
        {
            throw new BasketNotFoundException();
        }

        $basket->ownBasketitemList = $basket->ownBasketitemList;

        foreach ($basket->ownBasketitemList as $item) {
            $part = R::load('part', $item->part_id);
            $item->part = $part;
        }
        
        return $basket;
    }

    public function create($basket)
    {
        R::begin();

        try{
            
            

            $basketBean = R::dispense('basket');

            $basketBean->uid = $basket->uid;
            
            //$basketBean->subject = $basket->subject;
            //$basketBean->created_date =$basket->created_date;
            
                     
            foreach ($basket->ownBasketitem as $item) {

                $basketItemBean = R::dispense('basketitem');
                $basketItemBean->import($item);

                $basketBean->ownBasketItemList[] = $basketItemBean;
                
            } 

            $id = R::store($basketBean);

            return $id;
            

            R::commit();
        }
        catch( Exception $e ) {
            R::rollback();
            throw new BasketNotCommittedException();
        }  
    }
    
    public function update($id, $basket)
    {

        $bean = R::load('basket', $id);

        $bean->import($basket);

        return $id = R::store($bean);
    }
}
