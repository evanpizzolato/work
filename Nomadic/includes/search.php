    <form method="get" action="searchresults.php" id="main-search-form" class="navbar-form container-fluid">
        <input type="hidden" name="date" value="<?php $date = new DateTime(); echo $date->format('Y-m-d-H:i:s'); ?>">
        <input type="hidden" name="userid" value="<?php echo $_SESSION["user"]["id"]; ?>">
        <div class="input-group">
            <input type="search" id="main-search" name="query" placeholder="Search..." results="5" value="<?php if(isset($query)){echo $query;} ?>" class="form-control col-xs-12" style="display: inline-block"><div id="main-search-btn" class="input-group-addon"><button type="submit" name="submit" style="background:none;border:none; padding:0"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></div>
        </div>
    </form>





