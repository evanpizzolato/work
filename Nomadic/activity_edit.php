<?php
// Put the title for your the page here
$page_title = "Edit Activity";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags 

//$myDb = new Database();
//$pdoconn = $myDb->getDatabase();

$activitesObj = new ItineraryItems();

//print_r($_POST);
if (isset($_GET['activityIdForEdit'])) {
$activity = $activitesObj->getItineraryItem($db, $_GET['activityIdForEdit']);
}
    
if ($activity['users_id'] !== $_SESSION['user']['id']) {
    redirect("permission.php");
}
?>
<div class="jumbotron">
<h2 class='text-center'><?php if(isset($_POST['activityName_edit'])){echo $_POST['activityName_edit'];}else if (isset($activity['name'])){echo $activity['name'];}?></h2>
<table class="table table-hover">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Notes</th>
        <th>Time Start</th>
        <th>Time End</th>
        <th>Location</th>
        <th>Date</th>
    </tr>
    <tr>
        <td>
            <?php 
                if(isset($_POST['activityName_edit'])){
                    echo $_POST['activityName_edit'];
                } else if (isset($activity['name'])) {
                    echo $activity['name'];
                }
            ?>
        </td>
        <td>
            <?php 
                if(isset($_POST['activityDescription_edit'])){
                    echo $_POST['activityDescription_edit'];
                } else if (isset($activity['description'])) {
                    echo $activity['description'];
                }
            ?>
        </td>
        <td>
            <?php 
                if(isset($_POST['activityNotes_edit'])){
                    echo $_POST['activityNotes_edit'];
                } else if (isset($activity['notes'])){
                    echo $activity['notes'];
                }
            ?>
        </td>
        <td>
            <?php 
                if(isset($_POST['activityTime_start_edit'])){
                    echo $_POST['activityTime_start_edit'];
                } else if (isset($activity['time_start'])){
                    echo $activity['time_start'];
                }
            ?>
        </td>
        <td>
            <?php 
                if(isset($_POST['activityTime_end_edit'])){
                    echo $_POST['activityTime_end_edit'];
                } else if (isset($activity['time_end'])){
                    echo $activity['time_end'];
                }
            ?>
        </td>
        <td>
            <?php 
                if(isset($_POST['activityLocation_edit'])){
                    echo $_POST['activityLocation_edit'];
                } else if (isset($activity['location'])){
                    echo $activity['location'];
                }
            ?>
        </td>
        <td>
            <?php 
                if(isset($_POST['date_edit'])){
                    echo $_POST['date_edit'];
                } else if (isset($activity['date'])){
                    echo $activity['date'];
                }
            ?>
        </td>
    </tr>
</table>

<h2 class='text-center'>Edit <?php if(isset($_POST['activityName_edit'])){echo $_POST['activityName_edit'];}else if (isset($activity['name'])){echo $activity['name'];}?></h2>

<form method="post" action="activity_edit.php?activityIdForEdit=<?php
                            if(isset($_GET['activityIdForEdit'])) {echo $_GET['activityIdForEdit'];} else if (isset($_POST['activityIdToSend'])) {echo $_POST['activityIdToSend'];}
                            ?>" class="form-horizontal">
    
    <div class="form-group">
    <label for="activityName_edit" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-8">    
    <input type="text" class='form-control' name="activityName_edit" value="<?php                 if(isset($_POST['activityName_edit'])){
                    echo $_POST['activityName_edit'];
                } else if (isset($activity['name'])){
                    echo $activity['name'];
                }
 ?>">
    <?php
    if(isset($_POST['activityName_edit'])){
        $activityNameEmptyValidation = new Validation();
        $activityNameEmptyValidation->setInput($_POST['activityName_edit']);
        $activityNameEmptyValidation->validateEmpty();
        $activityNameEmptyFlag = $activityNameEmptyValidation->getFlag();
        
        $activityNameMaxValidation = new Validation();
        $activityNameMaxValidation->setInput($_POST['activityName_edit']);
        $activityNameMaxValidation->validateMaxLength(75);
        $activityNameMaxFlag = $activityNameMaxValidation->getFlag();
        
        if($activityNameEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" .  $activityNameEmptyValidation->message . "</span>"; }
        if($activityNameMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $activityNameMaxValidation->message . "</span>"; }        
    }
    ?>
        </div>    
    </div>    
    <br>
    
    <div class="form-group">
    <label for="activityDescription_edit" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-8">
    <input type="text" class='form-control' name="activityDescription_edit" value="<?php                 if(isset($_POST['activityDescription_edit'])){
                    echo $_POST['activityDescription_edit'];
                } else if (isset($activity['description'])){
                    echo $activity['description'];
                }
?>">
    <?php
        if(isset($_POST['activityDescription_edit'])){
            $activityDescriptionMaxValidation = new Validation();
            $activityDescriptionMaxValidation->setInput($_POST['activityDescription_edit']);
            $activityDescriptionMaxValidation->validateMaxLength(200);
            $activityDescriptionMaxFlag = $activityDescriptionMaxValidation->getFlag();
            if($activityDescriptionMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $activityDescriptionMaxValidation->message . "</span>"; }

        }
    ?>
    </div>        
    </div>    
    <br>

    <div class="form-group">
    <label for="activityNotes_edit" class="col-sm-3 control-label">Notes: </label>
    <div class="col-sm-8">    
    <input type="text" class='form-control' name="activityNotes_edit" value="<?php                 if(isset($_POST['activityNotes_edit'])){
                    echo $_POST['activityNotes_edit'];
                } else if (isset($activity['notes'])){
                    echo $activity['notes'];
                }
?>">
    </div>    
    </div>    
    <br>

    <div class="form-group">
    <label for="activityTime_start_edit" class="col-sm-3 control-label">Start Time: </label>
    <div class="col-sm-8">    
    <input type="text" class='form-control' name="activityTime_start_edit" value="<?php                 if(isset($_POST['activityTime_start_edit'])){
                    echo $_POST['activityTime_start_edit'];
                } else if (isset($activity['time_start'])){
                    echo $activity['time_start'];
                }
 ?>">
        </div>    
    </div>    
    <br>

    <div class="form-group">
    <label for="activityTime_end_edit" class="col-sm-3 control-label">End Time: </label>
    <div class="col-sm-8">    
    <input type="text" class='form-control' name="activityTime_end_edit" value="<?php                 if(isset($_POST['activityTime_end_edit'])){
                    echo $_POST['activityTime_end_edit'];
                } else if (isset($activity['time_end'])){
                    echo $activity['time_end'];
                }
 ?>">
        </div>    
    </div>    
    <br>

    <div class="form-group">
    <label for="activityLocation_edit" class="col-sm-3 control-label">Location: </label>
    <div class="col-sm-8">    
    <input type="text" class='form-control' name="activityLocation_edit" value="<?php                if(isset($_POST['activityLocation_edit'])){
                    echo $_POST['activityLocation_edit'];
                } else if (isset($activity['location'])){
                    echo $activity['location'];
                }
 ?>">
    <?php
        if(isset($_POST['activityLocation_edit'])){
            $activityLocationMaxValidation = new Validation();
            $activityLocationMaxValidation->setInput($_POST['activityLocation_edit']);
            $activityLocationMaxValidation->validateMaxLength(50);
            $activityLocationMaxFlag = $activityLocationMaxValidation->getFlag();            
            if($activityLocationMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $activityLocationMaxValidation->message . "</span>"; }
        }
    ?>
        </div>    
    </div>    
    <br>

    <div class="form-group">
    <label for="date_edit" class="col-sm-3 control-label">Date: </label>
    <div class="col-sm-8">    
    <input type="text" class='form-control' name="date_edit" value="<?php                 if(isset($_POST['date_edit'])){
                    echo $_POST['date_edit'];
                } else if (isset($activity['date'])){
                    echo $activity['date'];
                }
        ?>">
    <?php
        if(isset($_POST['date_edit'])){
            $activityDateEmptyValidation = new Validation();
            $activityDateEmptyValidation->setInput($_POST['date_edit']);
            $activityDateEmptyValidation->validateEmpty();
            $activityDateEmptyFlag = $activityDateEmptyValidation->getFlag();

            $activityDateDateValidation = new Validation();
            $activityDateDateValidation->setInput($_POST['date_edit']);
            $activityDateDateValidation->validateDate();
            $activityDateDateFlag = $activityDateDateValidation->getFlag();
            if ($activityDateEmptyFlag == true) { echo "<br>" . "<span class='alert-danger'>" . $activityDateEmptyValidation->message . "</span>"; }
            if ($activityDateDateFlag == true) { echo "<br>" . "<span class='alert-danger'>" . $activityDateDateValidation->message . "</span>"; }
        }
    ?>
        </div>    
    </div>    
    <br>
    
    
    <input type="hidden" name="activityIdToSend"  value="<?php                 if(isset($_POST['activityIdToSend'])){
                    echo $_POST['activityIdToSend'];
                } else {
                    echo $_GET['activityIdForEdit'];
                }
        ?>">
    
    <input type="hidden" name="vacation_id"  value="<?php                 if(isset($_POST['vacation_id'])){
                    echo $_POST['vacation_id'];
                } else {
                    echo $activity['vacation_id'];
                }
        ?>">
    <div class='text-center'>
    <input type="submit" name="saveActivity" value="Edit Activity" class="btn btn-success">
    </div>    
</form>

<?php
if(isset($_POST['saveActivity'])) {
        if($activityNameEmptyFlag == false && $activityNameMaxFlag == false && $activityDescriptionMaxFlag == false && $activityLocationMaxFlag == false && $activityDateEmptyFlag == false && $activityDateDateFlag == false) {
            $activitesObj->editItineraryItem($db, $_POST['activityName_edit'], $_POST['activityDescription_edit'], $_POST['activityNotes_edit'], $_POST['activityTime_start_edit'], $_POST['activityTime_end_edit'], $_POST['activityLocation_edit'], $_POST['date_edit'], $_POST['activityIdToSend']);
                $message = "Activity edited";
                echo alertMsg($message, 'success');
            
        } else if ($activityNameEmptyFlag == true || $activityNameMaxFlag == true || $activityDescriptionMaxFlag == true || $activityLocationMaxFlag == true || $activityDateEmptyFlag == true || $activityDateDateFlag == true) {
                $message = "Your activity was not edited as it contains invalid data";
                echo alertMsg($message, 'danger');
        }
    }
?>

<form  method="post" action="vacation_details.php?vacationId=<?php 
                             
                             if(isset($activity['vacation_id'] )) {
                                 echo $activity['vacation_id'];
                             } else if (isset($_POST['vacation_id'])){
                                 echo $_POST['vacation_id'];
                             }
                             
                             ?>&details=View+Details+%26+Edit">
    <input type="submit" value="Back to Vacation" class="btn btn-default">
</form>
</div>
<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>