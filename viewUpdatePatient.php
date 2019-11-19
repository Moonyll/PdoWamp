 <?php // Validation des données du formulaire
        if (isset($_POST["uppatient"]) && isset($_POST["uplastname"]) && isset($_POST["upfirstname"]) && isset($_POST["upbirthdate"]) && isset($_POST["upmail"]) && isset($_POST["upphone"]) && isset($_POST['upid']))
        {
            $lastname = $_POST['uplastname'];
            $firstname = $_POST['upfirstname'];
            $birthdate = $_POST['upbirthdate'];
            $mail = $_POST['upmail'];
            $phone = $_POST['upphone'];
            $id = $_POST['upid'];

            // Préparation de la requête
            $req = $bdd->prepare('UPDATE patients SET lastname = :uplastname, firstname = :upfirstname, birthdate = :upbirthdate, mail = :upmail, phone = :upphone WHERE id = :upid');

            // Exécution de la requête
            $req->execute(array(
                'uplastname' => $lastname,
                'upfirstname' => $firstname,
                'upbirthdate' => $birthdate,
                'upmail' => $mail,
                'upphone' => $phone,
                'upid' => $id
            ));
             echo 'Le patient a bien été mis à jour !';
        }
        else
        {
            echo "";
        }
        $reponse_profil->closeCursor(); // Termine le traitement de la requête
?>