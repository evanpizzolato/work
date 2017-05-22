<?php
$page_title = "Register";
require "includes/header.php";
    ob_start();    

?>
            <div id="register-form" class="jumbotron">
                <center>
		    <h1>Oops!</h1>
		    <p>Something happened! Or you might not have permission to see this page.</p>
		<?php echo (isset($_SESSION['user']) && isset($_SESSION['loggedin']))? '<a href="dashboard.php" class="btn btn-info">Go to Dashboard</a>':'<a href="home.php" class="btn btn-info">Go to Home</a>';?>
                </center>
<?php

if (isset($_SESSION['user']) && isset($_SESSION['loggedin'])) { 
    $page_content = ob_get_contents();
    ob_end_clean();
    include_once "includes/dash.php";
}
    require_once "includes/footer.php";                
?>
    </body>
</html>