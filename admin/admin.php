<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=freeman034;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

echo '<!DOCTYPE html><html><head><meta charset="utf-8" /><link rel="stylesheet" href="../style.css" /></head><body>';
echo '<h1>Administration</h1>';
echo '<p><center><a href="../index.php">Retour à la liste des billets</a></center></p>';

$reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC');
while ($donnees = $reponse->fetch())
	{
		if (empty($donnees))
			{
				echo '<div class="news"><p>Aucun billet</p></div>'; exit;
			}
		else
			{	
				echo '<div class="news"><p>' . htmlspecialchars($donnees['titre']) . ' - le ' . htmlspecialchars($donnees['date_creation_fr']) . ' - <b><a href="admin.php?d='. $donnees['id'] .'">Supprimer</a></b></p></div>';
			}
	}
		
echo '</body></html>';

$reponse->closeCursor();

if (isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['auteur']) AND !empty($_POST['titre']) AND !empty($_POST['contenu']) AND !empty($_POST['auteur']))
	{
		$req = $bdd->prepare('INSERT INTO billets(id, titre, contenu, date_creation, auteur) VALUES(NULL, ?, ?, NOW(), ?)');
		$req->execute(array(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']), htmlspecialchars($_POST['auteur'])));
		$message_add = TRUE;
		echo '<head><meta http-equiv="Refresh" content="5"></head>';
	}
	
if (isset($_GET['d']) AND !empty($_GET['d']))
	{
		$req = $bdd->exec('DELETE FROM billets WHERE id=' . $_GET['d'] . '');
		$message_del = TRUE;
		echo '<head><meta http-equiv="Refresh" content="5"></head>';
	}

?>

<html>
<div class="news"><h1>Poster un message</h1>
<fieldset>

<form method="post" action="admin.php"> 
<label>Auteur : </label><input type="text" name="auteur">
<label>Titre : </label><input type="text" name="titre">
<label>Message : </label><input type="text" name="contenu">
<input type="submit" value="Envoyer"></p>
<?php
if (isset($message_add) AND ($message_add == TRUE)) { echo '<b>Billet ajouté !</b>'; }
if (isset($message_del) AND ($message_del == TRUE)) { echo '<b>Billet supprimé !</b>'; }
?>

</fieldset>
</html>