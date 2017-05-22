<?php
// Put the title for your the page here
$page_title = "~Template~";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags

//$myDb = new Database();
//$pdoconn = $myDb->getDatabase();


?>
<div class='jumbotron'>
    <?php
$tipsObj = new Tips();

if (isset($_GET['tipId'])) {
    $thisTip = $tipsObj->getTipById($db, $_GET['tipId']);
} else if (isset($_POST['tipIdToSend'])) {
    $thisTip = $tipsObj->getTipById($db, $_POST['tipIdToSend']);
}
    
if(isset($thisTip)){
    if ($thisTip['users_id'] !== $_SESSION['user']['id'] && $_SESSION["user"]["class"] !== "1") {
        redirect("permission.php");
    }
}    
    
if (isset($_POST['content'])){
        echo "<div class='text-center'><span class='citySubtitle'>";
    
    if ($thisTip['username'] == $_SESSION['user']['username']) {
        echo "You";
    } else {
        echo $thisTip['username'];
    }
    echo "</span>" . " said '" . $_POST['content'] . "'</div>" . "<br>";
} else if (isset($thisTip)) {
    echo "<div class='text-center'><span class='citySubtitle'>";
    
    if ($thisTip['username'] == $_SESSION['user']['username']) {
        echo "You";
    } else {
        echo $thisTip['username'];
    }
    
    
        
    echo "</span>" . " said '" . $thisTip['content'] . "'</div>" . "<br>";
} 
?>

        <form action="citypages_edittip.php" method="post" class='form-horizontal'>
            <div class='form-group'>
            <label for="content" class='col-sm-3 control-label'>Edit tip:</label>
            <div class='col-sm-8'> 
            <input type="text" name="content" class='form-control'>
            <input type="hidden" name="tipIdToSend" value="<?php if(isset($thisTip['id'])){
                echo $thisTip['id'];
            } else {
                echo $_POST['tipIdToSend'];
            } ?>"/>
            
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


                                        
                    if($contentEmptyFlag == true){ echo "<br>" ."<span class='alert-danger'>" . $contentEmptyValidation->message . "</span>"; 
                    };
            
                    if($contentMaxFlag == true){ echo "<br>" . "<span class='alert-danger'>" . $contentMaxValidation->message . "</span>"; 
                    };
                }
                
                 ?>                
            
            </div>       
            </div>
            <div class='text-center formcol'>
            <input type="submit" name="save" value="Edit Tip" class='btn btn-success'>
            </div>
        </form>
        
        <?php 
        
        if(isset($_POST['save'])) {
            if ($contentEmptyFlag == false && $contentMaxFlag == false) {
                $dateEdited = date("Y-m-d h:i:sA T");
            
                $tipsObj->editTip($db, $_POST['content'], $dateEdited, $_POST['tipIdToSend']);

                $message = "Tip edited!";
                echo alertMsg($message, 'success');
            } else if ($contentEmptyFlag == true || $contentMaxFlag == true) {
                $message = "Your tip was not submitted as it contains invalid data";
                echo alertMsg($message, 'danger');
            }
        }
        
        ?>
<form method='post' action="citypages.php?search=<?php 
                             
                             if(isset($thisTip['city'] )) {
                                 echo $thisTip['city'];
                             } else if (isset($_POST['cityName'])){
                                 echo $_POST['cityName'];
                             }
                             
                             ?>&submit=Go">
    
        <input type="hidden" name="cityName"  value="<?php                 if(isset($_POST['cityName'])){
                    echo $_POST['cityName'];
                } else {
                    echo $thisTip['city'];
                }
        ?>">

    <input type="submit" value="Back to List" class="btn btn-default">
</form>

</div>




<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>