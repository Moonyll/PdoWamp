<?php
// On démarre la session avant d'écrire du code HTML :
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="search.js"></script>
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
  <p><a href="homeHospital.php">Accueil</a><a href="viewAddPatient.php">Ajouter un patient</a></p>
  <?php
  // ** Connexion bdd & requêtes : ** :
  require_once('patientController.php');
  //
  echo 'L\'hopital compte ' . $nb_pat['total'] . ' patients au total.';
  //
  while ($donnees_patients = $reponse_patients->fetch()) { ?>
    <p> Nom : <?= $donnees_patients['lastname'] ?> </p>
    <p> Prénom : <?= $donnees_patients['firstname'] ?></p>
    <p> Date de naissance : <?= $donnees_patients['birthdate'] ?></p>
    <p> Email : <?= $donnees_patients['mail'] ?> </p>
    <p> Téléphone: <?= $donnees_patients['phone'] ?></p>

    <!--Variables de session dans $_SESSION-->
    <?php $idpatient = (int) $donnees_patients['id'] ?>
    <form method=post action="viewDetailPatient.php"><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="details" value="+ détails..."></form>
    <form method=post action=""><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="delpat" value="- supprimer"></form>
    <p>***</p>
  <?php } ?>
</body>
</html>