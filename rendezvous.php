<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
if (isset ($_POST['rdv_id']))
{
$_SESSION['id'] = $_POST['rdv_id'];
}
else
{
echo '';
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>PDO</title>
</head>
<body>
<p><a href="index2.php">Accueil</a><a href="liste-rdv.php">Retour liste des rendez-vous</a></p>
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
$id_app = $_SESSION['id'];
$reponse_det_app = $bdd->query('SELECT appointments.id,dateHour,lastName,firstName FROM appointments INNER JOIN patients ON appointments.idPatients=patients.id WHERE appointments.id = '.$id_app.'');
$donnees_det_app = $reponse_det_app->fetchall();
?>
<?php foreach($donnees_det_app as $app) : ?>
<p>** Information sur le rendez-vous du patient <?= $app['lastName']?> **</p>
<p>Pour informations, Mr <?= $app['lastName']?> <?= $app['firstName'] ?> a pris rendez-vous le :
<form method="post" action="">
    <input type="text" name="up_rdv_id" value ="<?= $app['id'] ?>" hidden/>
    <input type="text" name="up_rdv_date" value ="<?= $app['dateHour'] ?>" />
    <input type="submit" name="up_rdv" value="modifier" /></p>
</form>
<?php endforeach ?>
<?php
 if(isset($_POST['up_rdv']) && isset($_POST['up_rdv_id']) && isset($_POST['up_rdv_date']))
 {
 $up_rdv = $_POST['up_rdv_date'];
 $up_rdv_id = $_POST['up_rdv_id'];
 // Préparation de la requête
 $req = $bdd->prepare('UPDATE appointments SET dateHour = :up_rdv_date WHERE id = :up_rdv_id');       
 // Exécution de la requête
 $req->execute(array(
    'up_rdv_date' => $up_rdv,
    'up_rdv_id' => $up_rdv_id
 ));
 echo 'Le rdv a bien été mis à jour !';
 }
$reponse_det_app->closeCursor(); // Termine le traitement de la requête ?>
</body>
</html>
