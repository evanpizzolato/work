<?php
// Put the title for your the page here
$page_title = "Forum";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags 
?>

<?php
    //require_once "Classes/Forum.php";
    //$forum = new Forum($db);
?>
<?php
    $page_title = "Forum";

    //include "includes/header.php";
    //include "includes/body.php";
?>

<?php
if (isset($_SESSION["user"]) && isset($_SESSION["loggedin"])) {
    include_once "includes/searchforum.php";
    $action = "index";
    if (isset($_GET['category']) && isset($_GET['topic']))
    {
        if (isset($_POST['sbmMsg'])) {
            $forum->createReply($_POST);
        }
        $action = "topics";
    }
    else if (isset($_GET['category'])) {
        if (isset($_POST['sbmTopic'])) {
            $forum->createNewTopic($_POST);
        }
        $action = "category";
    }
    include "includes/forumview.php";
} else {
    echo "<div>Login Required</div>";
    echo "</div>";
}
?>

<?php
    include "includes/footer.php";
?>


<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>