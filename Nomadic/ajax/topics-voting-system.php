<?php
//require_once "../includes/header.php";
require_once "../Classes/DbConnect.php";
require_once "../Classes/Votes.php";
$dbc = new DbConnect();
$db = $dbc->getDb();




$votesObject = new Votes($db);


if($_POST) {
    if($_POST['value'] == "+1") {

        $votesObject->updateVotesUp($_POST['id']); // Update number with +1 or -1

        $value = $votesObject->getTotal($_POST['id']); // Get the new number value


        $expire = 24 * 3600; // 1 day
        setcookie('Voting' . $_POST['id'], 'voted', time() + $expire, '/'); // Place a cookie

        echo $value[0]['total']; // Send back the new number value
    }

    else {
        $votesObject->updateVotesDown($_POST['id']); // Update number with +1 or -1

        $value = $votesObject->getTotal($_POST['id']); // Get the new number value

        $expire = 24 * 3600; // 1 day
        setcookie('Voting' . $_POST['id'], 'voted', time() + $expire, '/'); // Place a cookie

        echo $value[0]['total']; // Send back the new number value
    }
}
?>