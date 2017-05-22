<form method="post" action="users.php" class="form-horizontal">
    <div class="form-group">
        <label for="username" class="col-sm-3 control-label">Username</label>
        <div class="col-sm-8">
            <?php if (!isset($user_info)) { ?>
            <input class="form-control" type="text" id="username" name="username" placeholder="* Cannot be changed">
            <?php } else echo "<p>".$user_info["username"]."</p>";?>
        </div>
    </div>
    <div class="form-group">
        <label for="role" class="col-sm-3 control-label">Account Type</label>
        <div class="col-sm-8">
            <select class="form-control" id="role" name="role">
            <?php foreach($userRoles as $r) { ?>
                <option <?php echo (isset($user_info) && ($user_info["user_roles_id"] == $r->id))? "selected='selected'": ""; echo 'value="'.$r->id.'">'.ucfirst($r->name);?></option>
            <?php } ?>
           </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-8 formcol">
            <div class="col-md-6">
                <input class="form-control" type="text" id="firstname" name="firstname" placeholder="First name" <?php echo (isset($user_info))? "value='".$user_info['firstname']."'" : "" ;?>>
            </div>
            <label></label>
            <div class="col-md-6">
                <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last name" <?php echo (isset($user_info))? "value='".$user_info['lastname']."'" : "" ;?>>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">E-Mail Address</label>
        <div class="col-sm-8">
            <input class="form-control" type="email" id="email" name="email" placeholder="Enter your e-mail address" <?php echo (isset($user_info))? "value='".$user_info['email']."'" : "" ;?>>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-8 formcol">
            <div class="col-sm-8"><div class="input-group">
                <div class="input-group-addon" data-toggle='tooltip' data-placement='top' title='Show/Hide'><button type="button" id="showPassInput" style="background:none;border:none; padding:0"><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></button></div>
                <input class="form-control" type="password" id="password" name="password" placeholder="Enter a password"></div>
            </div>
            <label></label>
            <div class="col-sm-1">
                <button type="button" onClick="generatePswd()" class="btn btn-info">Generate</button>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-8 formcol">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="sendEmail" checked>Notify the user <small>(<em>This will notify the user of <?php echo (isset($user_info))? "any changes made to their account.": "their new account and login details.";?></em>)</small>
                </label>
            </div>
        </div>
    </div>
