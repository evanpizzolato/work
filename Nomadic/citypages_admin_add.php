<?php
// Put the title for your the page here
$page_title = "~Template~";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags

//$mydi = new Database();
//$pdoconn = $mydi->getDatabase();

$destinationObj = new Destination();
$destinations = $destinationObj->getDestinations($db);

?>
<?php
if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] !== "1") {
    redirect("permission.php");
}
?>
<div class="jumbotron">    
    <h1>Add a new Destination</h1>

    <form name="addDestination" action="citypages_admin_add.php" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="city" class="col-sm-3 control-label">Name: </label>
            <div class="col-sm-8">            
            <input type="text" name="city" class='form-control'/>
            <?php

                if(isset($_POST['city'])) {
                    $cityEmptyValidation = new Validation();
                    $cityEmptyValidation->setInput($_POST['city']);
                    $cityEmptyValidation->validateEmpty();
                    $cityEmptyFlag = $cityEmptyValidation->getFlag();

                    $cityMaxValidation = new Validation();
                    $cityMaxValidation->setInput($_POST['city']);
                    $cityMaxValidation->validateMaxLength(60);
                    $cityMaxFlag = $cityMaxValidation->getFlag();


                    if($cityEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $cityEmptyValidation->message . "</span>"; }

                    if($cityMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $cityMaxValidation->message . "</span>"; }
                    };

                 ?>
            </div>    
        </div>
        
        <div class="form-group">
        <label for="state" class="col-sm-3 control-label">State: </label>
        <div class="col-sm-8">     
        <input type="text" name="state" class='form-control'/>
        <?php

            if(isset($_POST['state'])) {
                $stateEmptyValidation = new Validation();
                $stateEmptyValidation->setInput($_POST['state']);
                $stateEmptyValidation->validateEmpty();
                $stateEmptyFlag = $stateEmptyValidation->getFlag();

                $stateMaxValidation = new Validation();
                $stateMaxValidation->setInput($_POST['state']);
                $stateMaxValidation->validateMaxLength(60);
                $stateMaxFlag = $stateMaxValidation->getFlag();


                if($stateEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $stateEmptyValidation->message . "</span>"; }

                if($stateMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $stateMaxValidation->message . "</span>"; }
                };

             ?>
            </div>
        </div>
        
        <div class="form-group">
        <label for="country" class="col-sm-3 control-label">Country: </label>
        <div class="col-sm-8">     
        <input type="text" name="country" class='form-control'/>
        <?php

            if(isset($_POST['country'])) {
                $countryEmptyValidation = new Validation();
                $countryEmptyValidation->setInput($_POST['country']);
                $countryEmptyValidation->validateEmpty();
                $countryEmptyFlag = $countryEmptyValidation->getFlag();

                $countryMaxValidation = new Validation();
                $countryMaxValidation->setInput($_POST['country']);
                $countryMaxValidation->validateMaxLength(60);
                $countryMaxFlag = $countryMaxValidation->getFlag();


                if($countryEmptyFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $countryEmptyValidation->message . "</span>"; }

                if($countryMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $countryMaxValidation->message . "</span>"; }
                };

             ?>                
            </div>
        </div>
        
        <div class="form-group">
        <label for="lat" class="col-sm-3 control-label">Latitude: </label>
        <div class="col-sm-8">     
        <input type="text" name="lat" class='form-control'/>
        <?php

            if(isset($_POST['lat'])) {
                $latEmptyValidation = new Validation();
                $latEmptyValidation->setInput($_POST['lat']);
                $latEmptyValidation->validateEmpty();
                $latEmptyFlag = $latEmptyValidation->getFlag();

                if($latEmptyFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $latEmptyValidation->message . "</span>"; }

                };

             ?>                
            </div>
        </div>
        
        <div class="form-group">
        <label for="lng" class="col-sm-3 control-label">Longitude: </label>
        <div class="col-sm-8">     
        <input type="text" name="lng" class='form-control'/>
        <?php

            if(isset($_POST['lng'])) {
                $lngEmptyValidation = new Validation();
                $lngEmptyValidation->setInput($_POST['lng']);
                $lngEmptyValidation->validateEmpty();
                $lngEmptyFlag = $lngEmptyValidation->getFlag();

                if($lngEmptyFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $lngEmptyValidation->message . "</span>"; }

                };

             ?>                
            </div>
        </div>
        
        
        <div class="form-group">
        <label for="population" class="col-sm-3 control-label">Population: </label>
        <div class="col-sm-8">     
        <input type="text" name="population" class='form-control'/>
        <?php

            if(isset($_POST['population'])) {
                $populationEmptyValidation = new Validation();
                $populationEmptyValidation->setInput($_POST['population']);
                $populationEmptyValidation->validateEmpty();
                $populationEmptyFlag = $populationEmptyValidation->getFlag();

                $populationIntValidation = new Validation();
                $populationIntValidation->setInput($_POST['population']);
                $populationIntValidation->validateInteger();
                $populationIntFlag = $populationIntValidation->getFlag();


                if($populationEmptyFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $populationEmptyValidation->message . "</span>"; }

                if($populationIntFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $populationIntValidation->message . "</span>"; }
                };

             ?>                
            </div>
        </div>
        
        <div class="form-group">
        <label for="languages" class="col-sm-3 control-label">Languages Spoken: </label>
        <div class="col-sm-8">     
        <input type="text" name="languages" class='form-control'/>
        <?php

            if(isset($_POST['languages'])) {
                $languagesEmptyValidation = new Validation();
                $languagesEmptyValidation->setInput($_POST['languages']);
                $languagesEmptyValidation->validateEmpty();
                $languagesEmptyFlag = $languagesEmptyValidation->getFlag();

                $languagesMaxValidation = new Validation();
                $languagesMaxValidation->setInput($_POST['languages']);
                $languagesMaxValidation->validateMaxLength(60);
                $languagesMaxFlag = $languagesMaxValidation->getFlag();


                if($languagesEmptyFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $languagesEmptyValidation->message . "</span>"; }

                if($languagesMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $languagesMaxValidation->message . "</span>"; }
                };

             ?> 
            </div>
        </div>
        
        <div class="form-group">
        <label for="climate" class="col-sm-3 control-label">Climate: </label>
        <div class="col-sm-8">     
        <input type="text" name="climate" class='form-control'/>
        <?php

            if(isset($_POST['climate'])) {
                $climateEmptyValidation = new Validation();
                $climateEmptyValidation->setInput($_POST['climate']);
                $climateEmptyValidation->validateEmpty();
                $climateEmptyFlag = $climateEmptyValidation->getFlag();

                $climateMaxValidation = new Validation();
                $climateMaxValidation->setInput($_POST['climate']);
                $climateMaxValidation->validateMaxLength(60);
                $climateMaxFlag = $climateMaxValidation->getFlag();


                if($climateEmptyFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $climateEmptyValidation->message . "</span>"; }

                if($climateMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $climateMaxValidation->message . "</span>"; }
                };

             ?>
            </div>
        </div>

        <div class="form-group">
        <label for="advisory" class="col-sm-3 control-label">Advisory: </label>
        <div class="col-sm-8">     
        <select name="advisory" class='form-control'>
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
        <?php
            if(isset($_POST['advisory'])) {

                $advisoryBooleanValidation = new Validation();
                $advisoryBooleanValidation->setInput($_POST['advisory']);
                $advisoryBooleanValidation->validateBoolean();
                $advisoryBooleanFlag = $advisoryBooleanValidation->getFlag();


                if($advisoryBooleanFlag == true){ echo "<br>" .  "<span class='alert-danger'>" . $advisoryBooleanValidation->message . "</span>"; }
                };
             ?>
            </div>
        </div>
        <div class="text-center formcol">
            <input type="submit" value="Submit" name="addDestination" class="btn btn-success"/>
        </div>

        <?php
        if(isset($_POST['addDestination'])) {

                if ($cityEmptyFlag == false && $cityMaxFlag == false && $stateEmptyFlag == false && $stateMaxFlag == false && $countryEmptyFlag == false && $countryMaxFlag == false && $latEmptyFlag == false  && $lngEmptyFlag == false && $populationEmptyFlag == false && $populationIntFlag == false && $languagesEmptyFlag == false && $languagesMaxFlag == false && $climateEmptyFlag == false && $climateMaxFlag == false && $advisoryBooleanFlag == false) {

                    $destinationObj->newDestination($db, $_POST['city'], $_POST['state'], $_POST['country'], $_POST['lat'], $_POST['lng'], $_POST['population'], $_POST['languages'], $_POST['climate'], $_POST['advisory']);

                    $message = "Destination added";
                    echo alertMsg($message, 'success');

                } else if ($cityEmptyFlag == true || $cityMaxFlag == true || $stateEmptyFlag == true || $stateMaxFlag == true || $countryEmptyFlag == true || $countryMaxFlag == true || $latEmptyFlag == true || $lngEmptyFlag == true || $populationEmptyFlag == true || $populationIntFlag == true || $languagesEmptyFlag == true || $languagesMaxFlag == true || $climateEmptyFlag == true || $climateMaxFlag == true || $advisoryBooleanFlag == true) {
                    $message = "Destination was not added as it contains invalid data";
                    echo alertMsg($message, 'danger');
                }
            }
        ?>

    </form>

    <form action="citypages_admin.php">
    <input type="submit" value="Back to list" class="btn btn-default">
    </form>
</div>
<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>