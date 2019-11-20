<?php
// On démarre la session avant d'écrire du code HTML :
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Bootsrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Jquery CDN -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <!-- Style CSS -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="search.js"></script>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">

  <title>PDO</title>
</head>

<body>
<div class="d-flex justify-content-center">  
<!-- Date Ajax-->
  <!-- <div id="result">
    <p></p>
  </div>
  <button type="button" class="btn btn-dark text-light">Afficher la date & l'heure</button> -->
  <!-- Barre de recherche-->
  <!-- <p>
    <form>
      Rechercher patient :<input type="text" placeholder="prenom" onkeyup="showFoundPatient(this.value)">
    </form>
  </p>
  <p>Résultat: <span id="searchPatient"></span></p> -->
  <!-- Barre de recherche-->
  <h1 class="p-2">
    <a href="homeHospital.php" data-toggle="tooltip" title="Retour accueil"><i class="fas fa-home text-info"></i></a>
    <a href="viewAddPatient.php" data-toggle="tooltip" title="Ajouter patient"><i class="fas fa-user-injured text-primary"></i></a>
  </p>
  </div>
  <?php
  // ** Connexion bdd & requêtes : ** :
  require_once('patientController.php');
  
  // echo 'L\'hopital compte ' . $nb_pat['total'] . ' patients au total.';
  
  while ($donnees_patients = $reponse_patients->fetch()) { ?>
    <div class="d-flex justify-content-center">
      <div class="card text-white bg-dark mb-3 text-left" style="max-width: 18rem;">
        <div class="card-header bg-info border border-light">
          <i class="fab fa-github-alt"></i>
          <?= $donnees_patients['firstname'] ?> <?= '  ' . $donnees_patients['lastname'] ?>
        </div>
        <div class="card-body  bg-secondary border border-light">
          <i class="fas fa-bone"> </i><?= '  ' . $donnees_patients['birthdate'] ?>
        </div>
        <div class="card-footer border border-light">
          <p><i class="fas fa-mail-bulk"></i> <?= '  ' . $donnees_patients['mail'] ?> </p>
          <p><i class="fas fa-phone"></i> <?= '  ' . $donnees_patients['phone'] ?></p>
          <!--Variables de session dans $_SESSION-->
          <?php $idpatient = (int) $donnees_patients['id'] ?>
          <p class="inline-flex clearfix">
            <form method=post action="viewDetailPatient.php">
              <input type="text" name="patient_id" value="<?= $idpatient ?>" hidden>
              <i class="fas fa-info-circle text-success"></i>
              <input type="submit" name="details" value="Détails" class="btn btn-info border border-light">
            </form>
            <form method=post action="">
              <input type="text" name="patient_id" value="<?= $idpatient ?>" hidden>
              <i class="fas fa-minus-circle text-danger"></i>
              <input type="submit" name="delpat" value="Supprimer" class="btn btn-info border-light">
            </form>
          </p>
        </div>
      </div>
    </div>
  <?php } ?>
</body>
</html>