<?php
// On démarre la session avant d'écrire du code HTML :
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>PDO</title>
</head>
<body>
    <p><a href="homeHospital.php">Accueil</a></p>
    <?php
    // ** Connexion bdd & requêtes : **
    require_once('patientController.php');
    ?>
    <!-- Formulaire -->
    <form method="post" action="viewAddPatient.php">
        <fieldset>
            <legend>Nouveau Patient - Information Personnelles </legend>
            <label>Nom</label><br><input type="text" name="lastname" placeholder="nom" maxlength="25" /><br>
            <label>Prénom</label><br><input type="text" name="firstname" placeholder="prénom" maxlength="25" /><br>
            <label>Date de naissance</label><br><input type="date" name="birthdate" class="forms" /><br>
            <label>Email</label><br><input type="email" name="mail" placeholder="adresse mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" /><br>
            <label>Téléphone</label><br><input type="tel" name="phone" placeholder="XX XX XX XX XX" maxlength="25" /><br>
            <input type="submit" name="newpatient">
        </fieldset>
    </form>
   </body>
</html>