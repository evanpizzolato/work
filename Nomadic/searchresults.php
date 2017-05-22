<?php
// Put the title for your the page here
$page_title = "Search Results";

// include_once all Classes in the header.php
require_once "includes/header.php";
ob_start();

//  Put the code for your feature between the php tags 
if(isset($_GET['submit'])){

    $date = $_GET['date'];

    //if $_GET['query'] empty, tell user to enter query
    if(empty($_GET['query'])){

        $errMsg = "Please enter a search query.";
    }

    //if $_GET['query'] not empty, set to $query
    if(!empty($_GET['query'])){

        $query = $_GET['query'];

        //trim whitespace
        $trimmed = trim($query);
        //execute search query
        $results = $search->search($trimmed);

        if (empty($results)) {
            $errRlt = "No Results Returned.";
        }

        //grab current URL to use in search history.

        $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

        //add into search history
        $search->addSearchHist($date, $query, $url, $_SESSION["user"]["id"]);
    }

}//end isset($_GET['submit'])

/***Search History Starts HERE***/

if(isset($_POST['searchHist'])){

    //call getSearchHist method on $search object
    $history = $search->getSearchHist($_SESSION["user"]["id"]);

}

/***Delete History starst HERE***/
if(isset($_POST['delete'])){

    $search->deleteSearchHist($_SESSION["user"]["id"]);

}

?>
<h1><a href="searchresults.php">Search Results</a></h1>

<div class="jumbotron">

        <div class="text-danger text-center"><?php if(isset($errMsg)){echo $errMsg; } if(isset($errRlt)){echo $errRlt; } ?></div>

<?php
if(isset($results)) {
    foreach ($results as $result) { ?>

        <div>Feature: <a href="<?php echo $result['url']; ?>"><?php echo $result['name']; ?></a></div>
        <div>Description: <?php echo $result['description']; ?></div>

    <?php }
}//end if isset($results)
    ?>



<!-- view search history -->



    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="userid" value="<?php echo $_SESSION["user"]["id"]; ?>">
        <input type="submit" name="searchHist" value="View Search History" class="btn btn-success pull-right">
    </form>

<table class="table table-hover">
    <tr>
        <th>Date</th>
        <th>Search</th>
    </tr>
<?php
if(isset($history)){
    foreach($history as $hist){?>
        <tr>
            <td><?php echo $hist['date']; ?></td>
            <td><a href="<?php echo $hist['url'] ?>"><?php echo $hist['query']; ?></a></td>
        </tr>

    <?php }
}//end if isset($history)
?>
</table>

<!-- delete search history -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="userid" value="<?php echo $_SESSION["user"]["id"]; ?>">
        <input type="submit" name="delete" value="Delete Search History" class="btn btn-danger pull-right">
    </form>
</div>


<?php
$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";
?>