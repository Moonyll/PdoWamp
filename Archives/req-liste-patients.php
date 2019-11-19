<?php
// ** Requêtes ** :

  // 1. Contenu de la table :
  $reponse_patients = $bdd->query('SELECT * FROM patients');
  // 2. Nombre de patients :
  $number_pat = $bdd->query('SELECT COUNT(*) AS total FROM patients');
  $nb_pat = $number_pat->fetch();
  //
  ?>