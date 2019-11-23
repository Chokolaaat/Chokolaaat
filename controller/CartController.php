<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'classes/CartRepository.php';

class CartController extends Controller {

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

        $view = file_get_contents('view/page/home/index.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display List Action
     *
     * @return string
     */
    private function listAction() {

        $view = file_get_contents('view/page/cart/list.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Add Action
     *
     * @return string
     */
    private function addAction(){
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'];
        }

        if(isset($_SESSION['cart'][$_GET['idProduct']])){
            $_SESSION['cart'][$_GET['idProduct']]['quantity']++;
        }
        else{
            $cartRepository = new CartRepository();
            $_SESSION['cart'][$_GET['idProduct']] = $cartRepository->findOne($_GET['idProduct'])[0];
            $_SESSION['cart'][$_GET['idProduct']]['quantity'] = 1;
        }

        header("location: index.php?controller=cart&action=list");

        $view = file_get_contents('view/page/cart/listCart.php');

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
        if(isset($_SESSION['cart'][$_GET['idProduct']])){
            unset($_SESSION['cart'][$_GET['idProduct']]);
        }

        header("location: index.php?controller=cart&action=list");

        $view = file_get_contents('view/page/cart/listCart.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display AddQuantity Action
     * 
     * @return string
     */
    private function addQuantityAction()
    {
        $view = file_get_contents('view/page/cart/list.php');

        if($_SESSION['cart'][$_GET['idProduct']]['quantity'] + 1 <= $_SESSION['cart'][$_GET['idProduct']]['proQuantity']){
            $_SESSION['cart'][$_GET['idProduct']]['quantity']++;
        }
        else{
            echo '<script> alert("Vous ne pouvez pas en ajouter plus, il y en a pas plus en stock.") </script>';
        }

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display SubQuantity Action
     * 
     * @return string
     */
    private function subQuantityAction()
    {
        $view = file_get_contents('view/page/cart/list.php');

        if ($_SESSION['cart'][$_GET['idProduct']]['quantity'] - 1 > 0) {
            $_SESSION['cart'][$_GET['idProduct']]['quantity']--;
        }
        else {
            header("Location: index.php?controller=cart&action=delete&idProduct=" . $_GET['idProduct']);
        }

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Modify Action
     * 
     * @return string
     */
    private function modifyAction()
    {
        $view = file_get_contents('view/page/cart/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Order Action
     * 
     * @return string
     */
    private function orderAction()
    {
        $view = file_get_contents('view/page/cart/delivery.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Delivery Action
     * 
     * @return string
     */
    private function deliveryAction()
    {
        if(isset($_POST['delivery']) && ($_POST['delivery'] == 'poste' || $_POST['delivery'] == 'shop')){
            $_SESSION['delivery'] = $_POST['delivery'];
            $view = file_get_contents('view/page/cart/payment.php');
        }
        else{
            $view = file_get_contents('view/page/cart/delivery.php');
        }


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Payment Action
     * 
     * @return string
     */
    private function paymentAction()
    {
        if(isset($_POST['payment']) && ($_POST['payment'] == 'invoice' || $_POST['payment'] == 'advance' || $_POST['payment'] == 'creditcart')){
            $_SESSION['payment'] = $_POST['payment'];
            $view = file_get_contents('view/page/cart/address.php');
        }
        else{
            $view = file_get_contents('view/page/cart/payment.php');
        }


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Address Action
     * 
     * @return string
     */
    private function addressAction()
    {
        $regexName = "/^([A-Z]|[a-z]|[Ç-ø]|-|\'|\s)+$/";
        $regexStreet = "/^([A-Z]|[a-z]|[Ç-ø]|[0-9]|-| |.|\'|\s)+$/";
        $regexStreetNumber = "/^([A-Z]|[a-z]|[0-9]|-|\s)+$/";
        $regexPostcode = "/^([A-Z]|[a-z]|[0-9]|-)+$/";
        $regexLocality = "/^([A-Z]|[a-z]|[Ç-ø]|[0-9]|-|\'|\s)+$/";
        $regexEmail = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
        $regexPhoneNumber = "/^(\+|[0-9]|\s)+$/";
        if(isset($_POST['gender']) && isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['street']) && isset($_POST['number']) && isset($_POST['postcode']) && isset($_POST['locality']) && isset($_POST['email']) && isset($_POST['phonenumber'])){
            if($_POST['gender'] == 'Mr' || $_POST['gender'] == 'Mme' || $_POST['gender'] == 'Other'){
                if(preg_match($regexName, $_POST['lastname'])){
                    if(preg_match($regexName, $_POST['firstname'])){
                        if(preg_match($regexStreet, $_POST['street'])){
                            if(preg_match($regexStreetNumber, $_POST['number'])){
                                if(preg_match($regexPostcode, $_POST['postcode'])){
                                    if(preg_match($regexLocality, $_POST['locality'])){
                                        if(preg_match($regexEmail, $_POST['email'])){
                                            if(preg_match($regexPhoneNumber, $_POST['phonenumber'])){
                                                $_SESSION['userInfo']['gender'] = $_POST['gender'];
                                                $_SESSION['userInfo']['lastname'] = $_POST['lastname'];
                                                $_SESSION['userInfo']['firstname'] = $_POST['firstname'];
                                                $_SESSION['userInfo']['street'] = $_POST['street'];
                                                $_SESSION['userInfo']['number'] = $_POST['number'];
                                                $_SESSION['userInfo']['postcode'] = $_POST['postcode'];
                                                $_SESSION['userInfo']['locality'] = $_POST['locality'];
                                                $_SESSION['userInfo']['email'] = $_POST['email'];

                                                $view = file_get_contents('view/page/cart/summary.php');
                                            }
                                            else{
                                                $view = file_get_contents('view/page/cart/address.php');
                                            }
                                        }
                                        else{
                                            $view = file_get_contents('view/page/cart/address.php');
                                        }
                                    }
                                    else{
                                        $view = file_get_contents('view/page/cart/address.php');
                                    }
                                }
                                else{
                                    $view = file_get_contents('view/page/cart/address.php');
                                }
                            }
                            else{
                                $view = file_get_contents('view/page/cart/address.php');
                            }
                        }
                        else{
                            $view = file_get_contents('view/page/cart/address.php');
                        }
                    }
                    else{
                        $view = file_get_contents('view/page/cart/address.php');
                    }
                }
                else{
                    $view = file_get_contents('view/page/cart/address.php');
                }
            }
            else{
                $view = file_get_contents('view/page/cart/address.php');
            }
        }
        else{
            $view = file_get_contents('view/page/cart/address.php');
        }


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Summuary Action
     * 
     * @return string
     */
    private function summuaryAction()
    {
        $view = file_get_contents('view/page/cart/confirm.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    
    /**
     * Display SaveCart Action
     * 
     * @return string
     */
    private function saveCartAction()
    {
        

        $cartRepository = new CartRepository();
        $cartRepository->saveCart();

        $view = file_get_contents('view/page/cart/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}