<h2>Confirmation de commande - Merci de votre achat : Num. <?php echo random_int(3000, 2147483647) ?></h2>
Envoyé à: <?php echo $_SESSION['userInfo']['firstname'] . ' ' . $_SESSION['userInfo']['lastname']; ?><br>
Livraison: <?php 
if ($_SESSION['delivery'] == 'poste') {
    echo 'Par la poste';
}
else {
    echo 'Retrait en magasin';
}
?><br>
Paiement: <?php 
if ($_SESSION['payment'] == 'invoice') {
    echo 'Sur facture';
}
elseif ($_SESSION['payment'] == 'advance') {
    echo 'Paiement par avance';
}
else {
    echo 'Carte de crédit';
}
?><br>
<?php
echo $_SESSION['userInfo']['gender'] . '<br>';
echo $_SESSION['userInfo']['firstname'] . ' ' . $_SESSION['userInfo']['lastname'] . '<br>';
echo $_SESSION['userInfo']['street'] . ' ' . $_SESSION['userInfo']['number'] . '<br>';
echo $_SESSION['userInfo']['postcode'] . ' ' . $_SESSION['userInfo']['locality'] . '<br>';

echo '<table class="table table-striped">
        <thead>
            <tr>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
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
    echo $product['quantity'];
    echo '</td>';
    echo '<td>';
    echo 'CHF ' . ($product['proPrice'] * $product['quantity']);
    echo '</td>';
    echo '</tr>';
    $totalPrice += $product['proPrice'] * $product['quantity'];
}


// Livraison
if ($_SESSION['delivery'] == 'poste') {
    echo '<tr><td>';
    echo 'Par poste';
    echo '</td><td></td><td></td><td>';
    echo 'CHF 7.95';
    echo '</td></tr>';
    $totalPrice += 7.95;
}
else {
    echo '<tr><td>';
    echo 'Retrait en magasin';
    echo '</td><td></td><td></td><td>';
    echo 'CHF 0';
    echo '</td></tr>';
}


// Total intermédiaire
echo '<tr><td>';
echo 'Total';
echo '</td><td></td><td></td><td>';
echo 'CHF ' . $totalPrice;
echo '</td></tr>';


// Paiement
if ($_SESSION['payment'] == 'invoice') {
    echo '<tr><td>';
    echo 'Sur facture (+ CHF 2.-)';
    echo '</td><td></td><td></td><td>';
    echo 'CHF 2';
    echo '</td></tr>';
    $finalTotalPrice = $totalPrice + 2;
}
elseif ($_SESSION['payment'] == 'advance') {
    echo '<tr><td>';
    echo 'Paiement par avance';
    echo '</td><td></td><td></td><td>';
    echo 'CHF 0';
    echo '</td></tr>';
    $finalTotalPrice = $totalPrice;
}
else {
    echo '<tr><td>';
    echo 'Carte de crédit (+ 2%)';
    echo '</td><td></td><td></td><td>';
    echo 'CHF ' . ($totalPrice / 100 * 2);
    echo '</td></tr>';
    $finalTotalPrice = $totalPrice + ($totalPrice / 100 * 2);
}

// Total
echo '<tr><td>';
echo 'Total à payer';
echo '</td><td></td><td></td><td>';
echo 'CHF ' . $finalTotalPrice;
echo '</td></tr></tbody></table>';

// Bouton "Envoyer la commande"
echo '<a href="index.php?controller=cart&action=summuary"><button type="button" class="btn btn-secondary">Envoyer la commande</button></a>';
?>