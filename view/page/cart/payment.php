<h2>Choisir un moyen de paiement</h2>
<form action="index.php?controller=cart&action=payment" method="post">
    <input type="radio" name="payment" value="invoice"> Paiement sur facture (+ CHF 2.- de frais)
    <br>
    <input type="radio" name="payment" value="advance"> Paiement par avance (aucun frais)
    <br>
    <input type="radio" name="payment" value="creditcart"> Paiement par carte de crédit (+ 2% du montant total du panier d’achat)
    <br><br>
    <button type="submit" class="btn btn-default">Suivant</button>
</form>