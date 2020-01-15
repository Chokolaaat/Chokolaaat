<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'classes/AdminRepository.php';
include_once 'classes/ForumRepository.php';

class ForumController extends Controller {

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

        $view = file_get_contents('view/page/forum/index.php');

        $forumRepository = new ForumRepository();
        $chokoCats = $forumRepository->findAllCat();

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Index Action
     *
     * @return string
     */ 
    private function allDiscussionsAction() {

        $view = file_get_contents('view/page/forum/index.php');

        $forumRepository = new ForumRepository();
        $forumRepository->findAllCat();

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Contact Action
     *
     * @return string
     */
    private function contactAction() {

        $view = file_get_contents('view/page/home/contact.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}