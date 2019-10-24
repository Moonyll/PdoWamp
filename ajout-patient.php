<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>PDO</title>
</head>
<body>
<p><a href="index2.php">Accueil</a></p>
<?php
try
{
    // On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
?>
<!-- Formulaire -->
<form method="post" action="ajout-patient.php">
<fieldset>
        <legend>Nouveau Patient - Information Personnelles   </legend>
<label>Nom</label><br><input type="text" name="lastname" placeholder="nom" maxlength="25" /><br>
<label>Prénom</label><br><input type="text" name="firstname" placeholder="prénom" maxlength="25"/><br>
<label>Date de naissance</label><br><input type="date" name="birthdate" class="forms"/><br>
<label>Email</label><br><input type="email" name="mail"placeholder="adresse mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/><br>
<label>Téléphone</label><br><input type="tel" name="phone" placeholder="XX XX XX XX XX" maxlength="25"/><br>
<input type="submit" name="newpatient">
</fieldset>
</form>
<!-- Fin du formulaire -->
<?php
// Validation des données du formulaire
if (isset($_POST["newpatient"])&& isset($_POST["lastname"])&& isset($_POST["firstname"]) && isset($_POST["birthdate"]) && isset($_POST["mail"]) && isset($_POST["phone"]))
{
    //
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $birthdate = $_POST["birthdate"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    //
    // Test si patient déjà existant
    // $check_patient = $bdd->query('SELECT * FROM patients WHERE lastname = \'$lastname\' AND firstname = \'$firstname\' AND mail = \'$mail\' AND phone = \'$phone\'');
    // $row = $check->rowCount();
    // var_dump($row);
    
    // if ($row == 0)
    // {
    // Préparation de la requête
    //
    $req = $bdd->prepare('INSERT INTO patients(lastname, firstname, birthdate, mail, phone) VALUES(:lastname,:firstname,:birthdate,:mail,:phone)');
    //
    // Exécution de la requête
    //
    $req->execute(array('lastname' => $lastname,'firstname' => $firstname, 'birthdate' => $birthdate,'mail' => $mail, 'phone' => $phone));
    //
    echo "<br>";
    header('Location: ok_patient.php'); 
    //
    // Fermeture de la session
    //
    mysqli_close($bdd);
}
else
{
    echo "";
}
?>
</body>
</html>
