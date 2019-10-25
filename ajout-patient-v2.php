<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>PDO</title>
</head>
<body>
<p><a href="index2.php">Accueil</a></p>
<?php
class DateOfBirth
{
    //
    public $day;
    public $month;
    public $year;
    //
    public function __construct()
    {
        $this->day = range(1,31);
        $this->month = array(
            'Janvier'=>1,
            'Février'=>2,
            'Mars'=>3,
            'Avril'=>4,
            'Mai'=>5,
            'Juin'=>6,
            'Juillet'=>7,
            'Août'=>8,
            'Septembre'=>9,
            'Octobre'=>10,
            'Novembre'=>11,
            'Décembre'=>12
        );
        $this->year = range (1900,2050);
    }
    //
    function get_day()
    {
        return $this->day;
    }
    function get_month()
    {
        return $this->month;
    }
      function get_year()
    {
        return $this->year;
    }
}
$date = new DateOfBirth();
$day_list=$date->get_day(); 
$month_list=$date->get_month();
$year_list=$date->get_year();

?>
<label>Jour</label>
    <select name="jour">      
        <?php foreach ($day_list as $key => $key_days): ?>
            <option value="<?=  $key ?>"><?= $key_days ?></option>
        <?php endforeach ?>
    </select>
    <label>Mois</label>
    <select name="mois">      
        <?php foreach ($month_list as $key => $key_month): ?>
            <option value="<?=  $key_month ?>"><?= $key ?></option>
        <?php endforeach ?>
    </select>
    <label>Année</label>
    <select name="année">      
        <?php foreach ($year_list as $key => $key_year): ?>
            <option value="<?=  $key ?>"><?= $key_year ?></option>
        <?php endforeach ?>
    </select><br>

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
<label>Date de naissance</label><br><input type="text" name="day" range/><input type="text" name="month"/><input type="text" name="year"/><br>

<label>Email</label><br><input type="text" name="mailAddress"placeholder="jean_dupont"/>@<input type="text" name="mailDomain"placeholder="google"/>.<input type="text" name="mailExtension" placeholder="com"/><br>

<label>Téléphone</label><br><input type="tel" name="phone" placeholder="XX XX XX XX XX" maxlength="25"/><br>
<input type="submit" name="newpatient" value="ajouter patient">
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
