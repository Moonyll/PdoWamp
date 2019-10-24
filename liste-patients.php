<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
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

  if(isset($_GET['user']))
  {
    $user = (String) trim($_GET['user']);

    $req = $bdd->query('SELECT * FROM patients WHERE lastname LIKE ? LIMIT 10', array("$user%"));
    $req = $req->fetchall();
  
        foreach($req as $pat)
        { ?>   
            <div style="margin-top: 20px 0; border-bottom: 2px solid #ccc"><?= $pat['lastname'] . " " . $pat['firstname'] ?></div><?php    
        }
  } 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>PDO</title>
</head>
<body>

<!-- Barre de recherche-->
<form method=get action="">
    <input class="form-control" type="text" id="search-user" value="" placeholder="Recherche patient"/>
    <div id="result-search"></div> <!-- C'est ici que nous aurons nos résultats de notre recherche -->
</form>
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
  $(document).ready(function(){
    $('#search-user').keyup(function(){
      $('#result-search').html('');

      var patient = $(this).val();

      if(patient != ""){
        $.ajax({
          type: 'GET',
          url: 'fonctions/recherche_utilisateur.php',
          data: 'user=' + encodeURIComponent(patient),
          success: function(data){
            if(data != ""){
              $('#result-search').append(data);
            }else{
              document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun utilisateur</div>"
            }
          }
        });
      }
    });
  });
</script>

</html>
