<?php 

//Affiche le titre de la catégorie
echo '<h2>Discussions dans ' . $chokoCategorie[0]['catName'] . '</h2>';

//Affiche toutes les discussions prioritaires
foreach ($chokoDiscussions as $discussions){
	//Affiche seulement les discussion épinglées
	if($discussions['disPrioritized'] == 1){
		echo '<a href="index.php?controller=forum&action=discussion&disc=' . $discussions['idDiscussion']. '">' . $discussions['disName']. '</a> (épinglé)';
		//Affiche si la discussion est fermée
		if($discussions['disActive'] == 0){
			echo '(fermée)<br>';
		}
		else{
			echo '<br>';
		}
	}
	else{}
}

//Affiche toutes les discussions non-prioritaires
foreach ($chokoDiscussions as $discussions){
	//Affiche seulement les discussion non-épinglées
	if($discussions['disPrioritized'] == 0){
		echo '<a href="index.php?controller=forum&action=discussion&disc=' . $discussions['idDiscussion']. '">' . $discussions['disName']. '</a>';
		//Affiche si la discussion est fermée
		if($discussions['disActive'] == 0){
			echo '(fermée)<br>';
		}
		else{
			echo '<br>';
		}
	}
	else{}
}
?>
