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
    // ** Connexion à la base de données ** :
    require('rdvController.php');
    ?>
    <!-- Formulaire -->
    <form method="post" action="viewAddRdv">
        <fieldset>
            <legend>Nouveau Rendez-Vous</legend>
            <label>Nom du Patient</label><br>
            <select name="idPatients">
                <?php foreach ($donnees_patients as $patient) : ?>
                    <option value="<?= $patient['id'] ?>"><?= $patient['lastname'] ?></option>
                <?php endforeach ?>
            </select><br>
            <label>Date du rendez-vous</label><br><input type="datetime" name="dateHour" /><br>
            <input type="submit" name="rdv" value="Prendre RDV">
        </fieldset>
    </form>
    <!-- Fin du formulaire -->
</body>
</html>