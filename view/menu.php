<nav>
    <ul class="nav nav-justified">
        <li><a href="index.php?controller=home&action=index">Accueil</a></li>
        <li><a href="index.php?controller=forum&action=index">Forum</a></li>
        <?php
        if(isset($_SESSION['right']) && $_SESSION['right'] == 'admin'){
        ?>
            <li><a href="index.php?controller=admin&action=index">Gestion du forum</a></li>
            <li><a href="index.php?controller=admin&action=listUsers&field=useLogin">Gestion des utilisateurs</a></li>
        <?php
        }
        ?>
        <!--<li><a href="index.php?controller=home&action=contact">Contact</a></li>-->
        <?php
        if(isset($_SESSION['right']) && ($_SESSION['right'] == 'admin' || $_SESSION['right'] == 'customer')){
        ?>
            <li><a href="index.php?controller=profile&action=info">Profil</a></li>
            <li><a href="index.php?controller=login&action=logout">Se déconnecter</a></li>
        <?php
        } else {
        ?>
            <li><a href="index.php?controller=login&action=index">Se connecter</a></li>
        <?php
        }
        ?>
    </ul>
</nav>
</div>


