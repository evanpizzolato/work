<?php
// Put the title for your the page here
$page_title = "Contact Us Admin";

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

//    $mydi = new Database();
//    $pdoconn = $mydi->getDatabase();

    $myForm = new FeedbackForm();
    $forms = $myForm->getForms($db);
?>

<div class="jumbotron">
    <h2 class="content text-center" id="adminTitle">Contact Us Admin Page</h2>
    
<div class="adminTable">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th>Comment</th>
            <th>Date Submitted</th>
            <th>Date Edited</th>
            <th>Edit Reason</th>
            <th>Reply Status</th>
            <th>User ID</th>
        </tr>

        <?php foreach ($forms as $form) : ?>
        <tr>
            <td>
                <?php echo $form['id']; ?>
            </td>
            <td>
                <?php echo $form['firstname']; ?>
            </td>
            <td>
                <?php echo $form['lastname']; ?>
            </td>
            <td>
                <?php echo $form['email']; ?>
            </td>
            <td>
                <?php echo $form['phone']; ?>
            </td>
            <td>
                <?php echo $form['subject']; ?>
            </td>
            <td>
                <?php echo $form['comment']; ?>
            </td>
            <td>
                <?php echo $form['date_submitted']; ?>
            </td>
            <td>
                <?php echo $form['date_edited']; ?>
            </td>
            <td>
                <?php echo $form['edit_reason']; ?>
            </td>
            <td>
                <?php echo $form['reply_status']; ?>
            </td>
            <td>
                <?php echo $form['users_id']; ?>
            </td>

            <td>
                <form action="contactus_admin_edit.php" method="get">
                    <input type="hidden" name="formId" value="<?php echo $form['id']; ?>">
                    <button type="submit" name="edit" class='adminBtn'data-toggle='tooltip' data-placement='top' title='Edit/Details'><a><span class="glyphicon glyphicon-pencil" ></span></a></button>

                </form>
            </td>

            
            
            <td>
                <form action="contactus_admin.php" method="post">
                    <input type="hidden" name="formId" value="<?php echo $form['id']; ?>" />
                    <button type="submit" name="delete" class='adminBtn' data-toggle='tooltip' data-placement='top' title='Delete'><a><span class="glyphicon glyphicon-remove" ></span></a></button>
                </form>
                
                <?php
                    if(isset($_POST['delete'])) {
                        $formId = $_POST['formId'];
                        $myForm->deleteForm($db, $formId);
                    }
                ?>
            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

<div id="output">
    <p>
        <?php if(isset($_POST['delete'])) {
            echo "<meta http-equiv='refresh' content='0'>";
        } ?>
    </p>
</div>

<div class="text-center formcol">
<form action="contactus.php">
    <input type="submit" class="btn btn-success" value="Add a form">
</form>
    </div>    
</div>

<?php
    $page_content = ob_get_contents();
    ob_end_clean();
    include_once "includes/dash.php";
    require_once "includes/footer.php";
?>
