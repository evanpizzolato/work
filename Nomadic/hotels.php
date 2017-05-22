<?php

  $page_title = "Hotels";
  require_once "includes/header.php";
  ob_start();

  $activitiesObject = new Activities();
  $destinations = $locations->getDestination();

?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="css/booking.css">
      <title>Flight and Hotel Bookings</title>
  </head>
  <body>
  <div class="col-lg-9">
    <?php
    if(isset($_POST['submit']))
    {
      $accomodations = $locations->getLocByType($_POST['destinations'], 2, NULL);
      echo "<h1>Available Hotels</h1>";
    ?>
    <table>
      <?php foreach ($accomodations as $hotel) { ?>
        <tr>
          <div class="col-lg-3" id="hotelimage">
            <td><img src="<?php echo($hotel['filePath']); ?>"/></td>
          </div>
          <td>
            <?php echo($hotel['name']);?><br/>
            <?php echo($hotel['description']);?><br/>
            <?php echo($hotel['phone']);?><br/>
            <?php echo($hotel['website']);?><br/>
            <div class="col-lg-3">
              <form action="hotelbooking.php">
                  <input type="submit" value="Book Now" />
              </form>
            </div>
          </td>
        </tr>
        <?php }; };?>
    </table>
  </div>
  </body>
</html>

<?php

$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";

?>
