<?php
// Put the title for your the page here
$page_title = "My Vacations";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags 

//$myDb = new Database();
//$pdoconn = $myDb->getDatabase();

$vacationObj = new Vacation();


?>
<div class="jumbotron">
<h2 class='text-center'><?php echo $_SESSION['user']['username'] . "'s "?>Vacations</h2>
<table class="table table-hover">
    <tr>
        <th>Vacation Name</th>
        <th># of Days Long</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Destination</th>
    </tr>
    
<?php 
    $vacations = $vacationObj->getVacationsByUser($db, $_SESSION['user']['id']);
    
    //var_dump ($vacations);
    
    
    foreach ($vacations as $vacation) : ?>
    <tr>
        <td><?php echo $vacation['name']; ?></td>        
        <td><?php echo $vacation['length']; ?></td>
        <td><?php echo $vacation['date_start']; ?></td>        
        <td><?php echo $vacation['date_end']; ?></td> 
        <td><?php echo $vacation['city']; ?></td>         
        <td>
            <form style="display:inline;" method="get" action="vacation_details.php">
                <input type="hidden" name="vacationId" value="<?php echo $vacation['id']; ?>"/>                            
                    <button type="submit" name="details" class='adminBtn'data-toggle='tooltip' data-placement='top' title='Edit/Details'><a><span class="glyphicon glyphicon-pencil" ></span></a></button>
            </form>

            <form style="display:inline;" method="post">
                <input type="hidden" name="vacationIdForDelete" value="<?php echo $vacation['id']; ?>" />
                <button type="submit" name="delete" class='adminBtn' data-toggle='tooltip' data-placement='top' title='Delete'><a><span class="glyphicon glyphicon-remove" ></span></a></button>
            </form>
        </td>
    </tr>    
<?php endforeach; ?>
</table>

<?php
    if(isset($_POST['delete'])) {
        $vacationIdDelete = $_POST['vacationIdForDelete'];
        $vacationObj->deleteVacation($db, $vacationIdDelete);
        
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>

<form action="create_vacation.php" method="post" class='text-center'>
    <input type="submit" name="goToVacationCreate" value="Create a Vacation" class="btn btn-success">
</form>
</div>

<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>