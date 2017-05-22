<?php

//get total points based on user_id from table
$total = $ambassador->getTotal($_SESSION["user"]["id"]);

//grab by index so not array anymore
$totalIndx = $total[0];


if($totalIndx >= 300){
    $tier = 3;
}elseif ($totalIndx >= 200){
    $tier = 2;
}elseif ($totalIndx >= 100){
    $tier = 1;
}else {
    $tier = '';
}

//call getBadge method, pass $tier based on points to get appropriate badge to display
$path = $ambassador->getBadge($tier);



?>

