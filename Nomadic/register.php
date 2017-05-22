<?php
$page_title = "Register";
require "includes/header.php";
?>
            <div id="register-form" class="jumbotron">
                <h1>Register</h1>
                <form name="register" method="post" action="home.php" class="form-horizontal">  
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="username" name="username" placeholder="* Cannot be changed">
                        </div>
                        <p><?php
                        if(isset($_POST['username'])) {
                            $username = new Validation();
                            $username->setInput($_POST['username']);
                            $username->validateEmpty();
                            
                            $usrFlag = $username->getFlag();
                            if($usrFlag == true){ echo "<br>" . $username->message; }
                        }
                        ?></p>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-sm-3 control-label">Account Type</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="role" value="nomad">Nomad
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="role" value="advertise">Advertise
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-8 formcol">
                            <div class="col-md-6">
                                <input class="form-control" type="text" id="firstname" name="firstname" placeholder="First name">
                            </div>
                            <label></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last name">
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">E-Mail Address</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" id="email" name="email" placeholder="Enter your e-mail address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-8">
                            <?php include "includes/togglePassword.php";?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verify-password" class="col-sm-3 control-label">Verify Password</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="password" id="verify-password" name="verify-password" placeholder="Verify your password">
                        </div>
                    </div>
                    <br><div class="text-right formcol"><input class="btn btn-success" type="submit" name="register_user" value="Sign Up" /></div>
                </form>
            </div>
<?php
require_once "includes/footer.php";
?>
    </body>
</html>