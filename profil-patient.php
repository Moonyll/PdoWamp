<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

if(isset($_POST['patient_id']))
{
$_SESSION['id'] = $_POST['patient_id'];
}
else
{
var_dump('toto');
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>PDO</title>
</head>
<body>
<p><a href="index2.php">Accueil</a><a href="ajout-patient.php">Ajouter un patient</a></p>
<?php

if(isset($_SESSION['id']))
{
        $detail =$_SESSION['id'];
       

        try
        {
            // On se connecte à MySQL
            $bdd2 = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
        }
        // Si tout va bien, on peut continuer
        // On récupère tout le contenu de la table
        $reponse_profil = $bdd2->query('SELECT * FROM patients WHERE id ='.$detail.'');

        while ($donnees_patients = $reponse_profil->fetch())
        { ?>
        <!-- Formulaire -->
        <form method="post" action="">
        <fieldset>
                <legend>Détails Patient</legend>
        <label>Nom</label><br><input type="text" name="uplastname" maxlength="25" value ="<?= $donnees_patients['lastname'] ?>"/><br>
        <label>Prénom</label><br><input type="text" name="upfirstname" maxlength="25" value ="<?= $donnees_patients['firstname'] ?>"/><br>
        <label>Date de naissance</label><br><input type="date" name="upbirthdate" class="forms" value ="<?= $donnees_patients['birthdate'] ?>" /><br>
        <label>Email</label><br><input type="email" name="upmail" value ="<?= $donnees_patients['mail'] ?>" /><br>
        <label>Téléphone</label><br><input type="tel" name="upphone" maxlength="25" value ="<?= $donnees_patients['phone'] ?>"/><br>
        <label></label><br><input name="upid" value ="<?= $detail ?>" hidden/><br>
        <input type="submit" value ="mettre à jour" name="uppatient">
        <!-- //<input type="submit" value ="supprimer" name="delpatient"> -->
        </fieldset>
        </form>
        <!-- Fin du formulaire -->
         <?php }

        // Validation des données du formulaire

        if(true)
        // if (isset($_POST["uppatient"])&& isset($_POST["uplastname"])&& isset($_POST["upfirstname"]) && isset($_POST["upbirthdate"]) && isset($_POST["upmail"]) && isset($_POST["upphone"]) && isset($_POST['id']))
        {
        
        //
        $lastname = $_POST['uplastname'];
        $firstname = $_POST['upfirstname'];
        $birthdate = $_POST['upbirthdate'];
        $mail = $_POST['upmail'];
        $phone = $_POST['upphone'];
        $id = $_POST['upid'];

        // Préparation de la requête
        //
        $req = $bdd2->prepare('UPDATE patients SET lastname = :uplastname, firstname = :upfirstname, birthdate = :upbirthdate, mail = :upmail, phone = :upphone WHERE id = :upid');       
        //
        // Exécution de la requête
        //
     
        $req->execute(array(
            'uplastname' => $lastname,
            'upfirstname' => $firstname,
            'upbirthdate' => $birthdate,
            'upmail' => $mail,
            'upphone' => $phone,
            'upid' => $id
        ));
        //header('Location: ok_patient.php'); 

        // Fermeture de la session
        //
        mysqli_close($bdd2);

    }
else
{
    echo "";
}

        $reponse_profil->closeCursor(); // Termine le traitement de la requête       
}
else
{
    echo "détails patient inconnu...";
   
}
?>
</body>
</html>
