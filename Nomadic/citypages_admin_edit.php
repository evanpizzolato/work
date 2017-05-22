<?php
// Put the title for your the page here
$page_title = "~Template~";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags 
?>

<?php
if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] !== "1") {
    redirect("permission.php");
}
?>

<?php
//$mydi = new Database();
//$pdoconn = $mydi->getDatabase();

$destinationObj = new Destination();

if (isset($_GET['destinationId'])){
$destination = $destinationObj->getDestinationById($db, $_GET['destinationId']);
}
//echo var_dump($_POST);

//echo $destination['city'];

$tipsObj = new Tips();

if (isset($_GET['destinationId'])){
    $tips = $tipsObj->getTipsByCity($db, $_GET['destinationId']);
} else if (isset($_POST['destinationIdToSend'])) {
    $tips = $tipsObj->getTipsByCity($db, $_POST['destinationIdToSend']);
}

?>
<div class="jumbotron">
    <h2 class='text-center'><?php if (isset($destination['city'])) {echo $destination['city'];} ?></h2>
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

        <tr>
            <td>
                <?php 
                    if(isset($destination['id'])){
                        echo $destination['id'];
                    } else if(isset($_POST['destinationIdToSend'])){
                        echo $_POST['destinationIdToSend'];
                    }
                ?>
            </td>

            <td>
                 <?php 
                    if(isset($destination['city'])){
                        echo $destination['city'];
                    } else if(isset($_POST['city_edit'])){
                        echo $_POST['city_edit'];
                    }
                ?>               
            </td>

            <td>
                 <?php 
                    if(isset($destination['state'])){
                        echo $destination['state'];
                    } else if(isset($_POST['state_edit'])){
                        echo $_POST['state_edit'];
                    }
                ?>               
            </td>
            <td>
                 <?php 
                    if(isset($destination['country'])){
                        echo $destination['country'];
                    } else if(isset($_POST['country_edit'])){
                        echo $_POST['country_edit'];
                    }
                ?>               
            </td>
            <td>
                 <?php 
                    if(isset($destination['lat'])){
                        echo $destination['lat'];
                    } else if(isset($_POST['latitude_edit'])){
                        echo $_POST['latitude_edit'];
                    }
                ?>               
            </td>
            <td>
                 <?php 
                    if(isset($destination['lng'])){
                        echo $destination['lng'];
                    } else if(isset($_POST['longitude_edit'])){
                        echo $_POST['longitude_edit'];
                    }
                ?>               
            </td>
            
            <td>
                 <?php 
                    if(isset($destination['population'])){
                        echo $destination['population'];
                    } else if(isset($_POST['population_edit'])){
                        echo $_POST['population_edit'];
                    }
                ?>               
            </td>
            <td>
                 <?php 
                    if(isset($destination['languages'])){
                        echo $destination['languages'];
                    } else if(isset($_POST['languages_edit'])){
                        echo $_POST['languages_edit'];
                    }
                ?>               
            </td>
            <td>
                 <?php 
                    if(isset($destination['climate'])){
                        echo $destination['climate'];
                    } else if(isset($_POST['climate_edit'])){
                        echo $_POST['climate_edit'];
                    }
                ?>               
            </td>
            <td>
                 <?php 
                    if(isset($destination['advisory'])){
                        echo $destination['advisory'];
                    } else if(isset($_POST['advisory_edit'])){
                        echo $_POST['advisory_edit'];
                    }
                ?>               
            </td>
        </tr>
    </table>

<h2 class='text-center'>Edit <?php if (isset($destination['city'])) {echo $destination['city'];} ?></h2>

<form method="post" action="citypages_admin_edit.php" class="form-horizontal">
    <div class="form-group">
    <label for="city_edit" class="col-sm-3 control-label">Name:</label>
    <div class="col-sm-8">
    <input type="text" class='form-control' name="city_edit" value="<?php 
                                                         
            if(isset($destination['city'])){
                echo $destination['city'];
            } else if(isset($_POST['city_edit'])){
                echo $_POST['city_edit'];
            }
                                               ?>"/>
            <?php
                
                if(isset($_POST['city_edit'])) {
                    $cityEmptyValidation = new Validation();
                    $cityEmptyValidation->setInput($_POST['city_edit']);
                    $cityEmptyValidation->validateEmpty();
                    $cityEmptyFlag = $cityEmptyValidation->getFlag();
                    
                    $cityMaxValidation = new Validation();
                    $cityMaxValidation->setInput($_POST['city_edit']);
                    $cityMaxValidation->validateMaxLength(60);
                    $cityMaxFlag = $cityMaxValidation->getFlag();

                    
                    if($cityEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $cityEmptyValidation->message . "</span>"; }
                    
                    if($cityMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $cityMaxValidation->message . "</span>"; }
                    };
                
                 ?>                
    </div>
    </div>    
    <br >
    
    <div class="form-group">
    <label for="state_edit" class="col-sm-3 control-label">State:</label>
    <div class="col-sm-8">
    <input type="text" class='form-control' name="state_edit" value="<?php 
                                                         
            if(isset($destination['state'])){
                echo $destination['state'];
            } else if(isset($_POST['state_edit'])){
                echo $_POST['state_edit'];
            }
                                               ?>"/>
            <?php
                
                if(isset($_POST['state_edit'])) {
                    $stateEmptyValidation = new Validation();
                    $stateEmptyValidation->setInput($_POST['state_edit']);
                    $stateEmptyValidation->validateEmpty();
                    $stateEmptyFlag = $stateEmptyValidation->getFlag();
                    
                    $stateMaxValidation = new Validation();
                    $stateMaxValidation->setInput($_POST['state_edit']);
                    $stateMaxValidation->validateMaxLength(60);
                    $stateMaxFlag = $stateMaxValidation->getFlag();

                    
                    if($stateEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $stateEmptyValidation->message . "</span>"; }
                    
                    if($stateMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $stateMaxValidation->message . "</span>"; }
                    };
                
                 ?>                
    </div>
    </div>    
    <br >
    
    <div class="form-group">
    <label for="country_edit" class="col-sm-3 control-label">Country:</label>
    <div class="col-sm-8">
    <input type="text" class='form-control' name="country_edit" value="<?php 
                                                         
            if(isset($destination['country'])){
                echo $destination['country'];
            } else if(isset($_POST['country_edit'])){
                echo $_POST['country_edit'];
            }
                                               ?>"/>
            <?php
                
                if(isset($_POST['country_edit'])) {
                    $countryEmptyValidation = new Validation();
                    $countryEmptyValidation->setInput($_POST['country_edit']);
                    $countryEmptyValidation->validateEmpty();
                    $countryEmptyFlag = $countryEmptyValidation->getFlag();
                    
                    $countryMaxValidation = new Validation();
                    $countryMaxValidation->setInput($_POST['country_edit']);
                    $countryMaxValidation->validateMaxLength(60);
                    $countryMaxFlag = $countryMaxValidation->getFlag();

                    
                    if($countryEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $countryEmptyValidation->message . "</span>"; }
                    
                    if($countryMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $countryMaxValidation->message . "</span>"; }
                    };
                
                 ?>                
    </div>
    </div>    
    <br >

        <div class="form-group">
        <label for="latitude_edit" class="col-sm-3 control-label">Latitude: </label>
        <div class="col-sm-8">     
        <input type="text" name="latitude_edit" class='form-control' value="<?php 
                                                         
            if(isset($destination['lat'])){
                echo $destination['lat'];
            } else if(isset($_POST['latitude_edit'])){
                echo $_POST['latitude_edit'];
            }
                                               ?>"/>
        <?php

            if(isset($_POST['latitude_edit'])) {
                $latEmptyValidation = new Validation();
                $latEmptyValidation->setInput($_POST['latitude_edit']);
                $latEmptyValidation->validateEmpty();
                $latEmptyFlag = $latEmptyValidation->getFlag();

                if($latEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $latEmptyValidation->message . "</span>"; }

                };

             ?>                
            </div>
        </div>
        
        <div class="form-group">
        <label for="longitude_edit" class="col-sm-3 control-label">Longitude: </label>
        <div class="col-sm-8">     
        <input type="text" name="longitude_edit" class='form-control' value="<?php 
                                                         
            if(isset($destination['lng'])){
                echo $destination['lng'];
            } else if(isset($_POST['longitude_edit'])){
                echo $_POST['longitude_edit'];
            }
                                               ?>"/>
        <?php

            if(isset($_POST['longitude_edit'])) {
                $lngEmptyValidation = new Validation();
                $lngEmptyValidation->setInput($_POST['longitude_edit']);
                $lngEmptyValidation->validateEmpty();
                $lngEmptyFlag = $lngEmptyValidation->getFlag();

                if($lngEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" .$lngEmptyValidation->message . "</span>"; }

                };

             ?>                
            </div>
        </div>

    
    
    <div class="form-group">
    <label for="population_edit" class="col-sm-3 control-label">Population:</label>
    <div class="col-sm-8">
    <input type="text" class='form-control' name="population_edit" value="<?php 
                                                         
            if(isset($destination['population'])){
                echo $destination['population'];
            } else if(isset($_POST['population_edit'])){
                echo $_POST['population_edit'];
            }
                                               ?>"/>
            <?php
                
                if(isset($_POST['population_edit'])) {
                    $populationEmptyValidation = new Validation();
                    $populationEmptyValidation->setInput($_POST['population_edit']);
                    $populationEmptyValidation->validateEmpty();
                    $populationEmptyFlag = $populationEmptyValidation->getFlag();
                    
                    $populationIntValidation = new Validation();
                    $populationIntValidation->setInput($_POST['population_edit']);
                    $populationIntValidation->validateInteger();
                    $populationIntFlag = $populationIntValidation->getFlag();

                    
                    if($populationEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $populationEmptyValidation->message . "</span>"; }
                    
                    if($populationIntFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $populationIntValidation->message . "</span>"; }
                    };
                
                 ?>                
    </div>
    </div>    
    <br >

    <div class="form-group">
    <label for="languages_edit" class="col-sm-3 control-label">Languages:</label>
    <div class="col-sm-8">
    <input type="text" class='form-control' name="languages_edit" value="<?php 
                                                         
            if(isset($destination['languages'])){
                echo $destination['languages'];
            } else if(isset($_POST['languages_edit'])){
                echo $_POST['languages_edit'];
            }
                                               ?>"/>
            <?php
                
                if(isset($_POST['languages_edit'])) {
                    $languagesEmptyValidation = new Validation();
                    $languagesEmptyValidation->setInput($_POST['languages_edit']);
                    $languagesEmptyValidation->validateEmpty();
                    $languagesEmptyFlag = $languagesEmptyValidation->getFlag();
                    
                    $languagesMaxValidation = new Validation();
                    $languagesMaxValidation->setInput($_POST['languages_edit']);
                    $languagesMaxValidation->validateMaxLength(60);
                    $languagesMaxFlag = $languagesMaxValidation->getFlag();

                    
                    if($languagesEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $languagesEmptyValidation->message . "</span>"; }
                    
                    if($languagesMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $languagesMaxValidation->message . "</span>"; }
                    };
                
                 ?>                
    </div>
    </div>    
    <br >
    
    <div class="form-group">
    <label for="climate_edit" class="col-sm-3 control-label">Climate:</label>
    <div class="col-sm-8">
    <input type="text" class='form-control' name="climate_edit" value="<?php 
                                                         
            if(isset($destination['climate'])){
                echo $destination['climate'];
            } else if(isset($_POST['climate_edit'])){
                echo $_POST['climate_edit'];
            }
                                               ?>"/>
            <?php
                
                if(isset($_POST['climate_edit'])) {
                    $climateEmptyValidation = new Validation();
                    $climateEmptyValidation->setInput($_POST['climate_edit']);
                    $climateEmptyValidation->validateEmpty();
                    $climateEmptyFlag = $climateEmptyValidation->getFlag();
                    
                    $climateMaxValidation = new Validation();
                    $climateMaxValidation->setInput($_POST['climate_edit']);
                    $climateMaxValidation->validateMaxLength(60);
                    $climateMaxFlag = $climateMaxValidation->getFlag();

                    
                    if($climateEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" .   $climateEmptyValidation->message . "</br>"; }
                    
                    if($climateMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $climateMaxValidation->message . "</span>"; }
                    };
                
                 ?>                
    </div>
    </div>    
    <br >
    <div class="form-group">
    <label for="advisory_edit" class="col-sm-3 control-label">Advisory:</label>
    <div class="col-sm-8">                
    <input type="text" class='form-control' name="advisory_edit" value="<?php 
                                                         
            if(isset($destination['advisory'])){
                echo $destination['advisory'];
            } else if(isset($_POST['advisory_edit'])){
                echo $_POST['advisory_edit'];
            }
                                               ?>"/>
            <?php
                
                if(isset($_POST['advisory_edit'])) {
                    
                    $advisoryBooleanValidation = new Validation();
                    $advisoryBooleanValidation->setInput($_POST['advisory_edit']);
                    $advisoryBooleanValidation->validateBoolean();
                    $advisoryBooleanFlag = $advisoryBooleanValidation->getFlag();

                                        
                    if($advisoryBooleanFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $advisoryBooleanValidation->message . "</span>"; }
                    };
                
                 ?>                
    </div>
    </div>    
    <br >
    
            <input type="hidden" name="destinationIdToSend" value="<?php if(isset($destination['id'])){
                echo $destination['id'];
            } else {
                echo $_POST['destinationIdToSend'];
            } ?>"/>
            <div class='text-center'>
            <input type="submit" value="Submit Edited Destination" name="edit_destination" class="btn btn-success"/>
            </div>
            <?php
        
                /*if(isset($_POST['edit_destination'])) {
                //$formId = $_POST['formId'];
            
                $destinationObj->editDestination($db, $_POST['city_edit'], $_POST['state_edit'], $_POST['country_edit'], $_POST['population_edit'], $_POST['languages_edit'], $_POST['climate_edit'], $_POST['advisory_edit'], $_POST['destinationIdToSend']);
            
                }*/
    
                if(isset($_POST['edit_destination'])) {
                
                    if ($cityEmptyFlag == false && $cityMaxFlag == false && $stateEmptyFlag == false && $stateMaxFlag == false && $countryEmptyFlag == false && $countryMaxFlag == false && $latEmptyFlag == false && $lngEmptyFlag == false && $populationEmptyFlag == false && $populationIntFlag == false && $languagesEmptyFlag == false && $languagesMaxFlag == false && $climateEmptyFlag == false && $climateMaxFlag == false && $advisoryBooleanFlag == false) {
                        
                        $destinationObj->editDestination($db, $_POST['city_edit'], $_POST['state_edit'], $_POST['country_edit'], $_POST['latitude_edit'], $_POST['longitude_edit'], $_POST['population_edit'], $_POST['languages_edit'], $_POST['climate_edit'], $_POST['advisory_edit'], $_POST['destinationIdToSend']);
                        
                        $message = "Destination edited";
                        echo alertMsg($message, 'success');
                        
                    } else if ($cityEmptyFlag == true || $cityMaxFlag == true || $stateEmptyFlag == true || $stateMaxFlag == true || $countryEmptyFlag == true || $countryMaxFlag == true || $latEmptyFlag == true || $lngEmptyFlag == true || $populationEmptyFlag == true || $populationIntFlag == true || $languagesEmptyFlag == true || $languagesMaxFlag == true || $climateEmptyFlag == true || $climateMaxFlag == true || $advisoryBooleanFlag == true) {
                        $message = "This destination was not edited as it contains invalid data";
                        echo alertMsg($message, 'danger');
                    }
                
                }
            ?>

    
</form>

<h2 class='text-center'>Tips</h2>

<table class="table table-hover">
    
    <tr>
        <th>Tip ID</th>
        <th>User ID</th>
        <th>Content</th>
        <th>Date Submitted</th>
        <th>Date Edited</th>
        
    </tr>
<?php 
    if (isset($tips)){
    foreach ($tips as $tip) : ?>
    <tr>
        <td><?php echo $tip['id']; ?></td>      
        <td><?php echo $tip['users_id']; ?></td>         
        <td><?php echo $tip['content']; ?></td>
        <td><?php echo $tip['date_added']; ?></td>        
        <td><?php echo $tip['date_edited']; ?></td> 
        
        <td>
            <form style="display:inline;" method="get" action="citypages_edittip.php">
                <input type="hidden" name="tipId" value="<?php echo $tip['id']; ?>"/>                            
                <input type="submit" name="edit" value="Edit" class='btn btn-default'>
            </form>

        </td>
        <td>                        
            <form style="display:inline;" method="post">
                <input type="hidden" name="tipIdDelete" value="<?php echo $tip['id']; ?>" />
                <input type="submit" name="delete" value="Delete" class='btn btn-danger'>
            </form>
        </td>
    </tr>    
<?php endforeach;} ?>
</table>    

       <?php
        if(isset($_POST['delete'])) {
            $tipIdDelete = $_POST['tipIdDelete'];
            $tipsObj->deleteTip($db, $tipIdDelete);
                $message = "Tip deleted!";
                echo alertMsg($message, 'danger');
            }
            ?>


        <form action="citypages_admin.php" class='text-center'>
        <input type="submit" value="Back to list" class="btn btn-default">
        </form>
</div>

<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>