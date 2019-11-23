<?php
if(isset($_SESSION['right']) && $_SESSION['right'] == 'admin' || $_SESSION['right'] == 'customer'){
?>
<h2>Profil</h2>
Nom d'utilisateur: <?php echo $_SESSION['userInfo']['username']; ?>

<h2>Paniers enregistrés</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<?php
		if(isset($_SESSION['carts']) && count($_SESSION['carts']) > 0){
			echo '<table class="table table-striped">
				<thead>
					<tr>
						<th>Nom du panier</th>
						<th>Nombre d\'articles différents</th>
						<th>Montant total</th>
						<th>Détail</th>
					</tr>
				</thead>
				<tbody>';
				$totalPrice = 0;
					foreach ($_SESSION['carts'] as $cart) {
                        echo '<tr>';
						echo '<td>';
						echo 'Panier enregistré ' . $cart['carNumber'];
						echo '</td>';
						echo '<td>';
						echo 'CHF ' . $product['proPrice'];
						echo '</td>';
						echo '<td>';
						echo '<img src="resources/image/ICT150-Details.png" alt="Détails">';
						echo '<a href="index.php?controller=profile&action=delete&idCart=' . $product['idCart'] . '"><img src="resources/image/ICT150-Delete.png" alt="Supprimer"></a>';
						echo '<img src="resources/image/ICT150-Cart.png" alt="Panier">';
						echo '</td>';
						echo '<td>';
						echo $product['quantity'];
						echo '</td>';
						echo '</tr>';
					}
            echo '</tbody>';
			echo '</table>';
		}
		else{
			echo 'Aucun panier n\'est enregistré.';
		}
		?>
	</div>


<?php
}
else{
	header("index.php");
}
?>