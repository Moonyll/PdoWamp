<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>PDO</title>
</head>
<body>
<p><a href="index2.php">Accueil</a></p>
<?php
try
{
    // On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
// On récupère tout le contenu de la table
$reponse_app = $bdd->query('SELECT appointments.id,dateHour,lastName FROM appointments INNER JOIN patients ON appointments.id=patients.id');
$donnees_app = $reponse_app->fetchall();
?>
<?php foreach($donnees_app as $app) : ?>
<p>Date du rendez-vous : <?= $app['dateHour'] ?> - Patient : <?= $app['lastName'] ?>
<form method="post" action="rendezvous.php">
<input type="text" name="rdv_id" value="<?= $app['id'] ?>" hidden />
<input type="submit" name="details" value="infos" />
</form>
</p>
<?php endforeach ?>
<?php $reponse_app->closeCursor(); // Termine le traitement de la requête ?>
</body>
</html>
