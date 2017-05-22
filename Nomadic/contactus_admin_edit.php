<?php
    // Put the title for your the page here
    $page_title = "Contact Us Edit";

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
    

    if (isset($_POST['replied'])) {
        $replied = $_POST['replied'];
    }

//    $mydi = new Database();
//    $pdoconn = $mydi->getDatabase();

    $thisForm = new FeedbackForm();

    if (isset($_GET['formId'])) {
        $form = $thisForm->getForm($db, $_GET['formId']);
    }

    $myValidation = new Validation();

    
?>
<div class="jumbotron">
<div class="adminTable">
<h2 class="content text-center"> Form
    <?php if(isset($form['id'])){
        echo $form['id'];
    } else if (isset($_POST['formIdToSend'])) {
        echo $_POST['formIdToSend'];
    } ?>
</h2>

    <table class="table table-hover">

        <tr>
            <th>Form ID#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Country</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th>Comment</th>
            <th>Date Submitted</th>
            <th>Date Edited</th>
            <th>Edit Reason</th>
            <th>Reply Status</th>
        </tr>

        <tr>
            <td>
                <?php                                     
                    if(isset($form['id'])){
                        echo $form['id'];
                    } else if (isset($_POST['formIdToSend'])){
                        echo filter_var($_POST['formIdToSend'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
                    }
                ?>
            </td>
            <td>
                <?php 

    if(isset($form['firstname'])){
        echo $form['firstname'];
    } else if(isset($_POST['f_name_edit'])){
        echo filter_var($_POST['f_name_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['lastname'])){
        echo $form['lastname'];
    } else if (isset($_POST['l_name_edit'])) {
        echo filter_var($_POST['l_name_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['address'])){
        echo $form['address'];
    } else if (isset($_POST['address_edit'])) {
        echo filter_var($_POST['address_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['country'])){
        echo $form['country'];
    } else if (isset($_POST['country_edit'])){
        echo filter_var($_POST['country_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['email'])){
        echo $form['email'];
    } else if (isset($_POST['email_edit'])) {
        echo filter_var($_POST['email_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['phone'])){
        echo $form['phone'];
    } else if (isset($_POST['phone_edit'])){
        echo filter_var($_POST['phone_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['subject'])){
        echo $form['subject'];
    } else if (isset($_POST['subject_edit'])) {
        echo filter_var($_POST['subject_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['comment'])){
        echo $form['comment'];
    } else if (isset($_POST['comment_edit'])) {
        echo filter_var($_POST['comment_edit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>

            <td>
                <?php 

    if(isset($form['date_submitted'])){
        echo $form['date_submitted'];
    } else if (isset($_POST['dateSubmitted'])) {
        echo filter_var($_POST['dateSubmitted'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }                                                         ?>
            </td>

            <td>
                <?php 

    if(isset($form['date_edited'])){
        echo $form['date_edited'];
    } else if (isset($_POST['dateEdited'])){
        echo filter_var($_POST['dateEdited'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }

                                                 ?>
            </td>
            <td>
                <?php 

    if(isset($form['edit_reason'])){
        echo $form['edit_reason'];
    } else if (isset($_POST['editReason'])){
        echo filter_var($_POST['editReason'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }
                                                 ?>
            </td>
            <td>
                <?php 
    if(isset($form['reply_status'])){
        echo $form['reply_status'];
    } else if (isset($_POST['replied'])) {
        echo filter_var($_POST['replied'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
    }
                                                 ?>
            </td>

        </tr>
    </table>
</div>

<h2 class="content text-center" id="editTitle">Edit Form
    <?php if(isset($form['id'])){
        echo $form['id'];
    } else if (isset($_POST['formIdToSend'])) {
        echo $_POST['formIdToSend'];
    } ?>
</h2>

<form action="contactus_admin_edit.php" method="post" class="form-horizontal content">
    
    <div class="form-group">
        <label for="f_name" class="col-sm-3 control-label">First Name: </label>
        <div class="col-sm-8">
        <input type="text" class='form-control' name="f_name_edit" value="<?php 
    if(isset($form['firstname'])){
        echo $form['firstname'];
    } else if (isset($_POST['f_name_edit'])) {
        echo $_POST['f_name_edit'];
    }
    ?>" />
                <?php 
        
                if(isset($_POST['f_name_edit'])) {
                        $f_nameEmptyValidation = new Validation();
                        $f_nameEmptyValidation->setInput($_POST['f_name_edit']);
                        $f_nameEmptyValidation->validateEmpty();
                        $f_nameEmptyFlag = $f_nameEmptyValidation->getFlag();


                        $f_nameMaxValidation = new Validation();
                        $f_nameMaxValidation->setInput($_POST['f_name_edit']);
                        $f_nameMaxValidation->validateMaxLength(60);
                        $f_nameMaxFlag = $f_nameMaxValidation->getFlag();

                        if($f_nameEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $f_nameEmptyValidation->message . "</span>"; }

                        if($f_nameMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $f_nameMaxValidation->message . "</span>"; }
                    }
                 ?>
            </div>
    </div>

    <div class="form-group">
        <label for="l_name" class="col-sm-3 control-label">Last Name: </label>
        <div class="col-sm-8">
        <input type="text" class='form-control' name="l_name_edit" value="<?php 
    if(isset($form['lastname'])){
        echo $form['lastname'];
    } else if (isset($_POST['l_name_edit'])) {
        echo $_POST['l_name_edit'];
    }
                                                 ?>" />
                <?php 
                if(isset($_POST['l_name_edit'])) {
                    $l_nameEmptyValidation = new Validation();
                    $l_nameEmptyValidation->setInput($_POST['l_name_edit']);
                    $l_nameEmptyValidation->validateEmpty();
                    $l_nameEmptyFlag = $l_nameEmptyValidation->getFlag();

                    $l_nameMaxValidation = new Validation();
                    $l_nameMaxValidation->setInput($_POST['l_name_edit']);
                    $l_nameMaxValidation->validateMaxLength(60);
                    $l_nameMaxFlag = $l_nameMaxValidation->getFlag();
                    if($l_nameEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $l_nameEmptyValidation->message . "</span>"; }
                    if($l_nameMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $l_nameMaxValidation->message . "</span>"; }
                }
                ?>
        </div>
    </div>

    <div class="form-group">
        <label for="address" class="col-sm-3 control-label">Address: </label>
        <div class="col-sm-8">
        <input type="text" class='form-control' name="address_edit" value="<?php 
    if(isset($form['address'])){
        echo $form['address'];
    } else if (isset($_POST['address_edit'])) {
        echo $_POST['address_edit'];
    }
                                                 ?>" />
        </div>
    </div>

    <div class="form-group">
        <label for="country" class="col-sm-3 control-label">Country: </label>
        <div class="col-sm-8">
        <input type="text" class='form-control' name="country_edit" value="<?php 

    if(isset($form['country'])){
        echo $form['country'];
    } else if (isset($_POST['country_edit'])) {
        echo $_POST['country_edit'];
    }

                                                 ?>" />
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email: </label>
        <div class="col-sm-8">
        <input type="text" class='form-control' name="email_edit" value="<?php 

    if(isset($form['email'])){
        echo $form['email'];
    } else if (isset($_POST['email_edit'])){
        echo $_POST['email_edit'];
    }

                                                 ?>" />
                <?php 
                if(isset($_POST['email_edit'])) {
                    $emailValidation = new Validation();
                    $emailValidation->setInput($_POST['email_edit']);
                    $emailValidation->validateEmail();
                    $emailFlag = $emailValidation->getFlag();        
                    if($emailFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $emailValidation->message . "</span>"; }
                }
                
                ?>
        </div>
    </div>

    <div class="form-group">
        <label for="phone" class="col-sm-3 control-label">Phone: </label>
        <div class="col-sm-8">        
        <input type="text" class='form-control' name="phone_edit" value="<?php 

    if(isset($form['phone'])){
        echo $form['phone'];
    } else if (isset($_POST['phone_edit'])) {
        echo $_POST['phone_edit'];
    }

                                                 ?>" />
        </div>
    </div>

    <div class="form-group">
        <label for="subject" class="col-sm-3 control-label">Subject: </label>
        <div class="col-sm-8">        
        <input type="text" class='form-control' name="subject_edit" value="<?php 

    if(isset($form['subject'])){
        echo $form['subject'];
    } else if (isset($_POST['subject_edit'])){
        echo $_POST['subject_edit'];
    }

                                                 ?>" />
                <?php 
                if(isset($_POST['subject_edit'])) {
                    $subjectEmptyValidation = new Validation();
                    $subjectEmptyValidation->setInput($_POST['subject_edit']);
                    $subjectEmptyValidation->validateEmpty();
                    $subjectEmptyFlag = $subjectEmptyValidation->getFlag();

                    $subjectMaxValidation = new Validation();
                    $subjectMaxValidation->setInput($_POST['subject_edit']);
                    $subjectMaxValidation->validateMaxLength(100);
                    $subjectMaxFlag = $subjectMaxValidation->getFlag();
                    if($subjectEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $subjectEmptyValidation->message . "</span>"; } 
                    if($subjectMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" .$subjectMaxValidation->message . "</span>"; }
                }
                
                ?>
        </div>
    </div>

    <div class="form-group">
        <label for="comment" class="col-sm-3 control-label">Comment: </label>
        <div class="col-sm-8">
        <textarea  class='form-control' name="comment_edit"><?php 

    if(isset($form['comment'])){
        echo $form['comment'];
    } else if (isset($_POST['comment_edit'])){
        echo $_POST['comment_edit'];
    }
            ?>
    </textarea>
                <?php
                if(isset($_POST['comment_edit'])) {
                    $commentEmptyValidation = new Validation();
                    $commentEmptyValidation->setInput($_POST['comment_edit']);
                    $commentEmptyValidation->validateEmpty();
                    $commentEmptyFlag = $commentEmptyValidation->getFlag();
                    if($commentEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" .$commentEmptyValidation->message . "</span>"; }
                }
        
                 ?>
        </div>
    </div>

    <div class="form-group">
        <label for="editReason" class="col-sm-3 control-label">Reason for Edit: </label>
        <div class="col-sm-8">
        <input type="text" class='form-control' name="editReason" value="<?php 

    if(isset($form['edit_reason'])){
        echo $form['edit_reason'];
    } else if(isset($_POST['editReason'])){
        echo $_POST['editReason'];
    }
                                                 ?>" />
                <?php 
                if(isset($_POST['editReason'])) {
                    $editReasonEmptyValidation = new Validation();
                    $editReasonEmptyValidation->setInput($_POST['editReason']);
                    $editReasonEmptyValidation->validateEmpty();
                    $editReasonFlag = $editReasonEmptyValidation->getFlag();
                    if($editReasonFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $editReasonEmptyValidation->message . "</span>";
                }
                } ?>
        </div>
    </div>

    <div class="form-group">
        <label for="replied" class="col-sm-3 control-label">Form replied to?</label>
        <div class="col-sm-8">
        <select class='form-control' name="replied">
            <option value="" 

                    <?php 
                    if (isset($form['reply_status'])) {
                    if($form['reply_status'] == '') echo 'selected="selected"'; 
                    }
                    ?>

                    <?php 
                    if (isset($_POST['replied'])) {
                    if($_POST['replied'] == '') echo 'selected="selected"'; }?>>

                Select</option>
            <option value="No"<?php 
                    
                    if (isset($_POST['reply_status'])) {
                    if($form['reply_status'] == 'No') echo 'selected="selected"'; 
                    }
                    ?>
            <?php 
                    if (isset($_POST['replied'])) {
                    if($_POST['replied'] == 'No') echo 'selected="selected"'; }
                    ?>>No</option>
            
            <option value="Yes"<?php 
                    if (isset($form['reply_status'])) {
                    if($form['reply_status'] == 'Yes') echo 'selected="selected"'; }
                    ?>
                    <?php 
                    if (isset($_POST['replied'])){
                    if($_POST['replied'] == 'Yes') echo 'selected="selected"';}
                    ?>>Yes</option>
            
        </select>
        </div>
    </div>

    <input type="hidden" name="formIdToSend" value="<?php 
        if(isset($form['id'])){echo $form['id'];} else if (isset($_POST['formIdToSend'])){echo $_POST['formIdToSend'];} 
                                                    ?>" />
    <input type="hidden" name="dateSubmitted" value="<?php if (isset($form['date_submitted'])){echo $form['date_submitted'];} ?>" />
    <input type="hidden" name="dateEdited" value="<?php echo date(" Y-m-d h:i:s "); ?>"/>
    <div class="text-center formcol">    
        <input type="submit" class="btn btn-success" value="Submit Edited Form" name="edit_form" />
    </div>

</form>

<?php
    if(isset($_POST['edit_form'])) {

            if ($f_nameEmptyFlag == false && $f_nameMaxFlag == false && $l_nameEmptyFlag == false && $l_nameMaxFlag == false && $emailFlag == false && $subjectEmptyFlag == false && $subjectMaxFlag == false && $commentEmptyFlag == false && $editReasonFlag == false) {


                $thisForm->editForm($db, $_POST['f_name_edit'], $_POST['l_name_edit'], $_POST['address_edit'], $_POST['country_edit'], $_POST['email_edit'], $_POST['phone_edit'], $_POST['subject_edit'], $_POST['comment_edit'], $_POST['dateEdited'], $_POST['editReason'], $_POST['replied'], $_POST['formIdToSend']);

                $message = "Form edited";
                echo alertMsg($message, 'success');

                } else if ($f_nameEmptyFlag == true || $f_nameMaxFlag == true || $l_nameEmptyFlag == true || $l_nameMaxFlag == true || $emailFlag == true || $subjectEmptyFlag == true || $subjectMaxFlag == true || $commentEmptyFlag == true || $editReasonFlag == true){
                
                $message = "This form was not edited as it contains invalid data";
                
                echo alertMsg($message, 'danger');
            }
    }

?>
<br>
<form action="contactus_admin.php" class="content">
    <input type="submit" class="btn btn-default" value="Back to list">
</form>
</div>

<?php
    $page_content = ob_get_contents();
    ob_end_clean();
    include_once "includes/dash.php";
    require_once "includes/footer.php";
?>
