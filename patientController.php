<?php
// ** Connexion à la base de données ** :
require('connexion.php');

// ** Liste des patients **

// 1. Contenu de la table :
$reponse_patients = $bdd->query('SELECT * FROM patients');
// 2. Nombre de patients :
$number_pat = $bdd->query('SELECT COUNT(*) AS total FROM patients');
$nb_pat = $number_pat->fetch();

// ** Profil patient **
$detail = $_SESSION['id'];
$reponse_profil = $bdd->query('SELECT * FROM patients WHERE id =' . $detail . '');
$reponse_app = $bdd->query('SELECT appointments.id,dateHour,lastName FROM appointments INNER JOIN patients ON appointments.idPatients=patients.id WHERE patients.id =' . $detail . '');
$donnees_app = $reponse_app->fetchall();

// ** Ajout d'un patient **
if (isset($_POST["newpatient"]) && isset($_POST["lastname"]) && isset($_POST["firstname"]) && isset($_POST["birthdate"]) && isset($_POST["mail"]) && isset($_POST["phone"]))
{
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $birthdate = $_POST["birthdate"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    // Préparation de la requête :
    $req = $bdd->prepare('INSERT INTO patients(lastname, firstname, birthdate, mail, phone) VALUES(:lastname,:firstname,:birthdate,:mail,:phone)');
    // Exécution de la requête :
    $req->execute(array('lastname' => $lastname, 'firstname' => $firstname, 'birthdate' => $birthdate, 'mail' => $mail, 'phone' => $phone));
    //
    echo "<br>";
    header('Location: viewAddPatientOK.php');
}
else
{
    echo "";
}

// ** Supprimer un patient ** :
if (isset($_POST['delpat']) && isset($_POST['patient_id']))
{
  $del_app = $bdd->prepare('DELETE FROM appointments WHERE idPatients=' . $_POST['patient_id'] . '');
  $del_pat = $bdd->prepare('DELETE FROM patients WHERE id=' . $_POST['patient_id'] . '');

  $del_app->bindValue(':idPatients', $_POST['patient_id']);
  $del_pat->bindValue(':id', $_POST['patient_id']);

  $del_app->execute();
  $del_pat->execute();

  // Redirection vers la page de confirmaton :
  header('Location: viewDelPatientOK.php');;
}
?>