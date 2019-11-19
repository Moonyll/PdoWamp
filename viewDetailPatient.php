<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

if (isset($_POST['patient_id'])) {
    $_SESSION['id'] = $_POST['patient_id'];
} else {
    echo '';
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>PDO</title>
</head>
<body>
    <p><a href="homeHospital.php">Accueil</a><a href="viewListPatients.php">Retour liste des patients</a></p>
    <?php
    if (isset($_SESSION['id']))
    {
       // ** Connexion bdd & requêtes : **
        require_once('patientController.php');

        while ($donnees_patients = $reponse_profil->fetch()) { ?>
            <!-- Formulaire -->
            <form method="post" action="">
                <fieldset>
                    <legend>Détails Patient</legend>
                    <label>Nom</label><br><input type="text" name="uplastname" maxlength="25" value="<?= $donnees_patients['lastname'] ?>" /><br>
                    <label>Prénom</label><br><input type="text" name="upfirstname" maxlength="25" value="<?= $donnees_patients['firstname'] ?>" /><br>
                    <label>Date de naissance</label><br><input type="date" name="upbirthdate" class="forms" value="<?= $donnees_patients['birthdate'] ?>" /><br>
                    <label>Email</label><br><input type="email" name="upmail" value="<?= $donnees_patients['mail'] ?>" /><br>
                    <label>Téléphone</label><br><input type="tel" name="upphone" maxlength="25" value="<?= $donnees_patients['phone'] ?>" /><br>
                    <label></label><br><input name="upid" value="<?= $detail ?>" hidden /><br>
                    <input type="submit" value="mettre à jour" name="uppatient">
                </fieldset>
            </form>
            <!-- Fin du formulaire -->
        <?php }
            // Rdv du patient :
            foreach ($donnees_app as $rdv) : ?>
            <p>Mr <?= $rdv['lastName'] ?> a pris rendez-vous le : <?= $rdv['dateHour'] ?></p>
    <?php endforeach;

        // Validation des données de mise à jour :
        include('viewUpdatePatient.php');
    }
    else
    {
        echo "détails patient inconnu...";
    }
    ?>
</body>
</html>