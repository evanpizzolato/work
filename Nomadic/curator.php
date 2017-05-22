<?php
// Put the title for your the page here
$page_title = "Curator";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags


//instantiate the Experience Class
$experienceObject = new Experience($db);


//instantiate the Activities Class
$activitiesObject = new Activities($db);

//Get all the Destinations for the radio buttons
$destinations = $locations->getDestination();

//Get all the Experiences for the drop down
$experiences = $experienceObject->getExperienceName();


?>
<div class="container-fluid">


<form action="curator.php" method="POST" class="form-horizontal jumbotron text-center">
    <div class="col-lg-12">
        <H1>Curate a Vacation</H1>
        <img class="curator__header_image" src="media/feature-icons/Curator.svg" alt="Curator Image"/>
    </div>

    <div class="form-group text-center">


        <label class="control-label col-sm-12" style="text-align: center">Choose a Destination</label>
    <?php

    foreach ($destinations as $destination) :
        echo "<label class='radio-inline'><input type='radio' name='destinations' value=\"".$destination["id"]. "\" >"
            . $destination["city"]  .", " .$destination["country"] .  "</input></label>";
    endforeach;
    ?>
    </div>

    <div class="form-group text-center">
    <label class="col-sm-3 control-label">Choose Your Experience</label>
        <div class="col-sm-8">
    <select class="form-control" name="experiences">
        <option value="">Choose</option>
        <?php
        foreach ($experiences as $experience) :

            echo "<option value='".$experience['id']."'>".$experience['name']."</option>";

        endforeach;
        ?>
    </select>
        </div>
    </div>

    <div class="form-group text-center">

            <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <label>How Many Nights</label><input class="form-control input-sm" type="number" min="1" name="nights" step="1">
        </div>
        <div class="col-sm-5"></div>
        </div>


    <div class="form-group text-center">
        <input class="btn btn-success btn-lg" type="submit" name="submit" value="Create Vacation" />
    </div>
    <div class="text-danger small">*ALL FIELDS REQUIRED*</div>

</form>
</div>
<div class="container-fluid">

<?php

//when the form submits do these actions
if(isset($_POST['submit'])) {

    $activities = $activitiesObject->getActivities(isset($_POST['destinations']) ? $_POST['destinations'] : null);

    //Validations
    if (empty($_POST['destinations'])) {
        echo '<div class="row text-center">
        <div class="col-sm-12">
            <span class="text-danger">Please Enter a Destination</span>
        </div>
    </div>';
    } elseif ($_POST['experiences'] == 0) {
        echo '<div class="row text-center">
        <div class="col-sm-12">
            <span class="text-danger">Please Choose Your Experience</span>
        </div>
    </div>';
    } elseif (empty($_POST['nights'])) {
        echo '<div class="row text-center">
        <div class="col-sm-12">
            <span class="text-danger">Please Enter How Many Nights</span>
        </div>
    </div>';
    } else {

        ////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////// DISPLAY RESULTS /////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////

        //Destination
        if ($_POST['destinations'] == 1)
            echo "<h2 class='text-center'>Get Ready for Beautiful Tulum, Mexico</h2>";

        if ($_POST['destinations'] == 2)
            echo "<h2 class='text-center'>Bangkok, Thailand Awaits You</h2>";

        if ($_POST['destinations'] == 3)
            echo "<h2 class='text-center'>Budapest, Hungary At Your Fingertips</h2>";

        $accomodations = $locations->getLocByType($_POST['destinations'], 2, $_POST['experiences']);


        echo "<h1>Where You'll Stay</h1>";
        //Hotel & Details
        foreach ($accomodations as $hotel) :
            echo "<div class='row'>";
            echo "<div class='col-lg-4'>
                <img class=\"img-responsive\" src='" . $hotel['filePath'] . "'/>
            </div>";
            echo "<div class='col-lg-8'>
                <h3>" . $hotel['name'] . "<br/></h3>
                <p class='text-justify'>" . $hotel['description'] . "</p>
            </div>
            </div>
            <div class='container-fluid>'";
            echo "<div class='row'>";
            echo "<div class='col-lg-6'>
                <h4>Contact: <a href='tel:" . $hotel['phone'] . "'>" . $hotel['phone'] . "</a></h4>
            </div>";
            echo "<div class='col-lg-6'>
                <h4>Website: <a href='" . $hotel['website'] . "'>" . $hotel['website'] . "</a></h4>
            </div>
            </div>";
            echo "</div>";
            echo "</div>";

            //Total cost per night
            echo "<div class='container-fluid'>
                    <div class='col-lg-12 curator__hotel_cost text-center'><h1>APPROX TOTAL $" . $_POST['nights'] * $hotel['cost'] . " ($" . $hotel['cost'] . "/night)" . "</h1></div>
                </div>";
        endforeach;

        //Activities
        echo "<div class='container-fluid'><h1>Activities</h1><div class='row'> ";


        foreach ($activities as $activity) :
            echo "<div class='col-sm-4'>
                            <img class='img-responsive img-thumbnail' src='" . $activity->filePath . "'/>
                    
                        <h3>" . $activity->name . "</h3>
                        <p>" . $activity->description . "</p>
                        <p>" . $activity->address . " " . "<a href='" . $activity->website . "'>MORE INFO</a> </p>
              </div>";

        endforeach;

?>

<?php



        echo "</div></div>";

    }
}//end of issetPOST
?>
</div>






<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?> 