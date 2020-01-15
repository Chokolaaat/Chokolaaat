<?php 

//Affiche le titre de la catégorie
echo '<h2>Discussions dans ' . $chokoCategorie[0]['catName'] . '</h2>';

//Affiche toutes les discussions
foreach ($chokoDiscussions as $discussions){
	echo '<a href="index.php?controller=forum&action=discussion&disc=' . $discussions['idDiscussion']. '">' . $discussions['disName']. '</a><br>';
}
?>