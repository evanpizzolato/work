<?php

  $page_title = "Bookings";
  require_once "includes/header.php";
  ob_start();

  $activitiesObject = new Activities($db);
  $destinations = $locations->getDestination();

?>
        <div class="col-sm-12">
          <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified">
              <li class="active"><a href="#Flightstab" data-toggle="tab"><img src="media/booking/airplane.svg" width="100px" height="100px"></a></li>
              <li><a href="#Hotelstab" data-toggle="tab"><img src="media/booking/bed.svg" width="100px" height="100px"></a></li>
            </ul>
          </div>
            <div class="tab-content">
              <div class="tab-pane fade in active"  id="Flightstab">
                <h3>Book your Flight today!</h3>
                    <div data-skyscanner-widget="SearchWidget" data-button-label="Search" data-currency="CAD" data-locale="en-US"></div>
                    <script src="https://widgets.skyscanner.net/widget-server/js/loader.js" async></script>
              </div>
              <div class="tab-pane fade"  id="Hotelstab">
                <h3>Book your Hotel now!</h3>
                  <div class="container-fluid">
                      <form class="form-horizontal" method="post" action="hotels.php">
                          <div class="form-group">
                            <label class="form-label">Going To:</label>
                              <select name='destinations' class="form-control">
                              <option value="">Choose a city...</option>
                              <?php
                              foreach ($destinations as $destination) :
                                  echo "<option value=\"".$destination["id"]. "\">" .$destination["city"] . ", " .$destination["country"]."</option>";
                              endforeach;
                              ?>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="checkIn">Check In:</label>
                            <input type="date" class="form-control" id="checkIn">
                            <label for="checkOut">Check Out:</label>
                            <input type="date" class="form-control" id="checkOut">
                          </div>
                          <div class="form-inline">
                            <div class="form-group">
                              <label for="rooms">Rooms:</label>
                              <select class="form-control" id="rooms">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <label for="adults">Adults:</label>
                              <select class="form-control" id="adults">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <label for="child">Children:</label>
                              <select class="form-control" id="child">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>
                          </div>
                          <br/>
                          <div class="form-group text-center">
                              <input class="btn btn-success btn-lg" type="submit" name="submit" value="Search"/>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
          </div>
<div class="container-fluid">
</div><div class="container-fluid jumbotron">
              <div>
                <h2 class="bookheader">Featured Cities</h2>
              </div>
              <div class="row formcol">
                <div class="col-md-4">
                  <h4 class="bookheader">Tulum, Mexico</h4>
                  <img class="bookimage" src="media/booking/tulumcrop.png" width="200px" height="200px"><br>
                  <text class="citydescription">Tulum is relaxation and romance with an ancient angle. Guests can enjoy modern takes on traditional Mayan massage and spa treatments, or sunbathe on gorgeous Yucatan beaches within site of well-preserved ancient ruins. A rare mix of beach, archeology and village, Tulum is a romantic getaway like no other.</text>
                </div>
                <div class="col-md-4">
                  <h4 class="bookheader">Budapest, Hungary</h4>
                  <img class="bookimage" src="media/booking/budapestcrop.png" width="200px" height="200px"><br>
                  <text class="citydescription">Over 15 million gallons of water bubble daily into Budapest's 118 springs and boreholes. The city of spas offers an astounding array of baths, from the sparkling Gellert Baths to the vast 1913 neo-baroque Szechenyi Spa to Rudas Spa, a dramatic 16th-century Turkish pool with original Ottoman architecture. The "Queen of the Danube" is also steeped in history, culture and natural beauty. Get your camera ready for the Roman ruins of the Aquincum Museum, Heroes' Square and Statue Park, and the 300-foot dome of St. Stephen's Basilica.</text>
                </div>
                <div class="col-md-4">
                  <h4 class="bookheader">Bangkok, Thailand</h4>
                  <img class="bookimage" src="media/booking/bangkokcrop.png" width="200px" height="200px"><br>
                  <text class="citydescription">Bangkok is full of exquisitely decorated Buddhist temples—as you go from one to the next you’ll be continually blown away by the craftsmanship and elabourate details. But if you’d rather seek enlightenment in a gourmet meal, or dance the night away, you’ll also enjoy Bangkok—the restaurant and nightclub scenes here are among the best in the world.</text>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="readmore">
                    <a href="http://localhost/carmen-sandiego/nomadic/citypages.php?search=Tulum&submit=Go">Read More >></a>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="readmore">
                    <a href="http://localhost/carmen-sandiego/nomadic/citypages.php?search=Budapest&submit=Go">Read More >></a>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="readmore">
                    <a href="http://localhost/carmen-sandiego/nomadic/citypages.php?search=Bangkok&submit=Go">Read More >></a>
                  </div>
                </div>
              </div>
          </div>
<?php

  $page_content = ob_get_contents();
  ob_end_clean();
  include_once "includes/dash.php";
  require_once "includes/footer.php";

?>
