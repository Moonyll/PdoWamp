<?php
// ** Connexion à la base de données ** :
require('connexion.php');

// ** Liste des patients **
$reponse_profil = $bdd->query('SELECT * FROM patients');
$donnees_patients = $reponse_profil->fetchall();

// ** Liste des rendez-vous **
$reponse_app = $bdd->query('SELECT appointments.id,dateHour,lastName FROM appointments INNER JOIN patients ON appointments.idPatients=patients.id');
$donnees_app = $reponse_app->fetchall();

// ** Détail d'un rendez-vous **
$id_app = isset($_SESSION['id']) ? $_SESSION['id'] : 1;
$reponse_det_app = $bdd->query('SELECT appointments.id,dateHour,lastName,firstName FROM appointments INNER JOIN patients ON appointments.idPatients=patients.id WHERE appointments.id = '.$id_app.'');
$donnees_det_app = $reponse_det_app->fetchall();

// ** Ajout d'un rendez-vous **
if (isset($_POST['rdv']) && isset($_POST['idPatients']) && isset($_POST['dateHour']))
{
    $choosenIdPatient = $_POST['idPatients'];
    $choosenDate = $_POST['dateHour'];
    
    // Préparation de la requête :
    $req = $bdd->prepare('INSERT INTO appointments(idPatients, dateHour) VALUES(:idPatients,:dateHour)');
    
    // Exécution de la requête :
    $req->execute(array('idPatients' => $choosenIdPatient, 'dateHour' => $choosenDate));

    // Rdv Ok :
    header('Location: viewAddRdvOk.php');
}
else
{
    echo "";
}

// ** Mise à jour du rendez-vous :
if(isset($_POST['up_rdv']) && isset($_POST['up_rdv_id']) && isset($_POST['up_rdv_date']))
{
 $up_rdv = $_POST['up_rdv_date'];
 $up_rdv_id = $_POST['up_rdv_id'];
 
 // Préparation de la requête :
 $req = $bdd->prepare('UPDATE appointments SET dateHour = :up_rdv_date WHERE id = :up_rdv_id');       
 
 // Exécution de la requête :
 $req->execute(array(
    'up_rdv_date' => $up_rdv,
    'up_rdv_id' => $up_rdv_id
 ));
 echo 'Le rdv a bien été mis à jour !';
 }
?>


