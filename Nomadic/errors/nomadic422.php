<?php
session_start();
$site_title = "Nomadic";

//  include all classes here
require_once "../Classes/DbConnect.php";
$dbc = new DbConnect();
$db = $dbc->getDb(); 

require_once "../Classes/Users.php";
$users = new Users($db);
require_once "../Classes/Locations.php";
$locations = new Locations($db);
require_once "../Classes/Events.php";
$events = new Events($db);

require_once "../Classes/Experience.php";
//require_once "Classes/Accommodations.php";
require_once "../Classes/Activities.php";
require_once "../Classes/Forum.php";
require_once "../Classes/Account.php";
$account = new Account($db);
require_once "../Classes/Transaction.php";
$transaction = new Transaction($db);
require_once "../Classes/Category.php";
$category = new Category($db);

require_once "../Classes/Search.php";
$search = new Search($db);

require_once "../Classes/FeedbackForms.php";
require_once "../Classes/Destinations.php";
require_once "../Classes/Tips.php";
require_once "../Classes/Vacations.php";
require_once "../Classes/ItineraryItems.php";
require_once "../Classes/OfflineMode.php";
require_once "../Classes/pdflayer.class.php";
require_once "../Classes/Votes.php";
$votesObject = new Votes($db);


require_once "../Classes/Validation.php";
require_once "../Classes/stripe/init.php";
\Stripe\Stripe::setApiKey("sk_test_ezIIPIN1WajiE8NMKd1g8c3Y");

$page_title = "422 - Unprocessable Entity";

?>

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
        <script src="js/script.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/map.php"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    </head>
    
    <body>
        <header>
            <nav id="top-nav" class="navbar navbar-inverse container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="home.php"><img alt="Nomadic" src="media/logo.svg" width="150px" height="21px"></a>
                </div>
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
                    <li><?php include_once "../includes/search.php"; ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <a class="user-profile navbar-brand" href="settings.php"><img class="img-circle" alt="<?php echo $_SESSION["user"]["username"];?>" src="<?php echo $fileName;?>" width="40" height="40"></a>
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
                </ul>    
            </nav>
        </header>

        
<!--!!!CODE FOR ERROR MESSAGES STARTS HERE!!!-->        
            <div class='jumbotron'>
                <div class='row'>
                    <div class='col-sm-12 text-center'>
                        <h1 class='errTitle'>Oops! Error 422 - Unprocessable Entity</h1>
                        <p class='errText'>Looks like you've gone a little off course! Your request has semantic errors.</p>
                        
                        <a href='./home.php' class='btn btn-success'>Back to Home</a>
                    </div>    
                </div>
            </div>
<!--!!!CODE FOR ERROR MESSAGES ENDS HERE!!!-->        
        
                <?php if (stripos($_SERVER['REQUEST_URI'], 'home.php') || (!isset($_SESSION["loggedin"]) && stripos($_SERVER['REQUEST_URI'], 'permission.php'))) { echo "</main>"; }?>
        <footer>
            <nav class="navbar container-fluid">
                <ul class="nav navbar-nav">
                    <p class="navbar-text">&copy; <?php echo date("Y")." ".$site_title.". All rights reserved.";?></p>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <form method='post'>
                        <input class="btn btn-danger" type='submit' name='download' value='Download for Offline Use (PDF)'>
                    </form>

                    <?php
                    if(isset($_POST['download'])) {
                        $downloadObject = new offlineMode();
                        $downloadObject->saveToPDF();
                    }
                    ?>

                    <li><a href="./contactus.php" title="">Contact</a></li>
                    <li><a href="#" title="">Privacy</a></li>
                    <li><a href="#" title="">Terms</a></li>
                    <li><a href="#" title="">Legal</a></li>
                </ul>
            </nav>
        </footer>
        <div id="loginModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sign In</h4>
                    </div>
                    <div class="modal-body">
                        <form id="login" method="post" action="includes/login.php" class="form-horizontal">
                            <div class="form-group">
                                <label for="user" class="col-sm-4 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="user" name="user" value="<?php echo (isset($_POST['user'])) ? $_POST['user'] : "";?>" placeholder="Enter your username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="password" id="pass" name="pass" placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="text-right formcol">
                            <input class="btn btn-primary" type="submit" name="user_login" value="Login" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <?php if (!stripos($_SERVER['REQUEST_URI'], 'home.php') && !stripos($_SERVER['REQUEST_URI'], 'permission.php')) { echo "</main>"; } ?>        


    </body>    
</html>
