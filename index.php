<!DOCTYPE html>
<html>
<head>
<!-- // <link rel="stylesheet" type="text/css" href="pdo.css"> -->
<title>PDO</title>
</head>
<body>
<h1>PDO - Partie N°1 : Lire Les données<a href="index2.php"></h1>
<h3><a href="index2.php">Vers PDO - Partie N°2 - Ecrire les données </a></h3>
<?php
try
{
    // On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
//
// On récupère tout le contenu de la table
$reponse_clients = $bdd->query('SELECT * FROM clients');
$reponse_clients_list = $bdd->query('SELECT * FROM clients');
$reponse_clients_top_20 = $bdd->query('SELECT * FROM clients LIMIT 0,20');
$reponse_clients_with_card = $bdd->query('SELECT * FROM clients WHERE card != 0');
$reponse_clients_M = $bdd->query('SELECT * FROM clients WHERE lastName LIKE \'M%\' ORDER BY lastname ASC');
$reponse_shows = $bdd->query('SELECT * FROM showTypes');
$reponse_shows_list = $bdd->query('SELECT * FROM shows ORDER BY title ASC');
// On affiche chaque entrée une à une
//
// Ex 1
echo "<h4>"."Ex.1 : Liste des clients <br/>"."</h4>";
echo "Prénom - Nom";
while ($donnees_clients = $reponse_clients->fetch())
{
echo "<p>".$donnees_clients['firstName']." ".$donnees_clients['lastName']."</p>";
}
$reponse_clients->closeCursor(); // Termine le traitement de la requête
// Ex 2
echo "<h4>"."Ex.2 : Type des spectacles disponibles <br/>"."</h4>";
while ($donnees_shows = $reponse_shows->fetch())
{
echo "<p>".$donnees_shows['type']."</p>";
}
$reponse_shows->closeCursor(); // Termine le traitement de la requête
// EX 3
echo "<h4>"."Ex.3 : 20 premiers clients <br/>"."</h4>";
while ($donnees_clients_top_20 = $reponse_clients_top_20->fetch())
{
echo "<p>".$donnees_clients_top_20['firstName']." ".$donnees_clients_top_20['lastName']."</p>";
}
$reponse_clients_top_20->closeCursor(); // Termine le traitement de la requête
// EX 4
echo "<h4>"."Ex.4 : Clients avec une carte de fidélité <br/>"."</h4>";
while ($donnees_clients_with_card = $reponse_clients_with_card->fetch())
{
echo "<p>".$donnees_clients_with_card['firstName']." ".$donnees_clients_with_card['lastName']." - N° Carte : ".$donnees_clients_with_card['cardNumber']."</p>";
}
$reponse_clients_with_card->closeCursor(); // Termine le traitement de la requête
// EX 5
echo "<h4>"."Ex.5 : Clients avec un nom commençant par M <br/>"."</h4>";
while ($donnees_clients_M = $reponse_clients_M->fetch())
{
echo "<p>"."<strong><i>Nom : </strong></i>".$donnees_clients_M ['lastName']."</p>";
echo "<p>"."<strong><i>Prénom : </strong></i>".$donnees_clients_M['firstName']."</p>";
}
$reponse_clients_M->closeCursor(); // Termine le traitement de la requête
// EX 6
echo "<h4>"."Ex.6 : Liste des spectacles <br/>"."</h4>";
while ($donnees_shows_list = $reponse_shows_list->fetch())
{
echo "<p>"."<strong>Titre : </strong>".$donnees_shows_list['title']."<strong> - Artiste : </strong>".$donnees_shows_list['performer']."<strong> - Date : </strong>".$donnees_shows_list['date']."<strong> - Heure : </strong>".$donnees_shows_list['startTime']."</p>";

}
$reponse_shows_list->closeCursor(); // Termine le traitement de la requête
// EX 7
echo "<h4>"."Ex.7 : Liste des clients <br/>"."</h4>";
while ($donnees_clients_list = $reponse_clients_list->fetch())
{
    echo "<p>"."<strong>Nom : </strong>"."<i>".$donnees_clients_list['lastName']."</i>"."</p>";
    echo "<p>"."<strong>Prénom : </strong>"."<i>".$donnees_clients_list['firstName']."</i>"."</p>";
    echo "<p>"."<strong>Date de naissance : </strong>"."<i>".$donnees_clients_list['birthDate']."</i>"."</p>";
    $message = ($donnees_clients_list['card']==1) ? "oui" : "non" ;
    echo "<p>"."<strong>Carte de fidélité : </strong>"."<i>".$message."</i>"."</p>";
    $hasCard = ($donnees_clients_list['cardNumber']!=null) ? $donnees_clients_list['cardNumber'] : "N° de carte non attribué" ;
    echo "<p>"."<strong>N° de carte : </strong>"."<i>".$hasCard."</i>"."</p>";
    echo "***";

}
$reponse_clients_list->closeCursor(); // Termine le traitement de la requête
?>
</body>
</html>

