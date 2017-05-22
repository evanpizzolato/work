<?php
if(isset($_POST['addTip'])) { 

        $message = "Tip submitted!";
        echo alertMsg($message, 'success');
    }

?>

<h2 class='title'>Add a Tip</h2>
<form method="post" class='form-horizontal'>
    <div class='form-group'>
    <div class ='col-sm-10'>  
    <input type="text" name="content" class='form-control'>  
    <?php

        if(isset($_POST['content'])) {

            $contentEmptyValidation = new Validation();
            $contentEmptyValidation->setInput($_POST['content']);
            $contentEmptyValidation->validateEmpty();
            $contentEmptyFlag = $contentEmptyValidation->getFlag();

            $contentMaxValidation = new Validation();
            $contentMaxValidation->setInput($_POST['content']);
            $contentMaxValidation->validateMaxLength(200);
            $contentMaxFlag = $contentMaxValidation->getFlag();



            if($contentEmptyFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $contentEmptyValidation->message . "</span>"; 
            };

            if($contentMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $contentMaxValidation->message . "</span>"; 
            };
        }

         ?>                
    </div>  
    <input type="submit" name="addTip" value="Add Tip" class="btn btn-success col-sm-2">
    </div>
    <?php 


        if(isset($_POST['addTip'])) {

            if ($contentEmptyFlag == false && $contentMaxFlag == false) {
                $dateAdded = date("Y-m-d h:i:sA T");

                $tipsObj->newTip($db, $_POST['content'], $dateAdded, $_SESSION['user']['id'], $destination['id']);

                echo "<meta http-equiv='refresh' content='0'>";
            } else if ($contentEmptyFlag == true || $contentMaxFlag == true) {
                $message = "Your tip was not submitted as it contains invalid data";
                echo alertMsg($message, 'danger');
            }



        }

    ?>
</form>
