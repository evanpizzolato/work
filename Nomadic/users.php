<?php
$page_title = "User Management";
require_once "includes/header.php";

$usernames = $users->allUsernames();
$userRoles = $users->getUserRoles();

ob_start();
?>


<h1><a href="users.php">User Management</a></h1> 
<div class="jumbotron">

<?php
if ($_SESSION["user"]["class"] == 1) {
    ?>
    <h3>All Users</h3><br>
    <table class="table table-hover">
        <tr class="table-disabled"><th>Name</th><th>E-Mail</th><th>Role</th><th></th><th></th></tr>
    <?php
    foreach ($usernames as $u) {
        echo "<tr><td><a href='users.php?edit=".$u->username."'>".$u->username."</a></td>";
        echo "<td>".$u->email."</td><td>";
        
        foreach($userRoles as $r) {
            if ($u->user_roles_id == $r->id) {
                echo ucfirst($r->name);
                break;
            } else {
                continue;
            }
        }
        echo "</td><td><a href='users.php?edit=".$u->username."' data-toggle='tooltip' data-placement='top' title='Edit/Details'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td><td><a href='users.php?delete=".$u->username."' data-toggle='tooltip' data-placement='top' title='Delete'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td></tr>";
        echo "</tr>";
    }
    ?>
    </table><br>
    <?php if(isset($_GET["edit"])) {
        echo "<h3>Edit User</h3><br>";
        $user_info = $users->getUser($_GET["edit"]);
        include_once "includes/usrmgForm.php";
    ?>
        <input type="hidden" name="id" value="<?php echo $_GET["edit"];?>">
        <br><div class="text-right formcol"><input type="submit" name="update_user" class="btn btn-success" value="Update"></div>
        </form>
    <?php } else if(isset($_GET["delete"])){
        echo "<h3>Delete Event</h3><br>";
        $user_info = $users->getUser($_GET["delete"]);
    ?>  <p>Are you sure you want to delete <?php echo $user_info["username"];?>?</p>
        <small class="text-danger">* This action cannot be undone.</small>
        <br><form action="users.php" method="post" class="text-right formcol"><input type="submit" name="delete_user" class="btn btn-danger" value="Delete"><input type="hidden" name="id" value="<?php echo $_GET["delete"];?>"></form>
        
    <?php } else {
        echo "<h3>Create New User</h3><br>";
        unset($user_info);
        include_once "includes/usrmgForm.php";
    ?>
        <br><div class="text-right formcol"><input type="submit" name="add_user" class="btn btn-success" value="Create User"></div></form>
    <?php } ?>
</div>
<?php
} else {
    redirect("permission.php");
}
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>