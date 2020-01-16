<?php 

//Affiche le titre de la catégorie
echo '<h2>Discussions dans ' . $chokoCategorie[0]['catName'] . '</h2>';

//Affiche toutes les discussions prioritaires
foreach ($chokoDiscussions as $discussions){
	if($discussions['disPrioritized'] == 1){
		echo '<a href="index.php?controller=forum&action=discussion&disc=' . $discussions['idDiscussion']. '">' . $discussions['disName']. '</a> (épinglé)';
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
	if($discussions['disPrioritized'] == 0){
		echo '<a href="index.php?controller=forum&action=discussion&disc=' . $discussions['idDiscussion']. '">' . $discussions['disName']. '</a>';
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
