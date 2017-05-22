<form id="events" action="events.php" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="loc" class="col-sm-3 control-label">Location</label>
        <div class="col-sm-8">
            <select class="form-control" id="loc" name="loc">
                <option>Choose Location</option>
                <?php foreach ($loc as $l) { ?>
                    <option value='<?php echo $l[0];?>'<?php echo (isset($evt_update) && $evt_update['locations_id'] == $l[0])? " selected='selected'" : "" ;?>><?php echo $l[1].", ".$l["address"];?></option>;
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="name" name="name" placeholder="Event name" value="<?php echo (isset($evt_update)) ? $evt_update[1] : "" ; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="date" class="col-sm-3 control-label pull-left clearfix">Event Time</label>
        <div class="col-sm-8 formcol">
            <div class="col-md-6">
                <input class="form-control" type="date" id="date" name="date" placeholder="Date" value="<?php echo (isset($evt_update)) ? date('Y-m-d', strtotime($evt_update['date'])) : date("Y-m-d");?>">
            </div>
            <label></label>
            <div class="col-md-6">
                <input class="form-control" type="time" id="time" name="time" placeholder="Start time" value="<?php echo (isset($evt_update)) ? date('H:m', strtotime($evt_update['date'])) : date("H").":00";?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="desc" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
            <textarea class="form-control" type="text" id="desc" name="desc" placeholder="Description"><? echo (isset($evt_update)) ? $evt_update["description"] : "" ;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="link" class="col-sm-3 control-label">Link</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="link" name="link" placeholder="http://www.example.com" value="<? echo (isset($evt_update)) ? $evt_update["link"] : "" ;?>">
        </div>
    </div>