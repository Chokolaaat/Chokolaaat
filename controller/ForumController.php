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
     * Affiche les catégories
     *
     * @return string
     */ 
    private function indexAction() {

        $view = file_get_contents('view/page/forum/index.php');

        $forumRepository = new ForumRepository();

        //Récupère toutes les catégories
        $chokoCats = $forumRepository->findAllCat();

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Affiche les discussions d'une catégorie
     *
     * @return string
     */ 
    private function allDiscussionsAction() {

        $view = file_get_contents('view/page/forum/alldiscussions.php');

        $forumRepository = new ForumRepository();

        //Récupère toutes les discusssions
        $chokoDiscussions = $forumRepository->findAllDiscussions($_GET['cat']);

        //Récupère le nom de la catégorie actuelle
        $chokoCategorie = $forumRepository->findCatName($_GET['cat']);

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Affiche une discussion
     *
     * @return string
     */ 
    private function discussionAction() {

        $view = file_get_contents('view/page/forum/discussion.php');

        $forumRepository = new ForumRepository();

        //Récupère tous les messages
        $chokoMessage = $forumRepository->findAllMessage($_GET['disc']);

        //Récupère le nom de la discussion actuelle
        $chokoDiscussion = $forumRepository->findDiscName($_GET['disc']);

        //Récupère les tags de la discussion
        $chokoTags = $forumRepository->findDiscTags($_GET['disc']);

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