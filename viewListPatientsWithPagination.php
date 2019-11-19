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

  // Total patients :
  echo 'L\'hopital compte ' . $nb_pat['total'] . ' patients au total.';

  // *** PAGINATION ***
  require_once('viewPagination.php');
    
  // Partie Boucle :
  while ($element = $query->fetch())

  // C'est là qu'on affiche les données  :)
  { ?>
    <p> Nom : <?= $element['lastname'] ?> </p>
    <p> Prénom : <?= $element['firstname'] ?></p>
    <p> Date de naissance : <?= $element['birthdate'] ?></p>
    <p> Email : <?= $element['mail'] ?> </p>
    <p> Téléphone: <?= $element['phone'] ?></p>
    <!--Variables de session dans $_SESSION-->
    <?php $idpatient = (int) $element['id'] ?>
    <form method=post action="viewDetailPatient.php"><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="details" value="+ détails..."></form>
    <form method=post action=""><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="delpat" value="- supprimer"></form>
    <p>***</p>
  <?php } ?>
  
<?php
// Partie "Liens" :
  
// N° de page en paramètre :
if ($page > 1) : ?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;
 
// On va effectuer une boucle autant de fois que l'on a de pages :
for ($i = 1; $i <= $nombreDePages; $i++) : ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;
 
// Avec le nombre total de pages, on peut aussi masquer le lien vers la page suivante quand on est sur la dernière :
if ($page < $nombreDePages) : ?> — <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;
?>
</body>
</html>