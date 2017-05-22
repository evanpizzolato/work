        <div id="dash-content" class="row">
            <aside id="dash-aside" class="col-xs-12 col-sm-4 col-md-3">
                <center class="container-fluid">
                    <a href="dashboard.php"><img class="img-circle" alt="<?php if(isset($_SESSION["user"]["username"])){echo $_SESSION["user"]["username"];}?>" src="<?php echo $fileName;?>" width="140" height="140"></a>
                    <h2><?php if(isset($_SESSION["user"]["username"])){echo (!empty($_SESSION["user"]["lastname"]))? $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"] : $_SESSION["user"]["firstname"];}?></h2>
                </center>
                <section id="feat-nav" class="list-group">
                    <a href="dashboard.php" class="list-group-item">
                        <span>Home</span><img alt="Home" src="media/feature-icons/dash-icons/Home.svg" height="40">
                    </a>
                    <a href="curator.php" class="list-group-item">
                        <span>Curator</span><img alt="Curator" src="media/feature-icons/dash-icons/Curator.svg" height="40">
                    </a>
                    <a href="my_vacations.php" class="list-group-item">
                        <span>Itinerary</span><img alt="Itinerary" src="media/feature-icons/dash-icons/Itinerary.svg" height="40">
                    </a>
                    <a href="budget.php" class="list-group-item">
                        <span>Wallet</span><img alt="Wallet" src="media/feature-icons/dash-icons/Wallet.svg" height="40">
                    </a>
                    <a href="bookings.php" class="list-group-item">
                        <span>Bookings</span><img alt="Home" src="media/feature-icons/dash-icons/Booking.svg" height="40">
                    </a>
                    <a href="citypages.php" class="list-group-item">
                        <span>City Pages</span><img alt="Home" src="media/feature-icons/dash-icons/Cities.svg" height="40">
                    </a>
                </section>
            </aside>
            <section class="col-sm-4 col-md-3"></section>
            <section id="dash-main" class="col-sm-8 col-md-9">
                <div class="container-fluid formcol">
            <?php if (!isset($_SESSION['user']) && !isset($_SESSION['loggedin'])&&(!stripos($_SERVER['REQUEST_URI'], 'contactus.php')) && (!stripos($_SERVER['REQUEST_URI'], 'legal.php'))) { redirect("permission.php");}?>
                    <!--<div class="jumbotron">-->
            <?php echo (!empty($page_content)) ? $page_content : "<h2>Whoops! Nothing was found.</h2>"; ?>
                    <!--</div>-->
                </div>
            <?php require_once "includes/footer.php";?>
            </section>
        </div>
