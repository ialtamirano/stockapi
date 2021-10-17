<?php

use \RedBeanPHP\R as R;


class ProductModel {

    public function getProducts(){

        $products = R::findAll('productos');

        return R::exportAll($products);;
    }

    public function getProduct($id){

        $product = R::load( 'productos', $id );

        return $product;
    }

    public function insertProduct($productArray){

        $bean = R::dispense('productos');

        $bean->import($productArray);

        return $id = R::store($bean);

    }

    public function updateProduct($id,$productArray){

        $bean = R::load( 'productos', $id );

        $bean->import($productArray);

        return $id = R::store($bean);

    }

    public function deleteProduct($id){

        $bean = R::load( 'productos', $id );

        R::trash($bean);

        return true;

    }

}