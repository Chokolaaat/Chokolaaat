<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'database/DataBaseQuery.php';
include_once 'Entity.php';

class CartRepository implements Entity {

    /**
     * Find all entries
     *
     * @return array|resource
     */
    public function findAll() {

        $table = 't_cart as p, t_category as c';
        $columns = '*';
        $where =  'p.fkCategory = c.idCategory';

        $request =  new DataBaseQuery();
        
        $query = "";

        return $request->rawQuery($query);

    }

    /**
     * Find One entry
     *
     * @param $idProduct
     *
     * @return array
     */
    public function findOne($idProduct)
    {

        $table = 't_product as p, t_category as c';
        $columns = '*';
        $where = 'p.fkCategory = c.idCategory AND p.idProduct = ' . $idProduct . ' LIMIT 1';

        $request = new DataBaseQuery();
        $query = $request->select($table, $columns, $where);

        return $query;
    }

    /**
     * Save Cart
     *
     *
     * @return array
     */
    public function saveCart()
    {
        $request = new DataBaseQuery();

        $query = "SELECT carNumber FROM t_cart ORDER BY carNumber DESC LIMIT 1";

        $result = $request->rawQuery($query);
        $cartNumber = (int)$result[0]['carNumber'] + 1;

        $query = "INSERT INTO t_cart (carNumber, fkUser) VALUES (" . $cartNumber . "," . $_SESSION['userInfo']['id'] . ");";
        
        $request->rawQuerySimple($query);

        foreach ($_SESSION['cart'] as $product) {
            $query = "INSERT INTO t_contains (fkCart, fkProduct) VALUES ((SELECT idCart FROM t_cart WHERE carNumber = " . $cartNumber . " AND fkUser = ". $_SESSION['userInfo']['id']."), " . $product['idProduct'] . ");";
            $request->rawQuerySimple($query);
        }
    }
}