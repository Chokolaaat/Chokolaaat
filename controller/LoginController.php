<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */
include_once 'classes/LoginRepository.php';

class LoginController extends Controller {

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        return call_user_func(array($this, $action));
    }

    /**
     * Display Index Action
     *
     * @return string
     */
    private function indexAction() {

        $view = file_get_contents('view/page/login/index.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Login Action
     *
     * @return string
     */
    private function loginAction() {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $loginRepository = new LoginRepository();
        $result = $loginRepository->login($login, $password);


        $text = "Vous n'êtes pas connnecté ! ";

        //Vérifie que la connexion aie réussie
        if($result == true){
            //Affiche que la connexion à réussie
            $text = "Vous êtes connecté ! ";
            //vérifie si l'utilisateur s'est connecté par email ou pseudo
            $_SESSION['userInfo']['username'] = $login;
            //En fonction, il va chercher les informations de l'utilisateur
            if($_SESSION['userInfo']['login'] == "pseudo"){
                $resultInfUser = $loginRepository->findAllInfWithPseudo($login);
            }
            else{
                $resultInfUser = $loginRepository->findAllWithEmail($login);
            }
            //Met en session les informations de l'utilisateur
            $_SESSION['userInfo']['pseudo'] = $resultInfUser[0]['usePseudo'];
            $_SESSION['userInfo']['id'] = $resultInfUser[0]['idUser'];
            $_SESSION['userInfo']['email'] = $resultInfUser[0]['useEmail'];
            $_SESSION['userInfo']['rightId'] = $resultInfUser[0]['idRight'];
            $_SESSION['userInfo']['rightName'] = $resultInfUser[0]['rigName'];
            $_SESSION['userInfo']['gradeId'] = $resultInfUser[0]['idGrade'];
            $_SESSION['userInfo']['gradeName'] = $resultInfUser[0]['graName'];
        }

        $view = file_get_contents('view/page/login/confirm.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Diplay Logout Action
     * 
     * @return string
     */
    private function logoutAction() {
        $_SESSION['right'] = null;

        $view = file_get_contents('view/page/login/index.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;

    }

}