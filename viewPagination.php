<?php
// *** PAGINATION ***

  // Page courante :
  $page = (!empty($_GET['page']) ? $_GET['page'] : 1);

  // Limite ou nombre de clients affichés par page :
  $limite = 2;
  
  $debut = ($page - 1) * $limite;
  
  // Requête :
  $query = 'SELECT SQL_CALC_FOUND_ROWS * FROM patients LIMIT :limite OFFSET :debut';
  
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
    PDO::PARAM_INT
  );
  
  // Maintenant qu'on a lié la valeur à la requête, on peut l'exécuter :
  $query->execute();
  ?>