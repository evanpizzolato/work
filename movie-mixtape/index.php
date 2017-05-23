<?php
//error_reporting(0);
header('X-Frame-Options: GOFORIT');
//API TMDb
// API Key (v3 auth): 6dcd7369f481c153eb36b8d8b3b36d2c
// API Read Access Token (v4 auth): eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2ZGNkNzM2OWY0ODFjMTUzZWIzNmI4ZDhiM2IzNmQyYyIsInN1YiI6IjU5MDM2ZWU2YzNhMzY4M2I4NTAwMGVjYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Gjh3XeuF5vYbGuO2pGUSrBKBrj40dd-kILrpVtb-BU8

require_once('tmdb_v3-PHP-API--master/tmdb-api.php');
require_once("php-gracenote-master/php-gracenote/Gracenote.class.php");

// if you have no $conf it uses the default config
$tmdb = new TMDB();

//Insert your API Key of TMDB
//Necessary if you use default conf
$tmdb->setAPIKey('6dcd7369f481c153eb36b8d8b3b36d2c');

//API Gracenote
//UserID: 49074523971384348-098F3E759728E0FB43D21A4D269E12C5
//ClientID: 212930051
//ClientTag: 3E34D5DF274F7301E4B2E684C66EEB2A
$graceApi = new Gracenote\WebAPI\GracenoteWebAPI('212930051', '3E34D5DF274F7301E4B2E684C66EEB2A', '49074523971384348-098F3E759728E0FB43D21A4D269E12C5');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MOVIE MIXTAPE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>

  <div class="container-fluid">
<header>
  <div class="row">
      <div class="col-md-12  div-info">
        <div class="responsive-title">
          <h1>Movie Mixtape</h1>
        </div>

        <div class="howto-container">
          <h1 class="movie-mixtape-title text-center">Movie Mixtape</h1>
          <p>
            Enter your favourite (or not) musical artist in the search bar below. Based on their genre, Movie Mixtape will recommend something to watch. Please be patient for results to load. <br /><br />
            <span class="header-star">*</span>Hint<span class="header-star">*</span> The more obcure the artist,
            the better the results.
          </p>
        </div>

      </div>
    </div>
  </header>
<!------------------- FORM!------------------>
<section>

          <div class="row">
            <div class="col-sx-12">
              <div class="form-output-container">
                <form method="POST" action="" class="form-inline">
                    <div class="row text-center">
                        <div class="col-xs-12 form-n-button">
                            <input type="search" name="artist" placeholder="Enter Artist" class="form-control form__input" id="inputArtist">
                            <button type="submit" name="submit" class="btn-col btn btn-info button round">Search</button>

                    </div>
                </form>














    <?php

        //////////////////////////////////////// START OF OUTPUT ////////////////////////////////

    if (isset($_POST['artist']) && empty($_POST['artist'])) {
        echo "<div class='not_set text-center'>ENTER AN ARTIST. FIELD CANNOT BE BLANK</div>";
    } else

    if (isset($_POST['submit'])) {


        $results = $graceApi->searchArtist($_POST['artist']);
        $genreArray = array();
        foreach ($results as $genres) :
            $genreArray[] = $genres['genre'];
        endforeach;

        $genreArraySmall = array();
        foreach ($genreArray[0] as $genres) :
            $genreArraySmall[] = $genres['text'];
        endforeach;

        //var_dump($genreArraySmall);

        $rand = mt_rand(0,19);



        //finds specific word in the array
        $hipHopIn = in_array("Hip-Hop", $genreArraySmall);
        $hipHopPreg = preg_grep("/Hip-Hop/", $genreArraySmall);

        $popIn = in_array("Pop", $genreArraySmall);
        $popPreg = preg_grep("/Pop/", $genreArraySmall);

        $latinIn = in_array("Latin", $genreArraySmall);
        $latinPreg = preg_grep("/Latin/", $genreArraySmall);

        $bluesIn = in_array("Blues", $genreArraySmall);
        $bluesPreg = preg_grep("/Blues/", $genreArraySmall);

        $classicalIn = in_array("Classical", $genreArraySmall);
        $classicalPreg = preg_grep("/Classical/", $genreArraySmall);

        $worldIn = in_array("World", $genreArraySmall);
        $worldPreg = preg_grep("/World/", $genreArraySmall);

        $electronicaIn = in_array("Electronica", $genreArraySmall);
        $electronicaPreg = preg_grep("/Electronica/", $genreArraySmall);

        $countryIn = in_array("Country", $genreArraySmall);
        $countryPreg = preg_grep("/Country/", $genreArraySmall);

        $comedyIn = in_array("Comedy", $genreArraySmall);
        $comedyPreg = preg_grep("/Comedy/", $genreArraySmall);

        $folkIn = in_array("Folk", $genreArraySmall);
        $folkPreg = preg_grep("/Folk/", $genreArraySmall);

        $punkIn = in_array("Punk", $genreArraySmall);
        $punkPreg = preg_grep("/Punk/", $genreArraySmall);

        $newAgeIn = in_array("New Age", $genreArraySmall);
        $newAgePreg = preg_grep("/New Age/", $genreArraySmall);

        $rockIn = in_array("Rock", $genreArraySmall);
        $rockPreg = preg_grep("/Rock/", $genreArraySmall);

        $rnbIn = in_array("R&B", $genreArraySmall);
        $rnbPreg = preg_grep("/R&B/", $genreArraySmall);

        $soulIn = in_array("Soul", $genreArraySmall);
        $soulPreg = preg_grep("/Soul/", $genreArraySmall);

        $soundtrackIn = in_array("Soundtrack", $genreArraySmall);
        $soundtrackPreg = preg_grep("/Soundtrack/", $genreArraySmall);

        $reggaeIn = in_array("Reggae", $genreArraySmall);
        $reggaePreg = preg_grep("/Reggae/", $genreArraySmall);

        $gospelIn = in_array("Gospel", $genreArraySmall);
        $gospelPreg = preg_grep("/Gospel/", $genreArraySmall);

        $metalIn = in_array("Metal", $genreArraySmall);
        $metalPreg = preg_grep("/Metal/", $genreArraySmall);

        $hardcoreIn = in_array("Hardcore", $genreArraySmall);
        $hardcorePreg = preg_grep("/Hardcore/", $genreArraySmall);

        $danceIn = in_array("Dance", $genreArraySmall);
        $dancePreg = preg_grep("/Dance/", $genreArraySmall);

        $houseIn = in_array("House", $genreArraySmall);
        $housePreg = preg_grep("/House/", $genreArraySmall);

        $oldiesIn = in_array("Oldies", $genreArraySmall);
        $oldiesPreg = preg_grep("/Oldies/", $genreArraySmall);

        $jazzIn = in_array("Jazz", $genreArraySmall);
        $jazzPreg = preg_grep("/Jazz/", $genreArraySmall);

        $indieIn = in_array("Indie", $genreArraySmall);
        $indiePreg = preg_grep("/Indie/", $genreArraySmall);

        $intelligentIn = in_array("Intelligent", $genreArraySmall);
        $intelligentPreg = preg_grep("/Intelligent/", $genreArraySmall);


        if ($hipHopPreg || $hipHopIn) {
            $movieGenres = $tmdb->getMoviesByGenre(28);
            $hipHopArray = array();
            foreach($movieGenres as $movie) :
                $hipHopArray[] = $movie->getID();
            endforeach;


            $movieID = $hipHopArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $trailer = 'https://www.youtube.com/watch?v='.$movies->getTrailer();
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster text-center" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';





        } if (($hipHopPreg || $hipHopIn) && ($electronicaIn || $electronicaPreg)) {
            $movieGenres = $tmdb->getMoviesByGenre(53);
            $hipHopArray = array();
            foreach($movieGenres as $movie) :
                $hipHopArray[] = $movie->getID();
            endforeach;


            $movieID = $hipHopArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($popIn || $popPreg) {
            $movieGenres = $tmdb->getMoviesByGenre(16);
            $popArray = array();
            foreach($movieGenres as $movie) :
                $popArray[] =  $movie->getID();
            endforeach;

            $movieID = $popArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($punkIn || $punkPreg) {
            $movieGenres = $tmdb->getMoviesByGenre(99);
            $punkArray = array();
            foreach($movieGenres as $movie) :
                $punkArray[] =  $movie->getID();
            endforeach;

            $movieID = $punkArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

            //var_dump($movieJSON);

        } if ($electronicaIn || $electronicaPreg) {
            $movieGenres = $tmdb->getMoviesByGenre(878);
            $electronicaArray = array();
            foreach($movieGenres as $movie) :
                $electronicaArray[] =  $movie->getID();
            endforeach;

            $movieID = $electronicaArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($metalIn || $metalPreg || $hardcoreIn || $hardcorePreg) {
            $movieGenres = $tmdb->getMoviesByGenre(27);
            $metalArray = array();
            foreach($movieGenres as $movie) :
                $metalArray[] =  $movie->getID();
            endforeach;

            $movieID = $metalArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($bluesIn || $bluesPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(37);
            $bluesArray = array();
            foreach ($movieGenres as $movie) :
                $bluesArray[] = $movie->getID();
            endforeach;

            $movieID = $bluesArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($classicalIn || $classicalPreg || $oldiesIn || $oldiesPreg || $jazzIn || $jazzPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(36);
            $classicalArray = array();
            foreach ($movieGenres as $movie) :
                $classicalArray[] = $movie->getID();
            endforeach;

            $movieID = $classicalArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($latinIn || $latinPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(35);
            $latinArray = array();
            foreach ($movieGenres as $movie) :
                $latinArray[] = $movie->getID();
            endforeach;

            $movieID = $latinArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($countryIn || $countryPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(10752);
            $countryArray = array();
            foreach ($movieGenres as $movie) :
                $countryArray[] = $movie->getID();
            endforeach;

            $movieID = $countryArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($indieIn || $indiePreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(10402);
            $indieArray = array();
            foreach ($movieGenres as $movie) :
                $indieArray[] = $movie->getID();
            endforeach;

            $movieID = $indieArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($danceIn || $dancePreg || $houseIn || $housePreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(16);
            $danceArray = array();
            foreach ($movieGenres as $movie) :
                $danceArray[] = $movie->getID();
            endforeach;

            $movieID = $danceArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($rnbIn || $rnbPreg || $soulIn || $soulPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(10749);
            $rnbArray = array();
            foreach ($movieGenres as $movie) :
                $rnbArray[] = $movie->getID();
            endforeach;

            $movieID = $rnbArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';


        } if ($newAgeIn || $newAgePreg || $worldIn || $worldPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(18);
            $newAgerray = array();
            foreach ($movieGenres as $movie) :
                $newAgeArray[] = $movie->getID();
            endforeach;

            $movieID = $newAgeArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($reggaeIn || $reggaePreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(35);
            $reggaeArray = array();
            foreach ($movieGenres as $movie) :
                $reggaeArray[] = $movie->getID();
            endforeach;

            $movieID = $reggaeArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($soundtrackIn || $soundtrackPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(10402);
            $soundtrackArray = array();
            foreach ($movieGenres as $movie) :
                $soundtrackArray[] = $movie->getID();
            endforeach;

            $movieID = $soundtrackArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($comedyIn || $comedyPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(80);
            $comedyArray = array();
            foreach ($movieGenres as $movie) :
                $comedyArray[] = $movie->getID();
            endforeach;

            $movieID = $comedyArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        } if ($intelligentIn || $intelligentPreg ) {
            $movieGenres = $tmdb->getMoviesByGenre(99);
            $intelligentArray = array();
            foreach ($movieGenres as $movie) :
                $intelligentArray[] = $movie->getID();
            endforeach;

            $movieID = $intelligentArray[$rand]; //captures the ID from the first search result
            $movies = $tmdb->getMovie($movieID);
            $movieJSON = json_decode($movies->getJSON(), True); //gets back all movie data related to ID. decodes for use.

            echo '<h1 class="text-center title">'.$movieJSON['title'] . '</h1><br>';
            echo '<a href="http://www.imdb.com/title/'.$movieJSON['imdb_id'].'"><img class="poster" src="https://image.tmdb.org/t/p/w640'.$movieJSON['poster_path'] . '"></a><br>';
            echo '<p class="description text-left">'.$movieJSON['overview']. '</p><br>';

        }






    }
    /////////////////////////////// END OF OUTPUT //////////////////////////

    ?>
            </div>
        </div>
    </div>

  </section>


</div>








<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
