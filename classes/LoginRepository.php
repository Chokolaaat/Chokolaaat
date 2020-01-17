<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'database/DataBaseQuery.php';
include_once 'Entity.php';


class LoginRepository implements Entity {

    /**
     * Find all entries
     *
     * @return array|resource
     */
    public function findAll() {

        $table = 't_user';
        $columns = 'usePseudo';

        $request =  new DataBaseQuery();
        
        return $request->select($table, $columns);

    }

    /**
     * Find One entry with pseudo
     *
     * @param $login
     *
     * @return array
     */
    public function findOnePseudo($login) {

        $table = 't_user';
        $columns = 'usePassword, useBan';
        $where = "usePseudo = '$login'";

        $request =  new DataBaseQuery();

        return $request->select($table, $columns, $where);

    }

    /**
     * Find One entry with Email
     *
     * @param $login
     *
     * @return array
     */
    public function findOneEmail($login) {

        $table = 't_user';
        $columns = 'usePassword, useBan';
        $where = "useEmail = '$login'";

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

        //Récupère le mot de passe pour le pseudo
        $resultPseudo = $this->findOnePseudo($login);

        //Vérifie si le résulat est vide
        if(isset($resultPseudo) && count($resultPseudo)>0){
            //Vérifie si le mot de passe correspond au pseudo
        	if(password_verify($password, $resultPseudo[0]['usePassword'])){
                //Vérifie que l'utilisateur n'est pas banni
                if($resultPseudo[0]['useBan'] == 0){
                    $connectPseudo = true;
                    $_SESSION['userInfo']['login'] = "pseudo";
                } else {
                    $connectPseudo = false;
                }       
	        } else {
		        $connectPseudo = false;
	        }
        } else {
            $connectPseudo = false;
        }


        //Récupère le mot de passe pour le mail
        $resultEmail = $this->findOneEmail($login);

        //Vérifie si le résultat est vide
        if(isset($resultEmail) && count($resultEmail)>0){
            //Vérifie si le mot de passe correspond à l'Email
        	if(password_verify($password, $resultEmail[0]['usePassword'])){
                //Vérifie que l'utilisateur n'est pas banni
                if($resultEmail[0]['useBan'] == 0){
                    $connectEmail = true;
                    $_SESSION['userInfo']['login'] = "email";
                } else{
                    $connectEmail = false;
                }    
	        } else {
		        $connectEmail = false;
	        }
        } else {
            $connectEmail = false;
        }

        //Vérifie si la connexion a réussie avec l'email ou le pseudo
        if($connectEmail == true || $connectPseudo == true){
            $connect = true;
        }
        else{
            $connect = false;
        }

        return $connect;
    }

    /**
     * All the information for one user with Email
     *
     * @param $login
     *
     * @return array
     */
    public function findAllWithEmail($login) {

        $table = 't_user';
        $columns = 'idUser, usePseudo, useEmail, idRight, rigName, idGrade, graName';
        $join = 't_right ON fkRight = idRight JOIN t_Grade on fkGrade = idGrade';
        $where = "useEmail = '$login'";

        $request =  new DataBaseQuery();

        return $request->selectJoin($table, $columns, $join,$where);

    }

    /**
     * All the information for one user with Pseudo
     *
     * @param $login
     *
     * @return array
     */
    public function findAllWithPseudo($login) {

        $table = 't_user';
        $columns = 'idUser, usePseudo, useEmail, idRight, rigName, idGrade, graName';
        $join = 't_right ON fkRight = idRight JOIN t_Grade on fkGrade = idGrade';
        $where = "usePseudo = '$login'";

        $request =  new DataBaseQuery();

        return $request->selectJoin($table, $columns, $join,$where);

    }
}