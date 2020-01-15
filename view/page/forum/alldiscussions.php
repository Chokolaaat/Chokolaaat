<h2>Adresse d'envoi</h2>
<form action="index.php?controller=cart&action=address" method="post">
    <select name="gender">
        <option value="Mr">Mr</option>
        <option value="Mme">Mme</option>
        <option value="Other">Autre</option>
    </select><br>
    <input type="text" name="lastname" placeholder="Nom">
    <input type="text" name="firstname" placeholder="Prénom"><br>
    <input type="text" name="street" placeholder="Rue">
    <input type="text" name="number" placeholder="No"><br>
    <input type="text" name="postcode" placeholder="NPA">
    <input type="text" name="locality" placeholder="Localité"><br>
    <input type="text" name="email" placeholder="Adresse mail">
    <input type="text" name="phonenumber" placeholder="Téléphone">
    <br><br>
    <button type="submit" class="btn btn-default">Suivant</button>
</form>