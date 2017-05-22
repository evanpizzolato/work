<?php
// Put the title for your the page here
$page_title = "~Template~";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();
?>

<?php
if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] !== "1") {
    redirect("permission.php");
}
?>

<?php

$destinationObj = new Destination();
$destinations = $destinationObj->getDestinations($db);

//  Put the code for your feature between the php tags 
?>
<div class="jumbotron">
<h2 class='text-center'>Destination Admin Page</h2>
<div class='adminTable'>  
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>State</th>
        <th>Country</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Population</th>
        <th>Languages</th>
        <th>Climate</th>
        <th>Advisory</th>
    </tr>

<?php foreach ($destinations as $destination) : ?>
    <tr>
        <td><?php echo $destination['id']; ?></td>
        <td><?php echo $destination['city']; ?></td>
        <td><?php echo $destination['state']; ?></td>
        <td><?php echo $destination['country']; ?></td>
        <td><?php echo $destination['lat']; ?></td>
        <td><?php echo $destination['lng']; ?></td>
        <td><?php echo $destination['population']; ?></td>
        <td><?php echo $destination['languages']; ?></td>
        <td><?php echo $destination['climate']; ?></td>
        <td><?php echo $destination['advisory']; ?></td>
        <td>
            <form action="citypages_admin_edit.php" method="get">
                <input type="hidden" name="destinationId" value="<?php echo $destination['id']; ?>">
                <button type="submit" name="edit" class='adminBtn'data-toggle='tooltip' data-placement='top' title='Edit/Details'><a><span class="glyphicon glyphicon-pencil" ></span></a></button>
            </form>
        </td>
        <td>
            <form action="citypages_admin.php" method="post">
                <input type="hidden" name="destinationId" value="<?php echo $destination['id']; ?>" />
                <button type="submit" name="delete" class='adminBtn' data-toggle='tooltip' data-placement='top' title='Delete'><a><span class="glyphicon glyphicon-remove" ></span></a></button>
            </form>

            <?php
                if(isset($_POST['delete'])) {
                    $destinationId = $_POST['destinationId'];
                    $destinationObj->deleteDestination($db, $destinationId);
                }
            ?>
        </td>
    </tr>
    
<?php endforeach; ?>
    
</table>
</div>          
    <form action="citypages_admin_add.php" class='text-center'>
    <input type="submit" value="Add a new destination" class="btn btn-success">
    </form>
</div>


<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>