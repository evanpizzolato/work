<?php
$page_title = "Events";
require_once "includes/header.php";
$all_evts = $events->getAllEvents();
$usr_evts = $events->getUserEvents($_SESSION["user"]["id"]);
$loc = $locations->getLocations();

$xml = ($_SESSION["user"]["class"] == 3) ? $events->mapEvents($usr_evts, '"'.$_SESSION["user"]["id"].'"') : $events->mapEvents($all_evts, "events");

ob_start();
?>

<h1><a href="events.php">Events</a></h1> 
<div id="map" style="width: 100%; height:300px;"></div>
<div class="jumbotron">
<?php
if ($_SESSION["user"]["class"] == 3) {
    ?>
    <h3>Your Events</h3><br>
    <table class="table table-hover">
        <tr class="table-disabled"><th>Name</th><th>Date</th><th>Location</th><th>Active</th><th></th><th></th></tr>
    <?php
    foreach ($usr_evts as $e) {
        echo "<tr onClick='eventsMap(\"".$_SESSION["user"]["id"]."\",".$e["lat"].",".$e["lng"].",17)'><td><a href='".$e['link']."'>".$e[1]."</a></td>";
        echo "<td>".date("M j @ g:i A", strtotime($e['date']))."</td>";
        echo "<td>".$e['name']."</td>";
        echo ($e['visible'] == 0) ? "<td><a href='events.php?advertise=".$e['id']."' data-toggle='tooltip' data-placement='top' title='View'><span class='label label-danger'>No</span></a></td>" : "<td><a href='events.php?advertise=".$e['id']."' data-toggle='tooltip' data-placement='top' title='View'><span class='label label-success'>Yes</span></a></td>";
        
        echo "<td><a href='events.php?edit=".$e['id']."' data-toggle='tooltip' data-placement='top' title='Edit/Details'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td><td><a href='events.php?delete=".$e['id']."' data-toggle='tooltip' data-placement='top' title='Delete'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td></tr>";
    }
    ?>
    </table><br>
    <?php if(isset($_GET["edit"])) {
        echo "<h3>Edit Event</h3><br>";
        $evt_update = $events->getEvent($_GET["edit"]);
        include_once "includes/eventsForm.php";
    ?>
        <input type="hidden" name="id" value="<?php echo $_GET["edit"];?>">
        <br><div class="text-right formcol"><input type="submit" name="update_event" class="btn btn-success" value="Update"></div></form>
    <?php } else if(isset($_GET["delete"])){
        echo "<h3>Delete Event</h3><br>";
        $evt_update = $events->getEvent($_GET["delete"]);
    ?>  <p>Are you sure you want to delete <?php echo $evt_update[1];?>?</p>
        <small class="text-danger">* This action cannot be undone.</small>
        <br><form action="events.php" method="post" class="text-right formcol"><input type="submit" name="delete_event" class="btn btn-danger" value="Delete"><input type="hidden" name="id" value="<?php echo $_GET["delete"];?>"></form>
        
    <?php } else if(isset($_GET["advertise"])) { 
        $evt_update = $events->getEvent($_GET["advertise"]);
        
        echo "<h3>Advertise</h3>";
        
        if ($evt_update['visible'] == 0) {
            echo "<p>Promote ".$evt_update[1]." on Nomadic</p>";
            include_once "includes/advertise.php"; 
            echo "<br><br><br><div style='clear: both'><small>You must start a campaign for your event to be visible to all users.</small></div>";
        } else { 
            echo "<p>The campaign for ".$evt_update[1]." ends at ". date('M j @ g:i A' ,strtotime($evt_update['end'])) .".</p>";
        }
    } else {
        echo "<h3>New Event</h3><br>";
        unset($evt_update);
        include_once "includes/eventsForm.php";
    ?>
        <br><div class="text-right formcol"><input type="submit" name="add_event" class="btn btn-success" value="Create Event"></div></form>
    <?php } ?>
<?php
} else if ($_SESSION["user"]["class"] == 2 || $_SESSION["user"]["class"] == 1) {
    if(empty($all_evts)) {
        echo "<p>There are no events to display!</p>";
    } else {
        echo "<div id='locationPoints'>";
        echo '<table class="table table-hover"><tr><th>Name</th><th>Date</th><th>Location</th></tr>';
        //var_dump($all_evts);
        foreach ($all_evts as $l) {
            echo '<tr onClick="eventsMap(\'events\','.$l["lat"].",".$l["lng"].',17)"><td><a href="'.$l["link"].'" target="_blank">'.$l[1].'</a></td><td>'.date('M j @ g:i A' ,strtotime($l['date'])).'</td><td>'.$l["name"].'</td>';?>
            <?php } 
        echo "</table></div>";
    }
} else {
    redirect("permission.php");
}
?></div><?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBezB6nsA4T2TBk-N1BsR3HWTvSX7R-8SY&callback=eventsMap"></script>