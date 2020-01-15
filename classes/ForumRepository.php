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
     * Récupère toutes les discussions d'une catégorie
     *
     * @return array|resource
     */
    public function findAllDiscussions($cat) {

        $table = 't_discussion';
        $columns = 'idDiscussion, disName';
        $where = 'fkCategory = '. $cat;

        $request =  new DataBaseQuery();
        
        return $request->select($table, $columns, $where);

    }

    /**
     * Récupère le nom de la catégorie actuelle
     *
     * @return array|resource
     */
    public function findCatName($cat) {

        $table = 't_category';
        $columns = 'catName';
        $where = 'idCategory = '. $cat;

        $request =  new DataBaseQuery();
        
        return $request->select($table, $columns, $where);

    }

    /**
     * Récupère le nom de la discussion actuelle
     *
     * @return array|resource
     */
    public function findDiscName($disc) {

        $table = 't_discussion';
        $columns = 'disName';
        $where = 'idDiscussion = '. $disc;

        $request =  new DataBaseQuery();
        
        return $request->select($table, $columns, $where);

    }

    /**
     * Récupère toutes les messages d'une discussion
     *
     * @return array|resource
     */
    public function findAllMessage($discussion) {

        $table = 't_message';
        $columns = 'idMessage, mesText, mesDate, idUser, usePseudo';
        $join = 't_user ON fkUser = idUser';
        $where = 'fkDiscussion = '. $discussion;

        $request =  new DataBaseQuery();
        
        return $request->selectJoin($table, $columns, $join,$where);

    }

    /**
     * Récupère toutes les tags d'une discussion
     *
     * @return array|resource
     */
    public function findDiscTags($discussion) {

        $table = 't_tag';
        $columns = 'idTag, tagName';
        $join = 't_discussiontag ON fkTag = idTag';
        $where = 'fkDiscussion = '. $discussion;

        $request =  new DataBaseQuery();
        
        return $request->selectJoin($table, $columns, $join, $where);

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