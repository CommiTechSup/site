<?php 
    require_once('class/connexion.class.php');
    require_once('class/news.class.php');

    $connexion = new Connexion();
    $news = new News($connexion->getConnexion());

	$id = $_GET['key'];

	$news->deleteNews($id);
?>