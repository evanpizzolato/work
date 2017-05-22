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
                    <li><a href="./legal.php#privacy" title="">Privacy</a></li>
                    <li><a href="./legal.php#terms" title="">Terms</a></li>
                    <li><a href="./legal.php" title="">Legal</a></li>
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
                                    <?php include "includes/togglePassword.php";?>
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