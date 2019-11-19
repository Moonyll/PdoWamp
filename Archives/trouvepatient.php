 <?php
  //
  try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '');
  } catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
  }
  // Si tout va bien, on peut continuer
  // On récupère tout le contenu de la table
  $reponse_patients = $bdd->query('SELECT * FROM patients');

  $donnees_patients = $reponse_patients->fetchall();

  // get the q parameter from URL
  $q = $_REQUEST["q"];

  $hint = "";

  // lookup all hints from array if $q is different from ""
  if ($q !== "") {
    $q = strtolower($q);
    $len = strlen($q);
    foreach ($donnees_patients as $patient) {
      if (stristr($q, substr($patient['firstname'], 0, $len))) {
        if ($hint === "") {
          $hint = $patient['firstname'];
        } else {
          $hint = $hint . ',' . $patient['firstname'];
        }
      }
    }
  }
  // Output "no suggestion" if no hint was found or output correct values
  echo $hint === "" ? "Aucun patient trouvé !" : $hint;
  ?>
