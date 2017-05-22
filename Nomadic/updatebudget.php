<?php
// Put the title for your the page here
$page_title = "update budget";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags 
/****UPDATE BUDGET STARTS HERE*****/

//call getCategories method on Category Object for dropdown
$categories = $category->getCategories();

if(isset($_POST['submit'])){

    $id = $_POST['accountId'];

    //call getOneAccount method on Account Object
    $account->getOneAccount($id);

    //call getTransactions method
    $allTransactions = $transaction->getTransactions($id);
}

if(isset($_POST['edt'])){
    //change name or edit balance
    $id = $_POST['aId'];
    $name = $_POST['aName'];
    $bal = $_POST['aBal'];
    //call updateNameBalance method to change name or edit balance
    $account->updateNameBalance($id, $bal, $name);

    //***Balance from expenses/income starts here***
    $amount = $_POST['amount'];
    $catType = $_POST['category'];
    $dateEntry = $_POST['date'];

    if($amount !== '' && $catType !== '0') {
        if($catType === 'debit') {

            $bal += $amount;
            $cId = 1;
            $account->updateNameBalance($id, $bal, $name);

            //insert the transaction into tw_transactions
            $transaction->addTransaction($dateEntry, $amount, $id, $cId);

        }//end case 'debit'

        if($catType === 'credit') {

            $bal -= $amount;
            $cId = 2;

            $account->updateNameBalance($id, $bal, $name);

            //insert the transaction into tw_transactions
            $transaction->addTransaction($dateEntry, $amount, $id, $cId);

        }//end case 'credit'

    }//end balance updates from expenses/income
    
    header('Location: budget.php');

}


?>

<!--Update Starts Here-->

<h3>Edit/Update Budget Details</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-horizontal">
    <div class="form-group">
        <input type="hidden" name="aId" value="<?php echo $id; ?>">
        <label for="aName" class="col-sm-3 control-label">Rename</label>
        <div class="col-sm-8">
        <input type="text" name="aName" id ="aName" class="form-control" value="<?php echo $_POST['accountName']; ?>">
        </div>
    </div>
    <div class="form-group">  
        <label for="aBal" class="col-sm-3 control-label">Balance</label>
        <div class="col-sm-8">
        <input type="number" name="aBal" id="aBal" class="form-control" value="<?php echo $_POST['accountBalance']; ?>">
        </div>
    </div>
    <p class="text-center">Keep track of spending by processing transactions below. Simply input the amount and select Debit or Credit!</p>
    <div class="form-group">
        <label for="amount" class="col-sm-3 control-label">Amount</label>
        <div class="col-sm-8">
        <input type="number" name="amount" id="amount" class="form-control"> 
        </div>
    </div>
    <div class="form-group">
        <label for="category" class="col-sm-3 control-label">Credit/Debit</label>
        <div class="col-sm-8">
        <select name="category" id="category" class="form-control">
            <option value="0">***SELECT***</option>
        
            <?php foreach($categories as $cat) {

            echo "<option value='" . $cat['name'] . "'>" . $cat['name'] . "</option>";

        }?>
        </select>
        </div>
    </div>
    
    <input type="hidden" name="date" value="<?php $date = new DateTime(); echo $date->format('Y-m-d-H:i:s'); ?>">
    <input type="submit" value="Edit Budget" name="edt" class="btn btn-success right"/>
</form>

<h4>Transactions</h4>

<table class="table table-hover">
    <thead>
    <th>Date</th>
    <th>Amount</th>
    </thead>
    <tbody>


    <?php foreach($allTransactions as $transac) {

        echo "<tr>" . "<td>" . $transac['date'] . "</td>";
        echo "<td>" . "$" .$transac['amount'] . "</td>" . "</tr>";

    } ?>

    </tbody>
</table>

<a href="budget.php">Back to Budgets</a>

<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>