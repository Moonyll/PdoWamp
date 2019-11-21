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
    require_once('connexion.php');

/* $day = range(1, 31);
$month=[
1=>"Janvier",
2=>"Février",
3=>"Mars",
4=>"Avril",
5=>"Mai",
6=>"Juin",
7=>"Juillet",
8=>"Août",
9=>"Septembre",
10=>"Octobre",
11=>"Novembre",
12=>"Décembre"
]; */

class Security
{
    public $lastname;
    public $firstname;
    public $birthdate;
    public $mail;
    public $phone;
    //
    const globalMessage = 'Veuillez renseignez ce champ';
    //
    function __construct($lastname, $firstname,$birthdate,$mail,$phone) {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthdate = $birthdate;
        $this->mail = $mail;
        $this->phone = $phone;
    }   
    function get_lastname() {return $this->lastname;}
    function get_firstname() {return $this->firstname;}
    function get_birthdate() {return $this->birthdate;}
    function get_mail() {return $this->mail;}
    function get_phone() {return $this->phone;}

    function getInputArray()
    {
        $dico = [
            $this->lastname => ['/1/', 'messageLastName'],
            $this->firstname => ['/1/', 'messageFirstName'],
            $this->birthdate => ['/1/', 'messageBirthdate'],
            $this->mail => ['/1/', 'messageMail'],
            $this->phone => ['/1/', 'messagePhone'],    
        ];   
        return $dico;
    }

}
    /* function testInput($dico,$input)
    {     
        // Retourne un message d'erreur ou vide :
        return (empty($input)) ? Security::globalMessage : ((preg_match($dico[$input][0],$input) ==0) ? $dico[$input][1] : '');
    } */
    // Input objet :
   /*  $newInputToSecure = new Security('1','testFirstname','testBirthdate','4','testPhone');
    $arrayOfInput = $newInputToSecure-> getInputArray();
      
        $arrayOfMessages=array();
        foreach ($arrayOfInput as $input=>$value)
        {
            $arrayOfMessages[] = testInput($arrayOfInput,$input);
        }
        $nbOfEmptyEntries = count(array_filter($arrayOfMessages));
     

    var_dump($arrayOfMessages,$nbOfEmptyEntries); */
  
   
    // ** Ajout d'un patient **
if (isset($_POST["newpatients"]) && isset($_POST["lastname"]) && isset($_POST["firstname"]) && isset($_POST["birthdate"]) && isset($_POST["mail"]) && isset($_POST["phone"]))
{
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $birthdate = $_POST["birthdate"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];  
 
    // ** Sécurité ** :
    
    // Input objet :
    $newInputToSecure = new Security($lastname,$firstname,$birthdate ,$mail,$phone);
    $arrayOfInput = $newInputToSecure-> getInputArray();
    
    // Test des input :
    function testInput($dico,$input)
    {     
        // Retourne un message d'erreur ou vide :
        return (empty($input)) ? Security::globalMessage : ((preg_match($dico[$input][0],$input) ==0) ? $dico[$input][1] : '');
    }
    
    // Tableau des messages :
    $arrayOfMessages=array();
    foreach ($arrayOfInput as $input=>$value)
    {
        $arrayOfMessages[] = testInput($arrayOfInput,$input);
    }
    
    // Nombres d'erreurs :
    $nbOfEmptyEntries = count(array_filter($arrayOfMessages));
    
    var_dump($arrayOfInput, $arrayOfMessages,$nbOfEmptyEntries);

    if($nbOfEmptyEntries == 0)
    {
    // Préparation de la requête :
    $req = $bdd->prepare('INSERT INTO patients(lastname, firstname, birthdate, mail, phone) VALUES(:lastname,:firstname,:birthdate,:mail,:phone)');
    // Exécution de la requête :
    $req->execute(array('lastname' => $lastname, 'firstname' => $firstname, 'birthdate' => $birthdate, 'mail' => $mail, 'phone' => $phone));
    //
   /*  echo "<br>";
    header('Location: viewAddPatientSec.php'); */
    }
}
?>   
<!-- Formulaire -->
    <form method="post" action="viewAddPatientSec.php">
        <fieldset>
            <legend>Nouveau Patient - Information Personnelles </legend>
            <label>Nom</label><br><input type="text" name="lastname" placeholder="nom" maxlength="25" /><br>
           <div><?= $arrayOfMessages[0] ?></div>
            <label>Prénom</label><br><input type="text" name="firstname" placeholder="prénom" maxlength="25" /><br>
            <div><?= $arrayOfMessages[1] ?></div>
            <label>Date de naissance</label><br><input type="date" name="birthdate" class="forms" /><br>
            <div><?= $arrayOfMessages[2] ?></div>
            <label>Email</label><br><input type="email" name="mail" placeholder="adresse mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" /><br>
            <div><?= $arrayOfMessages[3] ?></div>
            <label>Téléphone</label><br><input type="tel" name="phone" placeholder="XX XX XX XX XX" maxlength="25" /><br>
            <div><?= $arrayOfMessages[4] ?></div>
            <input type="submit" name="newpatients">
        </fieldset>
    </form>
</body>
</html>