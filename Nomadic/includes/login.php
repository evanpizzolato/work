<?php 
require_once "../Classes/DbConnect.php";
$dbc = new DbConnect();
$db = $dbc->getDb(); 

require_once "../Classes/Users.php";
$users = new Users($db);


if (isset($_POST['user_login'])) {
    
    $login = $users->userLogin($_POST["user"],$_POST["password"]); 
    
    if ($login["login"]) {
        session_start();
        $_SESSION["user"] = $login["user"];
        $_SESSION["user"]["class"] = $login["user"]["user_roles_id"];
        $_SESSION["loggedin"] = 1;
    } else {
        session_start();
        session_destroy();
    }
    header('Location: ../dashboard.php');
    exit;
}
?>