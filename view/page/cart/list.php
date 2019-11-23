<div class="container">

	<h2>Liste des articles</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<?php
		if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
			echo '<table class="table table-striped">
				<thead>
					<tr>
						<th>Produit</th>
						<th>Prix</th>
						<th></th>
						<th>Quantité</th>
						<th></th>
                        <th>Sous-total</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>';
				$totalPrice = 0;
					foreach ($_SESSION['cart'] as $product) {
                        echo '<tr>';
						echo '<td>';
						echo $product['proName'];
						echo '</td>';
						echo '<td>';
						echo 'CHF ' . $product['proPrice'];
						echo '</td>';
						echo '<td>';
						echo '<a  onClick="ConfirmDelete(' . $product['idProduct'] . ', ' . $product['quantity'] . ', ' . $product['proQuantity'] . ')"><img src="resources/image/ICT150-Minus.png" alt="Diminuer"></a>';
						echo '</td>';
						echo '<td>';
						echo $product['quantity'];
						echo '</td>';
						echo '<td>';
						echo '<a href="index.php?controller=cart&action=addQuantity&idProduct=' . $product['idProduct'] . '"><img src="resources/image/ICT150-Plus.png" alt="Augmenter"></a>';
						echo '</td>';
						echo '<td>';
						echo  'CHF ' . ($product['proPrice'] * $product['quantity']);
						echo '</td>';
						echo '<td>';
						echo '<a href="index.php?controller=cart&action=delete&idProduct=' . $product['idProduct'] . '"><img src="resources/image/ICT150-Delete.png" alt="Supprimer"></a>';
						echo '</td>';
						echo '</tr>';
						$totalPrice += $product['proPrice'] * $product['quantity'];
					}
					echo '<tr><td>';
					echo 'Total';
					echo '</td><td></td><td></td><td>';
					echo 'CHF ' . $totalPrice;
					echo '</td><td></td><td></td><td></td>';
					echo '</tr>';
            echo '</tbody>';
			echo '</table>';
			echo '<a href="index.php?controller=cart&action=saveCart"><button type="button" class="btn btn-secondary">Enregistrer un panier</button></a>';
            echo '<a href="index.php?controller=cart&action=order"><button type="button" class="btn btn-secondary">Passer la commande</button></a>';
		}
		else{
			echo 'Le panier est actuellement vide.';
		}
		?>
	</div>
</div>