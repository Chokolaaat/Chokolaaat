<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'database/DataBaseQuery.php';


class ForumRepository {

    /**
     * Récupère toutes les catégories
     *
     * @return array|resource
     */
    public function findAllCat() {

        $table = 't_category';
        $columns = 'idCategory, catName';

        $request =  new DataBaseQuery();
        
        return $request->select($table, $columns);

    }

    /**
     * Find One entry
     *
     * @param $login
     *
     * @return array
     */
    public function findOne($login) {

        $table = 't_user';
        $columns = '*';
        $where = "useLogin = '$login'";

        $request =  new DataBaseQuery();

        return $request->select($table, $columns, $where);

    }

    /**
     * Login
     *
     * @param $login
     * @param $password
     *
     * @return bool
     */
    public function login($login, $password) {

        $result = $this->findOne($login);

        if(isset($result) && count($result)>0){

        	if(password_verify($password, $result[0]['usePassword'])){
                $_SESSION['right'] = $result[0]['useRight'];
                $_SESSION['userInfo']['id'] = $result[0]['idUser'];
		        $connect = true;
	        } else {
		        $_SESSION['right'] = null;
		        $connect = false;
	        }

        } else {
            $_SESSION['right'] = null;
            $connect = false;
        }

        return $connect;
    }
}