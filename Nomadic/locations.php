<?php
$page_title = "Manage Locations";
require_once "includes/header.php";

$loc = $locations->getLocations();
$dest = $locations->getDestination();
$exp = $locations->getExp();
$cate = $locations->getCategory();

$xml = $locations->mapLocations($loc, "locations");
ob_start();
?>

<h1><a href="locations.php">Locations</a></h1> 
<?php
if ($_SESSION["user"]["class"] == 1) {?>
<div id="map" style="width: 100%; height:300px;"></div>
<form action="locations.php" method="post" class="form-horizontal jumbotron" enctype="multipart/form-data">
    <?php if(isset($_GET["edit"])) {
        echo "<h3>Edit Location</h3><br>";
        $loc_update = $locations->getLocation($_GET["edit"]);
        include_once "includes/locationForm.php";
    ?>
        <input type="hidden" name="id" value="<?php echo $_GET["edit"];?>" onload="">
        <br><div class="text-right formcol"><input type="submit" name="update_location" class="btn btn-success" value="Update"></div>
    <?php } else if(isset($_GET["delete"])){
        echo "<h3>Delete Location</h3><br>";
        $loc_update = $locations->getLocation($_GET["delete"]);
    ?>  <p>Are you sure you want to delete <?php echo $loc_update[0][1];?>?</p>
        <small class="text-danger">* This action cannot be undone.</small>
        <input type="hidden" name="id" value="<?php echo $_GET["delete"];?>" onload="locationsMap(<?php echo $loc_update[0][4].",".$loc_update[0][5].",14";?>)">
        <br><div class="text-right formcol"><input type="submit" name="delete_location" class="btn btn-danger" value="Delete"></div>
    <?php } else {
        echo "<h3>Add Location</h3><br>";
        unset($loc_update);
        include_once "includes/locationForm.php";
    ?>
        <br><div class="text-right formcol"><input type="submit" name="add_location" class="btn btn-success" value="Add Location"></div>
    <?php } ?>
</form>
<?php
} else if ($_SESSION["user"]["class"] == 2) {
?><div id="map" style="width: 100%; height:400px;"></div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBezB6nsA4T2TBk-N1BsR3HWTvSX7R-8SY&callback=locationsMap<?php //echo(isset($loc_update))?"(".$loc_update[0][4].",".$loc_update[0][5].",14)":"";?>"></script><div class="jumbotron"><?php
    echo "<center class='row'>";
    foreach ($dest as $d) { ?>
        <a type="button" class="btn btn-primary" onClick="locationsMap(<?php echo $d["lat"].",".$d["lng"];?>,12);" <?php if(isset($loc_update)) echo ($d["id"] == $loc_update[0]["destinations_id"])? "selected='selected'" : "" ;?>><?php echo $d["city"].", ".$d["country"];?></a>
     <?php }
    echo "</center><br><br>";
    echo "<div id='locationPoints'>";
    echo '<table class="table table-hover"><tr class="table-header"><th>Name</th><th>Address</th><th>Country</th><th>Type</th></tr>';
    foreach ($loc as $l) {
        echo '<tr onClick="locationsMap('.$l[4].",".$l[5].',17)"><td>'.$l[1].'</td><td>'.$l["address"].'</td>';?>
            <td><?php foreach ($dest as $e) { if ($l["destinations_id"]!=$e["id"]) {continue;} else {echo $e["city"].", ".$e["country"];}}?></td>
            <td><?php foreach ($cate as $e) { if ($l["location_categories_id"]!=$e["id"]) {continue;} else {echo $e["name"];}}?></td>
        <?php } 
    echo "</table></div>";
?></div><?php
} else {
    redirect("permission.php");
}
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBezB6nsA4T2TBk-N1BsR3HWTvSX7R-8SY&callback=locationsMap"></script>