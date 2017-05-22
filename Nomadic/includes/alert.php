<?php

/***************************************
    USERS
***************************************/
if(isset($_POST['register_user'])) {
    $users->newUser($_POST["username"], $_POST["email"], $_POST["verify-password"], $_POST["firstname"], $_POST["lastname"], $_POST["role"]);
    $message = "Thanks for registering! Please verify your email, ".$_POST["email"]." within 24hrs.";
    echo alertMsg($message, 'success');
}
if(isset($_POST['update_profile'])) {
    $target_dir = "media/user-profile/";
    $target_file = $target_dir.$_SESSION["user"]["id"]."-avatar.jpg";
    $uploadOk = 1;
    $imageFileType = pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if($check !== false) {
        $message = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $type = "danger";
        $uploadOk = 0;
    }
    if ($_FILES["img"]["size"] > 9000000) {
        $message = "Sorry, your file is too large.";
        $type = "danger";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
        $type = "danger";
        // if everything is ok, try to upload file
    } else {
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $message = "Your information was saved.";
            $type = "success";
        } else {
            $message = "Sorry, there was an error uploading your file.";
            $type = "danger";
        }
    }
    echo alertMsg($message, $type);
}
        // Adminisrator Side
if(isset($_POST['add_user'])) {
    $users->newUser($_POST["username"], $_POST["email"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["role"]);
    $message = "Thanks for registering! Please verify your email, ".$_POST["email"]." within 24hrs.";
    echo alertMsg($message, 'success');
}
if(isset($_POST['update_user'])) {
    $users->newUser($_POST["username"], $_POST["email"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["role"]);
    $message = "Thanks for registering! Please verify your email, ".$_POST["email"]." within 24hrs.";
    echo alertMsg($message, 'success');
}
if (isset($_POST['delete_user'])) {
    $users->deleteUser($_POST["id"]);
    $message = "User was deleted.";
    echo alertMsg($message, 'success');
}

/***************************************
    LOCATIONS
***************************************/
if (isset($_POST['add_location'])) {
    $target_file;
    
    if (isset($_POST["link"]) && !empty($_POST["link"]) && preg_match("/^(http|https)\:\/\//", $_POST["link"])) {
        $target_file = $_POST["link"];  
    } else if (isset($_FILES["img"]) && !empty($_FILES["img"])) {
        $target_dir = "media/location-images/";
        $san_filename = $_POST["name"];
        
        $target_file = $target_dir.$san_filename."-loc.jpg";
        $uploadOk = 1;
        $imageFileType = pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            $message = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $type = "danger";
            $uploadOk = 0;
        }
        if ($_FILES["img"]["size"] > 9000000) {
            $message = "Sorry, your file is too large.";
            $type = "danger";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $message = "Sorry, your file was not uploaded.";
            $type = "danger";
            // if everything is ok, try to upload file
        } else {
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                $message = "Your information was saved.";
                $type = "success";
            } else {
                $message = "Sorry, there was an error uploading your file.";
                $type = "danger";
            }
        }
        $san_target_file = $target_dir.rawurlencode($san_filename)."-loc.jpg";
    }
    if(!isset($_POST["cost"]) || empty($_POST["cost"])) {$_POST["cost"] = 0;}
    $locations->newLocation($_POST["name"], $_POST["address"], $_POST["zip"], $_POST["lat"], $_POST["lng"], $_POST["desc"], $_POST["web"], $_POST["phone"], $_POST["cost"], $san_target_file, $_POST["dest"], $_POST["cate"], $_POST["exp"]);
    $message = "Location added!";
    echo alertMsg($message, 'success');
}
if (isset($_POST['update_location'])) {
    
    $target_file;
    
    if (isset($_POST["link"]) && !empty($_POST["link"]) && preg_match("/^(http|https)\:\/\//", $_POST["link"])) {
        $target_file = $_POST["link"];  
    } else if ((is_uploaded_file($_FILES["img"]["tmp_name"]) || file_exists($_FILES["img"]["tmp_name"])) &&  isset($_FILES["img"])) {
        $target_dir = "media/location-images/";
        
        $san_filename = $_POST["name"];
        
        $target_file = $target_dir.$san_filename."-loc.jpg";
        $uploadOk = 1;
        $imageFileType = pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            $message = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $type = "danger";
            $uploadOk = 0;
        }
        if ($_FILES["img"]["size"] > 9000000) {
            $message = "Sorry, your file is too large.";
            $type = "danger";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $message = "Sorry, your file was not uploaded.";
            $type = "danger";
            // if everything is ok, try to upload file
        } else {
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                $message = "Your information was saved.";
                $type = "success";
            } else {
                $message = "Sorry, there was an error uploading your file.";
                $type = "danger";
            }
        }
        $san_target_file = $target_dir.rawurlencode($san_filename)."-loc.jpg";
    } else {
        $target_file = $_POST["filePath"];
    }
    if(!isset($_POST["cost"]) || empty($_POST["cost"])) {$_POST["cost"] = 0;}
    $locations->updateLocation($_POST["id"], $_POST["name"], $_POST["address"], $_POST["zip"], $_POST["lat"], $_POST["lng"], $_POST["desc"], $_POST["web"], $_POST["phone"], $_POST["cost"], $san_target_file, $_POST["dest"], $_POST["cate"], $_POST["exp"]);
    $message = "Location updated!";
    echo alertMsg($message, 'success');
}
if (isset($_POST['delete_location'])) {
    $locations->deleteLocation($_POST["id"]);
    $message = "Location was deleted.";
    echo alertMsg($message, 'success');
}

/***************************************
    EVENTS
***************************************/
if(isset($_POST['add_event'])){
    $events->createEvent($_POST['name'], date("Y-m-d", strtotime($_POST['date'])). date(" H:i:s", strtotime($_POST['time'])), $_POST['desc'], $_POST['link'], $_SESSION['user']['id'], $_POST['loc']);
    $message = "'".$_POST['name']."' event was created.";
    echo alertMsg($message, 'success');
}
if(isset($_POST['update_event'])){
    $events->updateEvent($_POST['id'], $_POST['name'], date("Y-m-d", strtotime($_POST['date'])). date(" H:i:s", strtotime($_POST['time'])), $_POST['desc'], $_POST['link'], $_POST['loc']);
    $message = "'".$_POST['name']."' was updated.";
    echo alertMsg($message, 'success');
}
if(isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];

    $charge = \Stripe\Charge::create(array(
      "amount" => $_POST['amount'],
      "currency" => "cad",
      "description" => "Advertising charge",
      "source" => $token,
    ));
    $events->adCharge($_POST['event'],$_POST['stripeToken'],$_POST['amount']);
    echo alertMsg('Campaign started!','success');
}
if (isset($_POST['delete_event'])) {
    $events->deleteEvent($_POST["id"]);
    $message = "Event was deleted.";
    echo alertMsg($message, 'success');
}

/***************************************
    Functionality for the alerts
***************************************/
//echo alertMsg("~**Test message**~", 'success'); //test the colors of the alert 

//type can be default, primary, success, info, warning or danger
function alertMsg($message, $type){
    return "<center id='alertMsg' class='label label-".$type." col-xs-10 col-md-6' role='alert'>".$message."</center>";
}

/***************************************
    ALERTS FOR MIA'S FEATURES
***************************************/
?>