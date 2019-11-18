<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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

// *** PAGINATION ***
// Page
$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
// Limite :
$limite = 2;
$debut = ($page - 1) * $limite;
//
// Requête :
$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM patients LIMIT :limite OFFSET :debut';
//
// On prépare la requête à son exécution :
$query = $bdd->prepare($query);
// Récupération du nombre d'éléments total enregistrés du fait de SQL_CALC_FOUND_ROWS :
$resultFoundRows = $bdd->query('SELECT COUNT(*) FROM patients');
// On doit extraire le nombre du jeu de résultat :
$nombredElementsTotal = $resultFoundRows->fetchColumn();
// Nombre de pages :
$nombreDePages = ceil($nombredElementsTotal / $limite);
// Binding :
// Limite :
$query->bindValue(
  'limite',         // Le marqueur est nommé « limite »
   $limite,         // Il doit prendre la valeur de la variable $limite
   PDO::PARAM_INT   // Cette valeur est de type entier.
);
// Début :
$query->bindValue(
  'debut',
   $debut,
   PDO::PARAM_INT);
//
// Maintenant qu'on a lié la valeur à la requête, on peut l'exécuter :
$query->execute();
//
// Partie Boucle :
while ($element = $query->fetch())

// C'est là qu'on affiche les données  :)
{ ?>
  <p> Nom : <?= $element['lastname'] ?> </p>
  <p> Prénom : <?= $element['firstname'] ?></p>
  <p> Date de naissance : <?= $element['birthdate'] ?></p>
  <p> Email : <?=  $element['mail'] ?> </p>
  <p> Téléphone: <?= $element['phone'] ?></p>
  <!--Variables de session dans $_SESSION-->
  <?php $idpatient = (int)$element['id'] ?>
  <form method=post action="profil-patient.php"><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="details" value="+ détails..."></form>
  <form method=post action=""><input type="text" name="patient_id" value="<?= $idpatient ?>" hidden><input type="submit" name="delpat" value="- supprimer"></form>
  <p>***</p>
  <?php }
//
// Partie "Liens" :
//
// N° de page en paramètre :
if ($page > 1):
    ?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;
// On va effectuer une boucle autant de fois que l'on a de pages :
for ($i = 1; $i <= $nombreDePages; $i++):
    ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;
// Avec le nombre total de pages, on peut aussi masquer le lien vers la page suivante quand on est sur la dernière :
if ($page < $nombreDePages):
    ?> — <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;
?>
</body>
</html>