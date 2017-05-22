<?php
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
        $results = $search->searchForum($trimmed);

        if (empty($results)) {
            $errRlt = "No Results Returned.";
        }

        //grab current URL to use in search history.

        $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

        //add into search history
        $search->addSearchHist($date, $query, $url, $_SESSION["user"]["id"]);
    }

}

?>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline">
        <input type="hidden" name="date" value="<?php $date = new DateTime(); echo $date->format('Y-m-d-H:i:s'); ?>">
        <input type="hidden" name="userid" value="<?php echo $_SESSION["user"]["id"]; ?>">
        <input type="search" name="query" placeholder="Search Forum..." results="5" value="<?php if(isset($query)){echo $query;} ?>" class="form-control">
        <input type="submit" name="submit" value="Search" class="btn btn-default">
    </form>
<?php
if(isset($_GET['submit'])){?>
    <div class="jumbotron">
        <h3>Search results</h3>
    <table class="table table-hover">
		<tr>
			<th>Category Name</th>
			<th>Category Description</th>
			<th>Topic Title</th>
			<th>Topic Date</th>
			<th>Reply</th>
			<th>Reply Date</th>
			<th>Username</th>
		</tr>
<?php }?>
        <?php
        if (isset($results)){
            foreach($results as $result){ ?>
			<tr>
                <td><?php echo  $result['name'];?></td>
                <td><?php echo $result['description'];?></td>
                <td><?php echo $result['title']; ?></td>
                <td><?php echo $result['date']; ?></td>
                <td><?php echo $result['content']; ?></td>
                <td><?php echo $result[5]; ?></td>
                <td><?php echo $result['username']; ?></td>
			</tr>

                <?php
            }
        }?>
		
    </table>
    </div>