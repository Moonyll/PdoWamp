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
// On récupère tout le contenu de la table
$reponse_profil = $bdd->query('SELECT * FROM patients');
$donnees_patients = $reponse_profil->fetchall();
?>
<!-- Formulaire -->
<form method="post" action="ajout-rendezvous">
    <fieldset>
        <legend>Nouveau Rendez-Vous</legend>
            <label>Nom du Patient</label><br>
                <select name="idPatients">      
                    <?php foreach ($donnees_patients as $patient): ?>
                        <option value="<?= $patient['id'] ?>"><?= $patient['lastname'] ?></option>
                    <?php endforeach ?>
                </select><br> 
            <label>Date du rendez-vous</label><br><input type="datetime" name="dateHour"/><br>
            <input type="submit" name="rdv" value="Prendre RDV">
    </fieldset>
</form>
<!-- Fin du formulaire -->
<?php
// Validation des données du formulaire
if (isset($_POST['rdv'])&& isset($_POST['idPatients'])&& isset($_POST['dateHour']))
{
    //
    $choosenIdPatient = $_POST['idPatients'];
    $choosenDate = $_POST['dateHour'];
    //
    // Préparation de la requête
    //
    $req = $bdd->prepare('INSERT INTO appointments(idPatients, dateHour) VALUES(:idPatients,:dateHour)');
    //
    // Exécution de la requête
    //
    $req->execute(array('idPatients' => $choosenIdPatient,'dateHour' => $choosenDate));
  
    //
    header('Location: ok_rdv.php'); 
    //
    // Fermeture de la session
    //
    mysqli_close($bdd);
}
else
{
    echo "";
}
?>
</body>
</html>
