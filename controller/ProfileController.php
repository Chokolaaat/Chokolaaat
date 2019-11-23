<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'classes/ProfileRepository.php';

class ProfileController extends Controller {

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
     * Display Info Action
     * 
     * @return string
     */
    private function infoAction()
    {
        $view = file_get_contents('view/page/profile/info.php');

        $profileRepository = new ProfileRepository();
        $profileRepository->findAll();

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Delete Action
     * 
     * @return string
     */
    private function deleteAction()
    {
        $view = file_get_contents('view/page/profile/info.php');

        $profileRepository = new ProfileRepository();
        $profileRepository->delete($_GET['idCart']);

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}