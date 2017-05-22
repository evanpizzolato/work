<?php
// Put the title for your the page here
$page_title = "budget";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags
//call getCategories() method to display in dropdown list
$categories = $category->getCategories();
//Validate method

if(isset($_POST['add'])) {

    $date = $_POST['date'];
    $accName = $_POST['accname'];
    $balance = $_POST['balance'];
    $userId = $_POST['userid'];

    //create form erros flag var, set to false

    $formErrors = false;


    //date validation
    if(empty($date)) {

        $errDate = '<div class="text-danger text-center"> Please Select a date </div>';
        $formErrors = true;
    }

    //account name validation

    if(empty($accName)) {

        $errAccName = '<div class="text-danger text-center"> Please enter an account name </div>';
        $formErrors = true;

    }

    //balance validation

    if(empty($balance)) {

        $errBalance = '<div class="text-danger text-center"> Please enter a balance </div>';
        $formErrors = true;
    }

    //User Id validation

    if(empty($userId)) {

        $errUserId = '<div class="text-danger text-center"> Please enter your User Id </div>';
        $formErrors = true;
    }
    //Execution of Insert statement and Thanks Message dependent on $formErrors != true;

    if(!($formErrors)) {

        //call addAccount method and pass parameters

        $account->addAccount($date, $accName, $balance, $userId);


        $thanksMsg = "Thanks, account: " . '<b>' . $accName . '</b>' . " has been created.";

    }//end if(!($formErrors))

}//end if(isset($_POST['add]))


/***LIST BUDGETS STARTS HERE***/
$accounts = $account->getAccounts($_SESSION["user"]["id"]);

/****DELETE BUDGET STARTS HERE ****/
if(isset($_POST['delete'])) {
    $id = $_POST['accountId'];

    //call deleteAccount method
    $account->deleteAccount($id);
}
?>
<h1><a href="budget.php">Budget</a></h1> 

<div class="jumbotron">
    <h3>Create a Budget</h3>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
    <div class="form-group">
        <label for="date" class="col-sm-3 control-label">Date</label> 
        <div class="col-sm-8">
            <input type="date" name="date" id="date" class="form-control"/>
        </div>
    </div>

    <?php if(isset($errDate)) {echo $errDate;}?>
    <div class="form-group">        
        <label for="accname" class="col-sm-3 control-label">Account Name</label> 
        <div class="col-sm-8">
        <input type="text" name="accname" id="accname" class="form-control" value="<?php if(isset($accName)) {echo $accName;}?>"/>
        </div>
    </div>

    <?php if(isset($errAccName)) {echo $errAccName;}?>
    <div class="form-group">
        <label for="balance" class="col-sm-3 control-label">Balance</label>
        <div class="col-sm-8">
        <input type="text" name="balance" id="balance" class="form-control" value="<?php if(isset($balance)) {echo $balance;}?>"/>
    </div>
    </div>

    <?php if(isset($errBalance)) {echo $errBalance;}?>

    <input type="hidden" name="userid" value="<?php echo $_SESSION["user"]["id"];?>"/><br>

    <?php if(isset($errUserId)) { echo $errUserId; }?>

    <input type="submit" value="add budget" name="add" class="btn btn-success right">
</form>

<div><?php if(isset($thanksMsg)) { echo $thanksMsg; }?></div>

<!--****LIST BUDGETS STARTS HERE -->
<h2>Your Budgets</h2>
<?php foreach ($accounts as $account) { ?>

    <h3><?php echo $account['name']; ?></h3>
<table class="table table-hover">
    <tr>
        <th>Date Created</th>
        <th>Balance</th><br>
    </tr>
    <tbody>
    <tr>
        <td><?php echo $account['created']; ?></td>
        <td>$<?php echo $account['balance']; ?></td>
        <td><form action="updatebudget.php" method="post">
                <input type="hidden" name="accountId" value="<?php echo $account['id']; ?>">
                <input type="hidden" name="accountName" value="<?php echo $account['name']; ?>">
                <input type="hidden" name="accountBalance" value="<?php echo $account['balance']; ?>">
                <input type="submit" value="Update" name="submit" class="btn btn-default">
            </form></td>
        <td><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="accountId" value="<?php echo $account['id']; ?>">
                <input type="submit" value="Delete" name="delete" class="btn btn-danger">
            </form></td>
    </tr>
    </tbody>
</table>

<?php } ?>
</div>
<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>