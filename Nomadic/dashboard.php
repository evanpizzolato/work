<?php
$page_title = "Dashboard";
require_once "includes/header.php";

if (!isset($_SESSION["user"])) {
    //sorry you need to log in.
    echo "<h1>Sorry you need to login!</h1>";
    echo "<a href='home.php' class='btn btn-info'>Go to Home</a>";
    session_destroy();
} else if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] == "2") {
    ob_start(); //include the nomadic dashboard.?>
    <h1>Hello Nomad.</h1>
    <?php
    include_once "includes/nomad.php";
    $page_content = ob_get_contents();
    ob_end_clean();
    include_once "includes/dash.php";
} else if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] == "1") {
    ob_start(); //include the admin dashboard.?>
    <h1>Hello Admin.</h1>
    <?php
    include_once "includes/admin.php";
    $page_content = ob_get_contents();
    ob_end_clean();
    include_once "includes/dash.php";
} else if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] == "3") {
    ob_start(); //include the ad user dashboard. ?>
    <h1>Hello Ad User.</h1>
    <?php
    include_once "includes/advert.php";
    $page_content = ob_get_contents();
    ob_end_clean();
    include_once "includes/dash.php";
} else {
    //Whoops somehting went wrong! button to go back to the home page.
    echo "<h1>Whoops somehting went wrong!</h1>";
    echo "<a href='home.php' class='btn btn-info'>Go to Home</a>";
    session_destroy();
}

require_once "includes/footer.php";
?>
    </body>
</html>