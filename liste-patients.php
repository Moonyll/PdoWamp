<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("button").click(function(){
        $.get("date-time.php", function(data){
            // Display the returned data in browser
            $("#result").html(data);
        });
    });
});
</script>
<title>PDO</title>
</head>
<body>
<!-- Date Ajax-->
<div id="result">
  <p></p>
</div>
<button type="button">Afficher la date & l'heure</button>
<!-- Barre de recherche-->
<p>
<form>
Rechercher patient :<input type="text" placeholder="prenom" onkeyup="showFoundPatient(this.value)">
</form>
</p>
<p>Résultat: <span id="searchPatient"></span></p>
<!-- Barre de recherche-->
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
{ ?>
<p> Nom : <?= $donnees_patients['lastname'] ?> </p>
<p> Prénom : <?= $donnees_patients['firstname'] ?></p>
<p> Date de naissance : <?= $donnees_patients['birthdate'] ?></p>
<p> Email : <?=  $donnees_patients['mail'] ?> </p>
<p> Téléphone: <?= $donnees_patients['phone'] ?></p>
<!--Variables de session dans $_SESSION-->
<?php $idpatient = (int)$donnees_patients['id'] ?>
<form method=post action="profil-patient.php"><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="details" value="+ détails..."></form>
<form method=post action=""><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="delpat" value="- supprimer"></form>
<p>***</p>
<?php }
// Supprimer patient
if (isset($_POST['delpat']) && isset($_POST['patient_id']))
{
    $del_app = $bdd->prepare('DELETE FROM appointments WHERE idPatients='.$_POST['patient_id'].'');
    $del_pat = $bdd->prepare('DELETE FROM patients WHERE id='.$_POST['patient_id'].'');    
    
    $del_app->bindValue(':idPatients', $_POST['patient_id']);
    $del_pat->bindValue(':id', $_POST['patient_id']);
    
    $del_app->execute();
    $del_pat->execute();
    
    header('Location: del_pat.php');;
}
$reponse_patients->closeCursor(); // Termine le traitement de la requête
?>
</body>
<script> 
function showFoundPatient(searchEntry) {
  if (searchEntry.length == 0) {
    document.getElementById("searchPatient").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("searchPatient").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "trouvepatient.php?q=" + searchEntry, true);
    xmlhttp.send();
  }
}
</script>
</html>