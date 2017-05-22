<?php
$dest = $locations->getDestination();

?>
<div class="container-fluid jumbotron" style="padding: 0">
    <div class="col-sm-12" style="padding: 0">
        <div id="map" style="height:300px; padding: 0" data-toggle='tooltip' data-placement='right' title='Viewing Locations'></div>
        <?php foreach ($dest as $d) { ?>
        <button type="button" class="btn btn-primary btn-sm col-sm-4 pull-right" onClick="locationsMap(<?php echo $d["lat"].",".$d["lng"];?>,12);" <?php if(isset($loc_update)) echo ($d["id"] == $loc_update[0]["destinations_id"])? "selected='selected'" : "" ;?>><small><?php echo $d["city"].", ".$d["country"];?></small></button>
         <?php } ?>
        <a href='./locations.php' type="button" class="btn btn-primary btn-sm col-sm-12 pull-right" >Go to locations</a>
    </div>
    <div class="col-sm-6"></div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBezB6nsA4T2TBk-N1BsR3HWTvSX7R-8SY&callback=locationsMap"></script>