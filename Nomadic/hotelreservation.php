<?php

  $page_title = "Reservation";
  require_once "includes/header.php";
  ob_start();

?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>Reservation Confirmation</title>
      <link rel="stylesheet" type="text/css" href="css/booking.css">
  </head>
  <body>
    <div class="jumbotron">
        <?php
        if(isset($_POST['submit'])){
          echo "<div>";
          echo "<h1>Booking Complete!</h1><br/>";
          echo "<h3>Your reservation ID is: </h3> . <?php rand(11000,12000)?>";
          echo "</div>";
          ?>
        <table>
            <tr>
              <h2>Booking Details</h2>
                <div class="col-lg-3" id="hotelimage">
                  <td><img src="media/booking/hotel1.jpg"/></td>
                </div>
                <td>
                  Rooms: <?php echo($_POST['rooms']);?><br/>
                  Check-In/Check-Out:<?php echo($_POST['checkin']);?> . <?php echo($_POST['checkout']);?><br/>
                  Occupants:<?php echo($_POST['guests']);?><br/>
                <div class="col-lg-3">
                  Comments:<?php echo($_POST['comments']);?>
                </div>
                </td>
            </tr>
        </table><br/>
        <div class="col-lg-9">
          <div class="form-control"><h2>Guest Details</h2></div><br/>
          <div class="form-control">Guest: <?php echo($_POST['name']);?></div><br/>
          <div class="form-control">Email: <?php echo($_POST['email']);?></div><br/>
          <div class="form-control">Phone: <?php echo($_POST['phone']);?></div><br/>
          <div class="form-control">From: <?php echo($_POST['city']);?> . <?php echo($_POST['country']);?></div>
        </div>
    </div>
  </body>
</html>

<?php

$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";

?>
