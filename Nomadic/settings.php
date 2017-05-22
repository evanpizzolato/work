<?php
// Put the title for your the page here
$page_title = "Settings";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

$user = $users->getUser($_SESSION["user"]["username"]);
//  Put the code for your feature between the php tags 
?>
<h2>Settings</h2>
<?php ?>
<form action="settings.php" method="post" class="form-horizontal jumbotron" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-4 control-label">Username</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $_SESSION["user"]["username"];?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-4 control-label">First Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Change your first name" value="<?php echo $user["firstname"]?>">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-4 control-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user["lastname"]?>" placeholder="Change your last name">
        </div>
    </div>
    <div class="form-group">
        <label for="img" class="col-sm-4 control-label">Upload Picture</label>
        <div class="col-sm-6">
            <center style="width:200px;height:200px;overflow:hidden;margin:0 auto" class="img-circle"><img id="uploadedPreview" alt="<?php echo $_SESSION["user"]["username"];?>" src="<?php echo $fileName;?>" width="100%"></center><br><br>
            <input type="file" id="img" name="img" accept="image/*">
            <small class="help-block">File must be under 9MB.</small>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-4 control-label">New Password</label>
        <div class="col-sm-6">
            <?php include "includes/togglePassword.php";?>
        </div>
    </div>
    <div class="form-group">
        <label for="verify-password" class="col-sm-4 control-label">Verify Password</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="verify-password" name="verify-password" placeholder="Verify password">
        </div>
    </div>
    <br><div class="text-right formcol"><input class="btn btn-info" type="submit" name="update_profile" value="Update" /></div>
</form>
<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>