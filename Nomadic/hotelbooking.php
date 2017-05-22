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
    <meta charset="utf-8">
    <title>Hotel Reservation Form</title>
  </head>
  <body>
    <div class="jumbotron">
      <form class="form-control" method="post" action="hotelreservation.php">
        <div class="form-group">
          <h1 class="heading">Reserve Your Room</h1>
          <div class="form-group">
            <label class="form-label" for="name">Name:</label>
            <input type="input" id="name" class="form-control" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="input" id="email" class="form-control" name="email">
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="input" id="phone" class="form-control" name="phone">
          </div>
              <div class="col-2-3">
                <div class="form-group">
                <label for="address">Address:</label>
                 <input type="input" id="address" class="form-control" name="address">
                </div>
              </div>
              <div class="col-2-3">
                <div class="form-group">
                  <label for="city">City:</label>
                  <input type="input" id="city" class="form-control" name="city">
                </div>
              </div>
              <div class="col-1-3">
                <div class="form-group">
                  <label for="postalcode">Postal Code: </label>
                  <input type="input" id="postalcode" class="form-control" name="postalcode">
                </div>
              </div>
            <div class="form-group">
              <label for="country">Country:</label>
              <input type="input" id="country" class="form-control" name="country">
            </div>
        </div>
        <div class="form-group">
          <h2 class="heading">Details</h2>
          <div class="form-inline">
            <div class="controls">
              <label for="checkin" class="label-date"><i class="fa fa-calendar"></i>Check-In:</label>
              <input type="date" id="checkin" class="form-control" name="checkin" value="<?php echo date('Y-m-d'); ?>">
              <label for="checkout" class="label-date"><i class="fa fa-calendar"></i>Check-Out:</label>
              <input type="date" id="checkout" class="form-control" name="checkout" value="<?php echo date('Y-m-d'); ?>" />
            </div>
          </div>
          <div class="col-1-4 col-1-4-sm">
            <div class="form-group">
            </div>
          </div>
          <div class="col-1-3 col-1-3-sm">
            <div class="form-inline">
              <label for="rooms">Rooms:</label>
              <select class="form-control" name="rooms">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
              <label for="adults">Guests:</label>
              <select class="form-control" name="guests">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
           </div>
              <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea name="comments" class="form-control" id="comments">Please describe your needs e.g. Extra beds, children's cots etc.</textarea>
              </div>
          <button type="submit" class="btn btn-primary btn-block">Reserve</button>
        </div>
      </form>
    </div>
  </body>
</html>

<?php

$page_content = ob_get_contents();
ob_end_clean();
include_once "includes/dash.php";
require_once "includes/footer.php";

?>
