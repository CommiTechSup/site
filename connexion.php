<?php
try
{
	$bdd = new PDO('mysql:host=mysql51-142.perso;dbname=commitecdvad', 'commitecdvad', 'ItechSup44');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->query('SELECT post_subject, post_text FROM phpbb_posts');

echo 'Test SQL :<ul>';
while ($donnees = $req->fetch())
{
	echo '<li>Titre : ' . $donnees['post_subject'] . ' / Article:' . $donnees['post_text'] . ' EUR)</li>';
}
echo '</ul>';

$req->closeCursor();

?>