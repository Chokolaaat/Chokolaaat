<?php 

//Affiche le titre de la discussion
echo '<h2>'. $chokoDiscussion[0]['disName'] .'</h2>';

//Affiche les tags
echo 'Tags : ';
foreach ($chokoTags as $tag){
	echo $tag['tagName'] . ', ';
}

echo '<br><br>';

//Affihe les messages
foreach ($chokoMessage as $message){
	echo 'Le message de '. $message['usePseudo'] .' dit "'. $message['mesText'] .'".<br>';
}
?>
