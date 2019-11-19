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
<p><a href="homeHospital.php">Accueil</a><a href="viewListRdv.php">Retour liste des rendez-vous</a></p>
<?php
// ** Connexion bdd & requêtes : ** :
require_once('rdvController.php');

foreach($donnees_det_app as $app) : ?>
<p>** Information sur le rendez-vous du patient <?= $app['lastName']?> **</p>
<p>Pour informations, Mr <?= $app['lastName']?> <?= $app['firstName'] ?> a pris rendez-vous le :
<form method="post" action="">
    <input type="text" name="up_rdv_id" value ="<?= $app['id'] ?>" hidden/>
    <input type="text" name="up_rdv_date" value ="<?= $app['dateHour'] ?>" />
    <input type="submit" name="up_rdv" value="modifier" /></p>
</form>
<?php endforeach ?>
</body>
</html>
