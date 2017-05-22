<?php
session_start();
$site_title = "Nomadic";

ini_set( "display_errors", "off" );
//error_reporting( E_ALL );
set_error_handler("redirect", E_ALL);

function redirect() {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . "permission.php" . '"';
    $string .= '</script>';

    echo $string;
}
//  include all classes here
require_once "Classes/DbConnect.php";
$dbc = new DbConnect();
$db = $dbc->getDb();


require_once "Classes/Users.php";
$users = new Users($db);
require_once "Classes/Locations.php";
$locations = new Locations($db);
require_once "Classes/Events.php";
$events = new Events($db);

require_once "Classes/Ambassador.php";
$ambassador = new Ambassador($db);

require_once "Classes/Experience.php";
//require_once "Classes/Accommodations.php";
require_once "Classes/Activities.php";

require_once "Classes/Forum.php";
$forum = new Forum($db);
require_once "Classes/Account.php";
$account = new Account($db);
require_once "Classes/Transaction.php";
$transaction = new Transaction($db);
require_once "Classes/Category.php";
$category = new Category($db);

require_once "Classes/Search.php";
$search = new Search($db);


require_once "Classes/FeedbackForms.php";
require_once "Classes/Destinations.php";
require_once "Classes/Tips.php";
require_once "Classes/Vacations.php";
require_once "Classes/ItineraryItems.php";
require_once "Classes/OfflineMode.php";
require_once "Classes/pdflayer.class.php";
require_once "Classes/Votes.php";
$votesObject = new Votes($db);

require_once "Classes/Validation.php";
require_once "Classes/stripe/init.php";
\Stripe\Stripe::setApiKey("sk_test_ezIIPIN1WajiE8NMKd1g8c3Y");


?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title ." | ". $site_title;?></title>
    <link href="media/favicon.svg" rel="icon">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/script.php" type="text/javascript"></script>
    <script src="js/map.php" type="text/javascript"></script>
    <script src="js/topics-voting-system.js" type="text/javascript"></script>
</head>

<body>
    <header>
        <nav id="top-nav" class="navbar navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="home.php"><img alt="Nomadic" src="media/logo.svg" width="150px" height="21px"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php // check to see if user is logged in 
            if (isset($_SESSION["user"]) && ($_SESSION["loggedin"] == 1)) { 
                if(file_exists("media/user-profile/".$_SESSION["user"]["id"]."-avatar.jpg"))
                    $fileName = "media/user-profile/".$_SESSION["user"]["id"]."-avatar.jpg";
                else
                    $fileName = "media/user-profile/default-avatar.jpg";
            ?>
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php" title="">Dashboard</a></li>
                <li><a href="forum.php" title="">Forum</a></li>
                <li><?php include_once "includes/search.php"; ?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <a class="user-profile navbar-brand" href="settings.php"><img id="u-avatar-header" class="img-circle" alt="<?php echo $_SESSION["user"]["username"];?>" src="<?php echo $fileName;?>" width="40" height="40"></a>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?php echo $_SESSION["user"]["username"]?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="settings.php">Settings</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="includes/logout.php">Logout</a></li>
                    </ul>
                </li>
            <?php } else {?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="register.php">Register</a></li>
                <li><a href="#" data-toggle="modal" data-target="#loginModal">Sign In</a></li>
            <?php } ?>
            </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <?php include_once "includes/alert.php";?>
    </header>
    <main id="main" class="container-fluid">