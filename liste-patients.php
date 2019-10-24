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
<p><a href="index2.php">Accueil</a><a href="ajout-patient.php">Ajouter un patient</a></p>
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
$reponse_patients = $bdd->query('SELECT * FROM patients');

while ($donnees_patients = $reponse_patients->fetch())
{
echo "<p> Nom : ".$donnees_patients['lastname']."</p>";
echo "<p> Prénom : ".$donnees_patients['firstname']."</p>";
echo "<p> Date de naissance : ".$donnees_patients['birthdate']."</p>";
echo "<p> Email : ".$donnees_patients['mail']."</p>";
echo "<p> Téléphone: ".$donnees_patients['phone']."</p>";
// Variables de session dans $_SESSION
$idpatient = (int)$donnees_patients['id'];
echo "<form method=\"post\" action=\"profil-patient.php\"><input type=\"text\" name=\"patient_id\" value=".$idpatient." hidden><input type=\"submit\" name=\"details\" value=\"details\"></form>";
echo "***";
}
$reponse_patients->closeCursor(); // Termine le traitement de la requête
?>
</body>
</html>
