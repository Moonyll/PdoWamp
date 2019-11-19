<?php
// On démarre la session AVANT d'écrire du code HTML
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
   // ** Connexion bdd & requêtes : ** :
   require_once('rdvController.php');
    ?>
    <?php foreach ($donnees_app as $app) : ?>
        <p>Date du rendez-vous : <?= $app['dateHour'] ?> - Patient : <?= $app['lastName'] ?>
            <form method="post" action="viewUpdateRdv.php">
                <input type="text" name="rdv_id" value="<?= $app['id'] ?>" hidden />
                <input type="submit" name="details" value="infos" />
            </form>
            <form method="post" action="">
                <input type="text" name="rdv_id" value="<?= $app['id'] ?>" hidden />
                <input type="submit" name="delete" value="supprimer" />
            </form>
        </p>
    <?php endforeach ?>
    <?php if (isset($_POST['delete']) && isset($_POST['rdv_id'])) {
        $del = $bdd->prepare('DELETE FROM appointments WHERE id=' . $_POST['rdv_id'] . '');
        $del->bindValue(':id', $_POST['rdv_id']);
        $del->execute();
        header('Location: viewDelRdvOk.php');;
    }
    ?>
</body>
</html>