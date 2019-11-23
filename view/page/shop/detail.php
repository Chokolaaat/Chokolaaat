<div class="container">

	<h2>
		<?php
			echo $product[0]['proName'];
		?>
	</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php
			echo '<p>' . $product[0]['proDescription'] . '</p>';
			echo '<p>Encore : ' . $product[0]['proQuantity'] . ' en stock</p>';

		?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php
			echo '<img src="resources/image/' . $product[0]['proImage'] . '"/>';
		?>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php
			echo '<p> CHF : ' . $product[0]['proPrice'] . '</p>';

			if($product[0]['proLike'] > 0) {
				echo '<p>Ce produit est aimée déjà  <strong>' . $product[0]['proLike'] . '</strong> fois ! </p>';
			}
		?>
		<?php
			echo '';
			if($product[0]['proQuantity'] <= 0){
				echo '<button type="button" class="btn btn-secondary" disabled>Ajouter au panier</button>';
			}
			else{
				echo '<a href="index.php?controller=cart&action=add&idProduct=' . $product[0]['idProduct'].'" ><button type="button" class="btn btn-secondary">Ajouter au panier</button></a>';
			}
		?>
		</div>
	</div>
</div>