<?php
// Put the title for your the page here
$page_title = "Vacation Details";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags
if (isset($_POST['destinations_id_edit'])){
$userDestSelection = $_POST['destinations_id_edit'];
}

$vacationObj = new Vacation();

$activitiesObj = new ItineraryItems();

if(isset($_GET['vacationId'])){
    $vacation = $vacationObj->getVacationById($db, $_GET['vacationId']);
    $activities = $activitiesObj->getItineraryItemsByVacation($db, $_GET['vacationId']);
} else if (isset($_POST['vacationIdToSend'])) {
    $vacation = $vacationObj->getVacationById($db, $_POST['vacationIdToSend']);
    $activities = $activitiesObj->getItineraryItemsByVacation($db, $_POST['vacationIdToSend']);
}

if ($vacation['users_id'] !== $_SESSION['user']['id']) {
    redirect("permission.php");
}
    $destinationObj = new Destination();
    $destinations = $destinationObj->getDestinations($db);

if(isset($_POST['addActivity'])) {
    if(isset($activityNameEmptyFlag) && $activityNameEmptyFlag == false && isset($activityNameMaxFlag) && $activityNameMaxFlag == false && isset($activityDescriptionMaxFlag) && $activityDescriptionMaxFlag == false && isset($activityLocationMaxFlag) && $activityLocationMaxFlag == false && isset($activityDateEmptyFlag) && $activityDateEmptyFlag == false && isset($activityDateDateFlag) && $activityDateDateFlag == false) {
        $message = "Activity edited";
        echo alertMsg($message, 'success');
    }
}

?>
<div class="jumbotron">

<div class='col-sm-6'>  
    <?php 
        if(isset($_POST['name_edit'])){
            echo "<h2 class='text-center'>" . $_POST['name_edit'] . "</h2>";
        } else if (isset($vacation['name'])) {
            echo "<h2 class='text-center'>" . $vacation['name'] . "</h2>";
        }
    ?>

             <?php 
                if(isset($_POST['length_edit'])){
                    echo  "<ul class='list-group'>" . "<li class='list-group-item'>" . $_POST['length_edit'] . " days long" . "</li>";
                } else if (isset($vacation['length'])) {
                    echo "<li class='list-group-item'>" . $vacation['length'] . " days long" . "</li>";
                }
            ?>               
             <?php 
                if(isset($_POST['date_start_edit'])){
                    echo "<li class='list-group-item'>" .  "Starts on: ". $_POST['date_start_edit']. "</li>";
                } else if (isset($vacation['date_start'])){
                    echo "<li class='list-group-item'>" . "Starts on: " . $vacation['date_start']. "</li>";
                }
            ?>               
             <?php 
                if(isset($_POST['date_end_edit'])){
                    echo "<li class='list-group-item'>".  "Ends on: " . $_POST['date_end_edit']. "</li>";
                } else if (isset($vacation['date_end'])){
                    echo "<li class='list-group-item'>" .  "Ends on: ".$vacation['date_end']. "</li>";
                }
            ?>               
             <?php 
    
                if(isset($_POST['destinations_id_edit']) && $_POST['destinations_id_edit'] == 1) {
                    echo "<li class='list-group-item'>" . "Tulum". "</li>";
                } else if(isset($_POST['destinations_id_edit']) && $_POST['destinations_id_edit'] == 2) {
                    echo "<li class='list-group-item'>" . "Bangkok". "</li>";
                } else if(isset($_POST['destinations_id_edit']) && $_POST['destinations_id_edit'] == 3) {
                    echo "<li class='list-group-item'>" . "Budapest". "</li>";
                } else if (isset($vacation['destinations_id'])) {
                    echo "<li class='list-group-item'>" . $vacation['city']. "</li>" . "</ul>";
                }
            ?>               
</div>  
    
    
<div class='col-sm-6'>    
    <?php 
        if(isset($_POST['name_edit'])){
            echo "<h2 class='text-center'>" . "Edit " . $_POST['name_edit'] . "</h2>";
        } else if (isset($vacation['name'])) {
            echo "<h2 class='text-center'>" . "Edit " .  $vacation['name'] . "</h2>";
        }
    ?>
<form class="form-horizontal" method="post" action="vacation_details.php?vacationId=<?php
                            
                            if(isset($_GET['vacationId'])){
        echo $_GET['vacationId'];
    } else if(isset($vacation['id'])) {
        echo $vacation['id'];
    } else {
        echo $_POST['vacationIdToSendForVacation'];

}
                            ?>&details=View+Details+%26+Edit">
    
    <div class="form-group">
    <label for="name_edit" class="col-sm-3 control-label">Name:</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="name_edit" value="<?php 
                                                         
                if(isset($_POST['name_edit'])){
                    echo $_POST['name_edit'];
                } else if(isset($vacation['name'])) {
                    echo $vacation['name'];
                }
               ?>"/>
    
    <?php if(isset($_POST['name_edit'])) {
            $vacationNameEmptyValidation = new Validation();
            $vacationNameEmptyValidation->setInput($_POST['name_edit']);
            $vacationNameEmptyValidation->validateEmpty();
            $vacationNameEmptyFlag=$vacationNameEmptyValidation->getFlag();

            $vacationNameMaxValidation = new Validation();
            $vacationNameMaxValidation->setInput($_POST['name_edit']);
            $vacationNameMaxValidation->validateMaxLength(50);
            $vacationNameMaxFlag=$vacationNameMaxValidation->getFlag();
    
            if($vacationNameEmptyFlag == true ){ echo "<br>" . "<span class='alert-danger'>" . $vacationNameEmptyValidation->message . "</span>"; }
            if($vacationNameMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationNameMaxValidation->message . "</span>"; }
    }
    ?>
        </div>    
    </div>    
    <br >
    
    <div class="form-group">
    <label for="length_edit" class="col-sm-3 control-label"># of Days:</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="length_edit" value="<?php 
                                                         
                if(isset($_POST['length_edit'])){
                    echo $_POST['length_edit'];
                } else if(isset($vacation['length'])){
                    echo $vacation['length'];
                }
                                               ?>"/>
    <?php if(isset($_POST['length_edit'])) {
        $vacationLengthEmptyValidation = new Validation();
        $vacationLengthEmptyValidation->setInput($_POST['length_edit']);
        $vacationLengthEmptyValidation->validateEmpty();
        $vacationLengthEmptyFlag=$vacationLengthEmptyValidation->getFlag();

        $vacationLengthIntegerValidation = new Validation();
        $vacationLengthIntegerValidation->setInput($_POST['length_edit']);
        $vacationLengthIntegerValidation->validateInteger();
        $vacationLengthIntegerFlag = $vacationLengthIntegerValidation->getFlag();
        if($vacationLengthEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationLengthEmptyValidation->message . "</span>"; }
        if($vacationLengthIntegerFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationLengthIntegerValidation->message . "</span>"; }    
    }
    ?>
        </div>
    </div>    
    <br >

    <div class="form-group">
    <label for="date_start_edit" class="col-sm-3 control-label">Date Start:</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="date_start_edit" value="<?php 
                                                         
                if(isset($_POST['date_start_edit'])){
                    echo $_POST['date_start_edit'];
                } else if(isset($vacation['date_start'])) {
                    echo $vacation['date_start'];
                }
                                               ?>"/>
    
    <?php if (isset($_POST['date_start_edit'])) {
        $vacationDateStartEmptyValidation = new Validation();
        $vacationDateStartEmptyValidation->setInput($_POST['date_start_edit']);
        $vacationDateStartEmptyValidation->validateEmpty();
        $vacationDateStartEmptyFlag=$vacationDateStartEmptyValidation->getFlag();

        $vacationDateStartDateValidation = new Validation();
        $vacationDateStartDateValidation->setInput($_POST['date_start_edit']);
        $vacationDateStartDateValidation->validateDate();
        $vacationDateStartDateFlag=$vacationDateStartDateValidation->getFlag();
        if($vacationDateStartEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateStartEmptyValidation->message . "</span>"; }
        if($vacationDateStartDateFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateStartDateValidation->message . "</span>"; }    
    }
    ?>
    </div>
    </div>    
    <br >
    
    <div class="form-group">
    <label for="date_end_edit" class="col-sm-3 control-label">Date End:</label>
    <div class="col-sm-8">
    <input class='form-control' type="text" name="date_end_edit" value="<?php 
                                                         
                if(isset($_POST['date_end_edit'])){
                    echo $_POST['date_end_edit'];
                } else if(isset($vacation['date_end'])) {
                    echo $vacation['date_end'];
                }
                                               ?>"/>
    <?php
    if (isset($_POST['date_end_edit'])) {
        $vacationDateEndEmptyValidation = new Validation();
        $vacationDateEndEmptyValidation->setInput($_POST['date_end_edit']);
        $vacationDateEndEmptyValidation->validateEmpty();
        $vacationDateEndEmptyFlag=$vacationDateEndEmptyValidation->getFlag();

        $vacationDateEndDateValidation = new Validation();
        $vacationDateEndDateValidation->setInput($_POST['date_end_edit']);
        $vacationDateEndDateValidation->validateDate();
        $vacationDateEndDateFlag=$vacationDateEndDateValidation->getFlag();
        if($vacationDateEndEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateEndEmptyValidation->message . "</span>"; }
        if($vacationDateEndDateFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateEndDateValidation->message . "</span>"; }        
    }
    ?>
    </div>            
    </div>    
    <br >
    
    
    <div class="form-group">
    <label for="destinations_id_edit" class="col-sm-3 control-label">Destinations:</label>
    <div class="col-sm-8">   
    <select name="destinations_id_edit" class='form-control'>
          <?php

            if (isset($destinations)){
            foreach($destinations as $destination) { ?>
              <option value="<?= $destination['id'] ?>"     <?php 
    
                if(isset($_POST['edit_vacation']) && $userDestSelection == $destination['id']) {
                    echo "selected=selected";
                } else if ($vacation['destinations_id'] == $destination['id']) {echo "selected=selected";} 
                
                
    ?>
><?= $destination['city'] ?></option>
          <?php
            }} ?>
    </select>        
        
    <?php
    if (isset($_POST['destinations_id_edit'])) {
        $vacationDestinationEmptyValidation = new Validation();
        $vacationDestinationEmptyValidation->setInput($_POST['destinations_id_edit']);
        $vacationDestinationEmptyValidation->validateEmpty();  $vacationDestinationEmptyFlag=$vacationDestinationEmptyValidation->getFlag();
        
        if($vacationDestinationEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDestinationEmptyValidation->message . "</span>"; }
    }
    ?>
        </div>    
    </div>    
    <br >
    
            <input type="hidden" name="vacationIdToSendForVacation" value="<?php if(isset($_GET['vacationId'])){
                    echo $_GET['vacationId'];
                } else if(isset($vacation['id'])) {
                    echo $vacation['id'];
                } else {
                    echo $_POST['vacationIdToSendForVacation'];

                } ?>"/>
    <div class='text-center'>
            <input type="submit" value="Save Vacation" name="edit_vacation" class="btn btn-success"/>
    </div>
</form>
</div>    
    
    
    
<h2 class='text-center'>Activities</h2>

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

    <?php if (isset($activities)){foreach ($activities as $activity) : ?>
    <tr>
        <td><?php echo $activity['name']; ?></td>        
        <td><?php echo $activity['description']; ?></td>        
        <td><?php echo $activity['notes']; ?></td>        
        <td><?php echo $activity['time_start']; ?></td>        
        <td><?php echo $activity['time_end']; ?></td>        
        <td><?php echo $activity['location']; ?></td>        
        <td><?php echo $activity['date']; ?></td>
        <td>
            <form style="display:inline;" method="get" action="activity_edit.php">
                <input type="hidden" name="activityIdForEdit" value="<?php echo $activity['id']; ?>"/>                           
                
                    <button type="submit" name="editActivity" class='adminBtn'data-toggle='tooltip' data-placement='top' title='Edit/Details'><a><span class="glyphicon glyphicon-pencil" ></span></a></button>
            </form>
        </td>
        <td>
            <form style="display:inline;" method="post">
                <input type="hidden" name="activityIdForDelete" value="<?php echo $activity['id']; ?>" />
                <button type="submit" name="delete" class='adminBtn' data-toggle='tooltip' data-placement='top' title='Delete'><a><span class="glyphicon glyphicon-remove" ></span></a></button>
            </form>
        </td>
    </tr>    
<?php endforeach;} ?>

</table>

<?php
    if(isset($_POST['delete'])) {
        $activityIdDelete = $_POST['activityIdForDelete'];
        $activitiesObj->deleteItineraryItem($db, $activityIdDelete);
        
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
    
    
    
    
    




<h2 class='text-center'>Add Activity</h2>

<form class="form-horizontal" method="post" action="vacation_details.php?vacationId=<?php
                            if(isset($_GET['vacationId'])){
        echo $_GET['vacationId'];
    } else if(isset($vacation['id'])) {
        echo $vacation['id'];
    } else {
        echo $_POST['vacationIdToSendForVacation'];
}
                            ?>&details=View+Details+%26+Edit">
    <div class="form-group">
    <label for="activityName" class="col-sm-3 control-label">Name:</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="activityName">
    <?php if (isset($_POST['activityName'])) {
        $activityNameEmptyValidation = new Validation();
        $activityNameEmptyValidation->setInput($_POST['activityName']);
        $activityNameEmptyValidation->validateEmpty();
        $activityNameEmptyFlag = $activityNameEmptyValidation->getFlag();
        
        $activityNameMaxValidation = new Validation();
        $activityNameMaxValidation->setInput($_POST['activityName']);
        $activityNameMaxValidation->validateMaxLength(75);
        $activityNameMaxFlag = $activityNameMaxValidation->getFlag();
        if($activityNameEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $activityNameEmptyValidation->message . "</span>"; } 
        if($activityNameMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $activityNameMaxValidation->message . "</span>"; }     
    }
    ?>
        </div>    
    </div>
    <br>
    
    <div class="form-group">
    <label for="activityDescription" class="col-sm-3 control-label">Description:</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="activityDescription">
    <?php
    if (isset($_POST['activityDescription'])) {
        $activityDescriptionMaxValidation = new Validation();
        $activityDescriptionMaxValidation->setInput($_POST['activityDescription']);
        $activityDescriptionMaxValidation->validateMaxLength(200);
        $activityDescriptionMaxFlag = $activityDescriptionMaxValidation->getFlag();
        if($activityDescriptionMaxFlag == true){ echo "<br>" ."<span class='alert-danger'>" . $activityDescriptionMaxValidation->message . "</span>"; }
    }
    ?>
        </div>    
    </div>    
    <br>
    
    <div class="form-group">
    <label for="activityNotes" class="col-sm-3 control-label">Notes</label>
    <div class="col-sm-8">    
    <textarea class='form-control' name="activityNotes"></textarea>
        </div>    
    </div>    
    <br>
    
    <div class="form-group">
    <label for="activityTime_start" class="col-sm-3 control-label">Time Start</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="activityTime_start">
        </div>    
    </div>    
    <br>
    
    <div class="form-group">
    <label for="activityTime_end" class="col-sm-3 control-label">Time End</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="activityTime_end">
        </div>    
    </div>    
    <br>    
    
    <div class="form-group">
    <label for="activityLocation" class="col-sm-3 control-label">Location</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="activityLocation">
    <?php
    if (isset($_POST['activityLocation'])) {
        $activityLocationMaxValidation = new Validation();
        $activityLocationMaxValidation->setInput($_POST['activityLocation']);
        $activityLocationMaxValidation->validateMaxLength(50);
        $activityLocationMaxFlag = $activityLocationMaxValidation->getFlag();   if($activityLocationMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $activityLocationMaxValidation->message . "</span>"; }     
    }
    ?>
        </div>    
    </div>    
    <br>    
    
    <div class="form-group">
    <label for="activityDate" class="col-sm-3 control-label">Date</label>
    <div class="col-sm-8">    
    <input class='form-control' type="text" name="activityDate">
    <?php
    if (isset($_POST['activityDate'])) {
        $activityDateEmptyValidation = new Validation();
        $activityDateEmptyValidation->setInput($_POST['activityDate']);
        $activityDateEmptyValidation->validateEmpty();
        $activityDateEmptyFlag = $activityDateEmptyValidation->getFlag();
        
        $activityDateDateValidation = new Validation();
        $activityDateDateValidation->setInput($_POST['activityDate']);
        $activityDateDateValidation->validateDate();
        $activityDateDateFlag = $activityDateDateValidation->getFlag();    
        if ($activityDateEmptyFlag == true) { echo "<br>" . "<span class='alert-danger'>" . $activityDateEmptyValidation->message . "</span>"; } 
        if ($activityDateDateFlag == true) { echo "<br>" . "<span class='alert-danger'>" . $activityDateDateValidation->message . "</span>"; }        
    }
    ?>
        </div>    
    </div>    
    <br>
    
    <input type="hidden" name="vacationIdToSendForActivity" value="<?php if(isset($_GET['vacationId'])){
        echo $_GET['vacationId'];
    } else if(isset($vacation['id'])) {
        echo $vacation['id'];
    } else {
        echo $_POST['vacationIdToSendForActivity'];
    } ?>"/>
    <div class='text-center'>
    <input type="submit" name="addActivity" value="Add Activity" class="btn btn-success">
    </div>    
</form>



<form action="my_vacations.php">
    <input type="submit" value="Back to List" class="btn btn-default">
</form>
<?php

    if(isset($_POST['edit_vacation'])) {
        if($vacationNameEmptyFlag == false && $vacationNameMaxFlag == false && $vacationLengthEmptyFlag == false && $vacationLengthIntegerFlag == false && $vacationDateStartEmptyFlag == false && $vacationDateStartDateFlag == false && $vacationDateEndEmptyFlag == false && $vacationDateEndDateFlag == false && $vacationDestinationEmptyFlag == false) {

            $vacationObj->editVacation($db, $_POST['length_edit'], $_POST['name_edit'], $_POST['date_start_edit'], $_POST['date_end_edit'], $_POST['destinations_id_edit'], $_POST['vacationIdToSendForVacation']);

            $message = "Vacation edited";
            echo alertMsg($message, 'success');

        } else if ($vacationNameEmptyFlag == true || $vacationNameMaxFlag == true || $vacationLengthEmptyFlag == true || $vacationLengthIntegerFlag == true || $vacationDateStartEmptyFlag == true || $vacationDateStartDateFlag == true || $vacationDateEndEmptyFlag == true || $vacationDateEndDateFlag == true || $vacationDestinationEmptyFlag == true) {
            $message = "Your vacation was not edited as it contains invalid data";
            echo alertMsg($message, 'danger');
        }
    }

    if(isset($_POST['addActivity'])) {
        
        if($activityNameEmptyFlag == false && $activityNameMaxFlag == false && $activityDescriptionMaxFlag == false && $activityLocationMaxFlag == false && $activityDateEmptyFlag == false && $activityDateDateFlag == false) {
            $activitiesObj->newItineraryItem($db, $_POST['activityName'], $_POST['activityDescription'], $_POST['activityNotes'], $_POST['activityTime_start'], $_POST['activityTime_end'], $_POST['activityLocation'], $_POST['activityDate'], $_POST['vacationIdToSendForActivity']);
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            $message = "Your activity was not submitted as it contains invalid data";
            echo alertMsg($message, 'danger');
        }

    }
?>

</div>

<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>