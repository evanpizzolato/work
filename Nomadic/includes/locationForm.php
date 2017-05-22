    <div class="form-group">
        <label for="dest" class="col-sm-3 control-label">Destination</label>
        <div class="col-sm-8">
            <select class="form-control" id="dest" name="dest" onChange="locationsMap($('option:selected', this).attr('lat'), $('option:selected', this).attr('lon'), 11);">
                <option>Choose Destination</option>
                <?php foreach ($dest as $d) { ?>
                    <option value='<?php echo $d["id"];?>' <?php if(isset($loc_update)) echo ($d["id"] == $loc_update[0]["destinations_id"])? "selected='selected'" : "" ; echo "lat=".$d["lat"]." lon=".$d["lng"];?> ><?php echo $d["city"].", ".$d["country"];?></option>;
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="name" name="name" placeholder="Location name" value="<? echo (isset($loc_update[0][1])) ? $loc_update[0][1] : "" ;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="lat" class="col-sm-3 control-label pull-left clearfix">Coordinates</label>
        <div class="col-sm-8 formcol">
            <div class="col-md-6">
                <input class="form-control" type="text" id="lat" name="lat" placeholder="Latitude" value="<? echo (isset($loc_update[0][4])) ? $loc_update[0][4] : "" ;?>">
            </div>
            <label></label>
            <div class="col-md-6">
                <input class="form-control" type="text" id="lng" name="lng" placeholder="Longitude" value="<? echo (isset($loc_update[0][5])) ? $loc_update[0][5] : "" ;?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-sm-3 control-label">Address</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="address" name="address" placeholder="1234 Example Ave." value="<? echo (isset($loc_update[0]["address"])) ? $loc_update[0]["address"] : "" ;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="zip" class="col-sm-3 control-label">Zip Code</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="zip" name="zip" placeholder="Zip code" value="<? echo (isset($loc_update[0]["zip"])) ? $loc_update[0]["zip"] : "" ;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="img" class="col-sm-3 control-label">Upload Picture</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="link" placeholder="Image Url (http://...)">
            <small>or</small><br>
            <input type="file" id="img" name="img" accept="image/*">
            <small class="help-block">File must be under 9MB.</small>
            <center style="width:350px;height:200px;overflow:hidden;margin:0 auto"><img id="uploadedPreview" alt="<? echo (isset($loc_update[0][1])) ? $loc_update[0][1] : "" ;?>" src="<?php echo (isset($loc_update[0]["filePath"]))? $loc_update[0]["filePath"] : "media/location-images/default.svg" ;?>" width="100%"></center>
            <?php echo (isset($loc_update[0]["filePath"]))?"<input type='hidden' name='filePath' value='".$loc_update[0]['filePath']."'/>":"";?>
        </div>
    </div>
    <div class="form-group">
        <label for="web" class="col-sm-3 control-label">Website</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="web" name="web" placeholder="http://www.example.com" value="<? echo (isset($loc_update[0]["website"])) ? $loc_update[0]["website"] : "" ;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="col-sm-3 control-label">Phone</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="phone" name="phone" placeholder="e.g. +1(xxx) xxx-xxxx" value="<? echo (isset($loc_update[0]["phone"])) ? $loc_update[0]["phone"] : "" ;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="desc" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
            <textarea class="form-control" type="text" id="desc" name="desc" placeholder="Description"><? echo (isset($loc_update[0]["description"])) ? $loc_update[0]["description"] : "" ;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="cate" class="col-sm-3 control-label">Category</label>
        <div class="col-sm-8">
            <select class="form-control" id="cate" name="cate">
                <option>Choose Category</option>
                <?php foreach ($cate as $c) {
                    if ($c["id"] == 3) {continue;}?>
                    <option value='<?php echo $c["id"];?>' <?php if(isset($loc_update)) echo ($c["id"] == $loc_update[0]["location_categories_id"])? "selected='selected'" : "" ;?>><?php echo $c["name"];?></option>";
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="exp" class="col-sm-3 control-label">Budget</label>
        <div class="col-sm-8">
            <?php foreach ($exp as $e) {?>
            <label class="radio-inline">
                <input type="radio" name="exp" id="exp-<?php echo $e["id"];?>" value="<?php echo $e["id"];?>" <?php echo (isset($loc_update) && $e["id"] == $loc_update[0]["exp_levels_id"]) ? 'checked' : 'disabled' ;?> > <?php echo $e["name"];?>
            </label>
            <?php }?>
        </div>
    </div>
    <div class="form-group">
        <label for="cost" class="col-sm-3 control-label">Cost</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" id="cost" name="cost" placeholder="Cost per night" value=<? echo (!isset($loc_update[0]["cost"]) || $loc_update[0]["cost"] == 0) ? '"" disabled' :'"'.$loc_update[0]["cost"].'"';?>>
        </div>
    </div>