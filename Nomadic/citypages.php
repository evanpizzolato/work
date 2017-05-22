<?php
// Put the title for your the page here
$page_title = "City Pages";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();
//  Put the code for your feature between the php tags
?>

<?php 
//$myDb = new DbConnect();
//$pdoconn =$myDb->getDb();

if(isset($_POST['delete'])) {
    $message = "Tip deleted";
    echo alertMsg($message, 'danger');
}

$destinationObj = new Destination();
$destination = $destinationObj->getDestination($db, (isset($_GET['search']))?$_GET['search']:"");


$searches = $destinationObj->getDestinations($db);

if (isset($_GET['search'])){
$userDestSelection = $_GET['search'];
}

$tipsObj = new Tips();

if (isset($_GET['submit'])) {
        
    
    $tips = $tipsObj->getTipsByCity($db, $destination['id']);
    
    //print_r($tips);
}

if (!isset($_SESSION["user"])) {
    //sorry you need to log in.
    echo "<h1>Sorry you need to login!</h1>";
    echo "<a href='home.php' class='btn btn-info'>Go to Home</a>";
    session_destroy();
}


?>
<div class="jumbotron text-center">
    <div class='cityImgs'>
    <?php
    if (!isset($_GET['submit']) || $_GET['search'] == "select") {
        echo "<img alt='City Pages Icon' src='media/feature-icons/Cities.svg' height='400'>";
    } else if (isset($_GET['submit']) & $_GET['search'] == "Tulum") {
        include "includes/citypages_tulum_photos.php";
    } else if (isset($_GET['submit']) & $_GET['search'] == "Bangkok") {
        include "includes/citypages_bangkok_photos.php";
    } else if (isset($_GET['submit']) & $_GET['search'] == "Budapest") {
        include "includes/citypages_budapest_photos.php";
    }
    ?>
    </div>
    
        <form method="get">
            <select name="search" id="search" class="cityDropdown text-center">
              <option selected="selected" value='select'>Choose a city</option>
              <?php
                foreach($searches as $search) { ?>
                  <option value="<?= $search['city'] ?>" <?php 
                    
                    if (isset($userDestSelection)) {
                    if($search['city'] == $userDestSelection){echo "selected=selected";}}?>  ><?= $search['city'] 
                      ?>
                
                
                </option>
              <?php
                } ?>
            </select>             
            <input type="submit" name="submit" value="Go" class="btn btn-success">
        </form>

        <div class="output">
            <?php
            if (isset($_GET['submit']) && $_GET['search'] !== "select") {
                
            echo "<h1 class='title'>" . $destination['city'] . "</h1>" ;
                
            echo "<ul class='list-group cityList'>". "<li class='list-group-item citySubtitle'>" . $destination['state'] . ", " . $destination['country'] . "</li>";
            echo "<li class='list-group-item'>" . "<span class='citySubtitle'>" . "Population: " . "</span>" . $destination['population'] . "</li>";
            echo "<li class='list-group-item'>" . "<span class='citySubtitle'>" . "Languages spoken: " . "</span>". $destination['languages'] . "</li>";
            echo "<li class='list-group-item'>" . "<span class='citySubtitle'>" . "Climate: " . "</span>". $destination['climate'] . "</li>";
            echo "<li class='list-group-item'>" .  "<span class='citySubtitle'>" . "Advisory: " . "</span>";
            
            if ($destination['advisory'] == 0) {
                echo "No advisory"  . "</li>". "</ul>";
            } else if  ($destination['advisory'] == 1){
                echo "Advisory warning in place"  . "</li>". "</ul>";
            }
    
            }
            
            ?>
                <?php 
                if (isset($tips) && $_GET['search'] !== "select") {
                    echo "<h2 class='title'>Tips for travelling in " .  $_GET['search'] . "</h2>";          

                foreach ($tips as $tip) : ?>
                                
                
                    <div>
                        
                        <?php 
                        echo "<div class='tip'>" . "<div class='tipContent'>";
                        if (file_exists('media/user-profile/' . $tip['users_id'] . "-avatar.jpg")) {
                            echo "<span class='pull-left tipIcon'>" . "<img src='media/user-profile/" . $tip['users_id'] . "-avatar.jpg' width='50' class='img-circle'>" . "</span>";
                        } else {
                            echo "<span class='pull-left tipIcon'>" . "<img src='media/user-profile/default-avatar.jpg' width='50' class='img-circle'>" . "</span>";
                        }
                        echo "<div class='tipText'>". "<span class='citySubtitle'>" . $tip['username'] . "</span>" . " says: " . $tip['content']; 
                     

                        echo "<br>" . "<span class='citySubtitle'>" . " Submitted on " . "</span>" . $tip['date_added'];

                        if (isset($tip['date_edited'])) {echo  " | " . "<span class='citySubtitle'>" . "Edited on: " . "</span>" . $tip['date_edited'];}
                           if ($_SESSION['user']['id'] == $tip['users_id'] || $_SESSION["user"]["class"] == "1") {
                                include "includes/citypages_dash.php";
                            }
                        echo "</div>". "</div>" . "</div>";
                                                    
                        ?>

                        
                    </div>
                <?php endforeach;} ?>
            
           <?php
                if(isset($_POST['delete'])) {
                    $tipIdDelete = $_POST['tipIdDelete'];
                    $tipsObj->deleteTip($db, $tipIdDelete);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            ?>
            
        </div>
<?php
    if(isset($_GET['submit']) && $_GET['search'] !== "select") {
        include "includes/citypages_adddash.php";    
    }
?>
    
<?php
    if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] == "1") {
        echo  "<form action='citypages_admin.php'>". "<input type='submit' value='Go to Admin' class='btn btn-default pull-left'>" . "</form>";
    }
?>
    
</div>


<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>