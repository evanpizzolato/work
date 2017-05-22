<?php
// Put the title for your the page here
$page_title = "Create a Vacation";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags

    //$myDb = new Database();
    //$pdoconn = $myDb->getDatabase();

    $vacationObj = new Vacation();

    $destinationObj = new Destination();
    $destinations = $destinationObj->getDestinations($db);


?>
<div class="jumbotron">
    <h2 class='text-center'>Create a Vacation</h2>

    <form name="createVacation" method="post" class="form-horizontal">
        <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Name:</label>
        <div class="col-sm-8">    
        <input type="text" name="name" class='form-control'>
        <?php
            if (isset($_POST['name'])) {
                $vacationNameEmptyValidation = new Validation();
                $vacationNameEmptyValidation->setInput($_POST['name']);
                $vacationNameEmptyValidation->validateEmpty();
                $vacationNameEmptyFlag=$vacationNameEmptyValidation->getFlag();

                $vacationNameMaxValidation = new Validation();
                $vacationNameMaxValidation->setInput($_POST['name']);
                $vacationNameMaxValidation->validateMaxLength(50);
                $vacationNameMaxFlag=$vacationNameMaxValidation->getFlag();
                if($vacationNameEmptyFlag == true ){ echo "<br>" . "<span class='alert-danger'>" . $vacationNameEmptyValidation->message . "</span>"; }
                if($vacationNameMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationNameMaxValidation->message . "</span>"; }
            }
        ?>
            </div>
        </div>

        <div class="form-group">
        <label for="length" class="col-sm-3 control-label"># of Days Long</label>
        <div class="col-sm-8">    
        <input type="text" name="length" class='form-control'>
        <?php
            if (isset($_POST['length'])) {
                $vacationLengthEmptyValidation = new Validation();
                $vacationLengthEmptyValidation->setInput($_POST['length']);
                $vacationLengthEmptyValidation->validateEmpty();
                $vacationLengthEmptyFlag=$vacationLengthEmptyValidation->getFlag();

                $vacationLengthIntegerValidation = new Validation();
                $vacationLengthIntegerValidation->setInput($_POST['length']);
                $vacationLengthIntegerValidation->validateInteger();
                $vacationLengthIntegerFlag = $vacationLengthIntegerValidation->getFlag();
                if($vacationLengthEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationLengthEmptyValidation->message . "</span>"; }
                if($vacationLengthIntegerFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationLengthIntegerValidation->message . "</span>"; }
            }
        ?>
            </div>
        </div>

        <div class="form-group">
        <label for="dateStart" class="col-sm-3 control-label">Start Date</label>
        <div class="col-sm-8">    
        <input type="text" name="dateStart" class='form-control'>
        <?php
            if (isset($_POST['dateStart'])) {
                $vacationDateStartEmptyValidation = new Validation();
                $vacationDateStartEmptyValidation->setInput($_POST['dateStart']);
                $vacationDateStartEmptyValidation->validateEmpty();
                $vacationDateStartEmptyFlag=$vacationDateStartEmptyValidation->getFlag();

                $vacationDateStartDateValidation = new Validation();
                $vacationDateStartDateValidation->setInput($_POST['dateStart']);
                $vacationDateStartDateValidation->validateDate();
                $vacationDateStartDateFlag=$vacationDateStartDateValidation->getFlag();
                if($vacationDateStartEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateStartEmptyValidation->message . "</span>"; }
                if($vacationDateStartDateFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateStartDateValidation->message . "</span>"; }
            }
        ?>
            </div>
        </div>
        
        <div class="form-group">
        <label for="dateEnd" class="col-sm-3 control-label">End Date</label>
        <div class="col-sm-8">    
        <input type="text" name="dateEnd" class='form-control'>
        <?php
            if (isset($_POST['dateStart'])) {
                $vacationDateEndEmptyValidation = new Validation();
                $vacationDateEndEmptyValidation->setInput($_POST['dateEnd']);
                $vacationDateEndEmptyValidation->validateEmpty();
                $vacationDateEndEmptyFlag=$vacationDateEndEmptyValidation->getFlag();

                $vacationDateEndDateValidation = new Validation();
                $vacationDateEndDateValidation->setInput($_POST['dateEnd']);
                $vacationDateEndDateValidation->validateDate();
                $vacationDateEndDateFlag=$vacationDateEndDateValidation->getFlag();
                if($vacationDateEndEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateEndEmptyValidation->message . "</span>"; }
                if($vacationDateEndDateFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDateEndDateValidation->message . "</span>"; }
            }
        ?>
            </div>
        </div>


        <div class="form-group">
        <label for="destination" class="col-sm-3 control-label">Destination</label>
        <div class="col-sm-8">    
        <select name="destination" class='form-control'>
              <?php

                if (isset($destinations)){
                foreach($destinations as $destination) { ?>
                  <option value="<?= $destination['id'] ?>"><?= $destination['city'] ?></option>
              <?php
                }} ?>
        </select>
        <?php if (isset($_POST['destination'])) {
            $vacationDestinationEmptyValidation = new Validation();
            $vacationDestinationEmptyValidation->setInput($_POST['destination']);
            $vacationDestinationEmptyValidation->validateEmpty();
            $vacationDestinationEmptyFlag=$vacationDestinationEmptyValidation->getFlag();
            if($vacationDestinationEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $vacationDestinationEmptyValidation->message . "</span>"; }

        }
        ?>
            </div>
        </div>
        <br>
        <div class='text-center'>
        <input type="submit" name="createVacation" value="Create Vacation" class="btn btn-success">
        </div>    
    </form>

    <form action="my_vacations.php" method="post">
        <input type="submit" name="toVacations" value="Back to My Vacations" class="btn btn-default">
    </form>
    <?php
        if(isset($_POST['createVacation'])){

                        if($vacationNameEmptyFlag == false && $vacationNameMaxFlag == false && $vacationLengthEmptyFlag == false && $vacationLengthIntegerFlag == false && $vacationDateStartEmptyFlag == false && $vacationDateStartDateFlag == false && $vacationDateEndEmptyFlag == false && $vacationDateEndDateFlag == false && $vacationDestinationEmptyFlag == false) {

                            $vacationObj->newVacation($db, $_POST['length'], $_POST['name'], $_POST['dateStart'], $_POST['dateEnd'], $_SESSION['user']['id'],$_POST['destination']);

                            $message = "Vacation added!";
                            echo alertMsg($message, 'success');

                        } else if ($vacationNameEmptyFlag == true || $vacationNameMaxFlag == true || $vacationLengthEmptyFlag == true || $vacationLengthIntegerFlag == true || $vacationDateStartEmptyFlag == true || $vacationDateStartDateFlag == true || $vacationDateEndEmptyFlag == true || $vacationDateEndDateFlag == true || $vacationDestinationEmptyFlag == true){
                            $message = "Your vacation was not submitted as it contains invalid data";
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