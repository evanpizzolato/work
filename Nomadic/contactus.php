<?php
// Put the title for your the page here
$page_title = "Contact Us";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags 
?>

<?php

//    $mydi = new Database();
//    $pdoconn = $mydi->getDatabase();

    $myForm = new FeedbackForm();
    $forms = $myForm->getForms($db);

    $myValidation = new Validation();
?>

<div class="jumbotron">

    <div class="content">

        <div id="msgOutput">
        </div>

        <h1 id="contactTitle" class="text-center">Contact Nomadic!</h1>

        <form name="contact" action="contactus.php" method="post" class="form-horizontal">
            
            <div class="form-group">
                <label for="f_name" class="col-sm-3 control-label">First Name:</label>
                <div class="col-sm-8">
                    <input type="text" name="f_name" class='form-control' value="<?php if(isset($_POST['f_name'])){echo $_POST['f_name'];}?>" />
                    <?php
                    if(isset($_POST['f_name'])) {
                        $f_nameEmptyValidation = new Validation();
                        $f_nameEmptyValidation->setInput($_POST['f_name']);
                        $f_nameEmptyValidation->validateEmpty();
                        $f_nameEmptyFlag = $f_nameEmptyValidation->getFlag();

                        $f_nameMaxValidation = new Validation();
                        $f_nameMaxValidation->setInput($_POST['f_name']);
                        $f_nameMaxValidation->validateMaxLength(60);
                        $f_nameMaxFlag = $f_nameMaxValidation->getFlag();

                        if($f_nameEmptyFlag == true){ echo  "<br>" . "<span class='alert-danger'>" . $f_nameEmptyValidation->message . "</span>"; }

                        if($f_nameMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $f_nameMaxValidation->message . "</span>"; }
                        };
                     ?>   
                </div>
                
            </div>
                <br>

            <div class="form-group">
                <label for="l_name" class="col-sm-3 control-label">Last Name:&nbsp;&nbsp;</label>
                <div class="col-sm-8">
                <input type="text" name="l_name" class='form-control' value="<?php if(isset($_POST['l_name'])){echo $_POST['l_name'];}?>" />
                <?php 
                if(isset($_POST['l_name'])) {
                    $l_nameEmptyValidation = new Validation();
                    $l_nameEmptyValidation->setInput($_POST['l_name']);
                    $l_nameEmptyValidation->validateEmpty();
                    $l_nameEmptyFlag = $l_nameEmptyValidation->getFlag();

                    $l_nameMaxValidation = new Validation();
                    $l_nameMaxValidation->setInput($_POST['l_name']);
                    $l_nameMaxValidation->validateMaxLength(60);
                    $l_nameMaxFlag = $l_nameMaxValidation->getFlag();
                    
                    if($l_nameEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $l_nameEmptyValidation->message . "</span>"; }
                    if($l_nameMaxFlag == true){ echo "<br>" . $l_nameMaxValidation->message; }
                };
                ?>
                </div>
            </div>
                <br>

            <div class="form-group">
                <label for="address" class="col-sm-3 control-label">Address:&nbsp;&nbsp;</label>
                <div class="col-sm-8">
                <input type="text" name="address" class='form-control' value="<?php if(isset($_POST['address'])){echo $_POST['address'];}?>" />
                </div>
            </div>
                <br>

            <div class="form-group">
                <label for="country" class="col-sm-3 control-label">Country:&nbsp;&nbsp;</label>
                <div class="col-sm-8">
                <input type="text" name="country" class='form-control'value="<?php if(isset($_POST['country'])){echo $_POST['country'];}?>" />
            </div>
            </div>    
                <br>

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email:</label>
                <div class="col-sm-8">
                <input type="email" name="email" class='form-control'value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" />
                <?php 
                
                if(isset($_POST['email'])) {
                    $emailValidation = new Validation();
                    $emailValidation->setInput($_POST['email']);
                    $emailValidation->validateEmail();
                    $emailFlag = $emailValidation->getFlag();
                    
                    if($emailFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $emailValidation->message . "</span>"; }
                };
                ?>
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="emailConfirm" class="col-sm-3 control-label">Reconfirm email:&nbsp;&nbsp;</label>
                <div class="col-sm-8">
                <input type="email" name="emailConfirm" class='form-control' value="<?php if(isset($_POST['emailConfirm'])){echo $_POST['emailConfirm'];}?>" />
                <?php 
                if(isset($_POST['emailConfirm'])) {
                    $emailConfirmValidation = new Validation();
                    $emailConfirmValidation->setInput($_POST['emailConfirm']);
                    $emailToCompare = $emailValidation->getInput();
                    $emailConfirmValidation->validateEmailConfirm($emailToCompare);
                    $emailConfirmFlag = $emailConfirmValidation->getFlag();
                    if($emailConfirmFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $emailConfirmValidation->message . "</span>"; }
                };
                ?>
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="phone" class="col-sm-3 control-label">Phone:&nbsp;&nbsp;</label>
                <div class="col-sm-8">
                <input type="text" name="phone" class='form-control' value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" />
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="subject" class="col-sm-3 control-label">Subject:&nbsp;&nbsp;</label>
                <div class="col-sm-8">
                <input type="text" class='form-control' name="subject" value="<?php if(isset($_POST['subject'])){echo $_POST['subject'];}?>" />
                <?php 
                if(isset($_POST['subject'])) {
                    $subjectEmptyValidation = new Validation();
                    $subjectEmptyValidation->setInput($_POST['subject']);
                    $subjectEmptyValidation->validateEmpty();
                    $subjectEmptyFlag = $subjectEmptyValidation->getFlag();

                    $subjectMaxValidation = new Validation();
                    $subjectMaxValidation->setInput($_POST['subject']);
                    $subjectMaxValidation->validateMaxLength(100);
                    $subjectMaxFlag = $subjectMaxValidation->getFlag();
                    
                    if($subjectEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $subjectEmptyValidation->message . "</span>"; }
                    if($subjectMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $subjectMaxValidation->message . "</span>"; }
                };
                ?>
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="comment" class="col-sm-3 control-label">Comment:&nbsp;&nbsp;</label>
                <div class="col-sm-8">
                <textarea name="comment" class='form-control'><?php if(isset($_POST['comment'])){echo $_POST['comment'];}?></textarea>
                <?php 
                
                if(isset($_POST['comment'])) {
                    $commentEmptyValidation = new Validation();
                    $commentEmptyValidation->setInput($_POST['comment']);
                    $commentEmptyValidation->validateEmpty();
                    $commentEmptyFlag = $commentEmptyValidation->getFlag();
                    
                    if($commentEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $commentEmptyValidation->message . "</span>"; }
    
                };

                ?>
                </div>
            </div>
            <br>
            
            <div class="text-center formcol">
            <input class="btn btn-success" type="submit" value="Submit" name="add_form" />
            </div>

        </form>
        
        <?php
            if (isset($_SESSION["user"]) && $_SESSION["user"]["class"] == "1") {
                echo  "<form action='contactus_admin.php'>". "<input type='submit' value='Go to Admin' class='btn btn-default'>" . "</form>";
            }
        ?>
    </div>
</div>

<?php

    if(isset($_POST['add_form'])) {
            if ($f_nameEmptyFlag == false && $f_nameMaxFlag == false && $l_nameEmptyFlag == false && $l_nameMaxFlag == false && $emailFlag == false && $emailConfirmFlag == false && $subjectEmptyFlag == false && $subjectMaxFlag == false && $commentEmptyFlag == false) {
                $currentDate = date("Y-m-d h:i:s");

                $myForm->newForm($db, $_POST['f_name'], $_POST['l_name'], $_POST['address'], $_POST['country'], $_POST['email'], $_POST['phone'], $_POST['subject'], $_POST['comment'], $currentDate, $_SESSION['user']['id']);
                $message = "Form submitted! Thank you for getting in touch with us!";
                echo alertMsg($message, 'success');
                
            } else if ($f_nameEmptyFlag == true || $f_nameMaxFlag == true || $l_nameEmptyFlag == true || $l_nameMaxFlag == true || $emailFlag == true || $emailConfirmFlag == true || $subjectEmptyFlag == true || $subjectMaxFlag == true || $commentEmptyFlag == true) {
                $message = "Your form was not submitted as it contains invalid data";
                
                echo alertMsg($message, 'danger');
            }

    }

?>

<?php

if (isset($_SESSION['loggedin'])) {
    $page_content = ob_get_contents();
    ob_end_clean();    
    include_once "includes/dash.php";
}
    require_once "includes/footer.php";
?>
