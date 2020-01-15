<h2>Catégories</h2>
<?php 
foreach ($forumRepository as $ $cats){
	echo '<a href="index.php?controller=forum&action=allDiscussions&cat=' . $cats['idCategory']. '">' . $cats['catName']. '</a>';
}
?>