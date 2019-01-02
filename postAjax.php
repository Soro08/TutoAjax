
<?php
//Include the database configuration file
require 'config/database.php';
$db = Database::connect();

if (!empty($_POST['iduser'])){
    $iduser = $_POST['iduser'];
    $status = $_POST['statut'];
    //            CHANGEMENT DE STATUT
    $statementVerify = $db -> query("SELECT statut FROM user WHERE id = '$iduser'");
    if($statut = $statementVerify->fetch()) {

        $statutvrif = $statut['statut'];
        if ($statutvrif == 2) {
            $statutvrif = 0;
            $statementnuser = $db->prepare("UPDATE user SET statut = ? WHERE id = ?;");
            $statementnuser->execute(array($statutvrif, $iduser));


            //        header("Location: register.php");

        } else {
            $statutvrif = 2;
            $statementnuser = $db->prepare("UPDATE user SET statut = ? WHERE id = ?;");
            $statementnuser->execute(array($statutvrif, $iduser));



            //        header("Location: register.php");
        }
    }
    echo($iduser);
}
?>