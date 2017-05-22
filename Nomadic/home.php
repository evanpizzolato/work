<?php
$page_title = "Home";
require "includes/header.php";
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy();
}
?>
            <div id="home-carousel" class="carousel slide" data-ride="carousel" style="height: 550px; overflow: hidden">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#home-carousel" data-slide-to="1"></li>
                    <li data-target="#home-carousel" data-slide-to="2"></li>

                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="media/bangkok3home.jpg" alt="Bangkok">
                        <div class="carousel-caption">
                            <h3>Lose Yourself</h3>
                            <p>In Bangkok</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="media/budapest1home.jpg" alt="Bangkok">
                        <div class="carousel-caption">
                            <h3>Discover Yourself</h3>
                            <p>In Budapest</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="media/tulum3home.jpg" alt="Bangkok">
                        <div class="carousel-caption">
                            <h3>Find Your Bliss</h3>
                            <p>In Tulum</p>
                        </div>
                    </div>

                    
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class='container-fluid'>
                <div class="row text-center">
                    <div class='col-sm-12 col-xs-12'>
                        <img src="media/logo.svg" class='homeLogo'>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div id="home-info" class="row text-center">
                    
                    <div class="col-sm-3 col-xs-6"><img src="media/feature-icons/Itinerary.svg" alt="Wallet" class='homeIcon' id='itineraryIcon'>
                        <h3 class='homeTitle'>Plan</h3>
                        <h4 class='homeSubtitle'>Start your next voyage on the right foot</h4>
                        <p>Nomadic offers a myriad of features dedicated to helping you make the most of your next adventure, from itinerary planners to budget managers</p>    
                    </div>
                    
                    <div class="col-sm-3 col-xs-6"><img src="media/feature-icons/Curator.svg" alt="Curator" class='homeIcon' id='curatorIcon'>
                    <h3 class='homeTitle'>Curate</h3>
                    <h4 class='homeSubtitle'>Adventures, <br>tailored just for you</h4>
                    <p>One of Nomadic's keystone features, our Curator finds the best accomodations and activities and curates a trip based on you and your budget</p>    
                    </div>
                    
                    <div class="col-sm-3 col-xs-6"><img src="media/feature-icons/Events.svg" alt="Events" class='homeIcon' id='eventsIcon'>
                    <h3 class='homeTitle'>Connect</h3>
                    <h4 class='homeSubtitle'>Travelling together, done better</h4>
                    <p>Through our featured events, forum, and city pages, Nomadic makes it easy to connect and link up with other Nomads or share your knowledge with the world</p>    
    
                    </div>
                    
                    <div class="col-sm-3 col-xs-6"><img src="media/feature-icons/Cities.svg" alt="Cities" class='homeIcon' id='citiesIcon'>
                    <h3 class='homeTitle'>and More</h3>
                    <h4 class='homeSubtitle'>Endless possibilities, limitless potential</h4>
                    <p>Whether you want to find out the down low about your next travel destination or book your next place to stay, Nomadic can make it happen</p>    
    
                    </div>
                </div>
            </div>        
<?php
require_once "includes/footer.php";
?>
    </body>
</html>