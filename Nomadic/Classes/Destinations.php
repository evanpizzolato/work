<?php

class Destination
{

    public function getDestinations($db){

        $query = "SELECT * FROM destinations";
        $selectStatement = $db->prepare($query);
        $selectStatement->execute();
        $destinations = $selectStatement->fetchAll();
        $selectStatement->closeCursor();

        return $destinations;
    }
    
    public function getDestination($db, $city){
        
        $citySani = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "SELECT * FROM destinations WHERE city = :city";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':city', $citySani);
        $statement->execute();
        $destination = $statement->fetch();
        $statement->closeCursor();
        
        return $destination;
    }
    
    public function getDestinationById($db, $id){
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "SELECT * FROM destinations WHERE id = :id";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $destination = $statement->fetch();
        $statement->closeCursor();
        
        return $destination;
    }    
    
    public function newDestination($db, $city, $state, $country, $lat, $lng, $population, $languages, $climate, $advisory) {
        
        $citySani = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $stateSani = filter_var($state, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $countrySani = filter_var($country, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $latSani = filter_var($lat, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $lngSani = filter_var($lng, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $populationSani = filter_var($population, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $languagesSani = filter_var($languages, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $climateSani = filter_var($climate, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $advisorySani = filter_var($advisory, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "INSERT INTO destinations (city, state, country, lat, lng, population, languages, climate, advisory) 
            VALUES
            (:city, :state, :country, :lat, :lng, :population, :languages, :climate, :advisory)";
        $insertStatement = $db->prepare($query);
        $insertStatement->bindValue(':city', $citySani);
        $insertStatement->bindValue(':state', $stateSani);
        $insertStatement->bindValue(':country', $countrySani);
        $insertStatement->bindValue(':lat', $latSani);
        $insertStatement->bindValue(':lng', $lngSani);
        $insertStatement->bindValue(':population', $populationSani);
        $insertStatement->bindValue(':languages', $languagesSani);
        $insertStatement->bindValue(':climate', $climateSani);
        $insertStatement->bindValue(':advisory', $advisorySani);
        $insertStatement->execute();
        $insertStatement->closeCursor();
    }
    
    
    public function editDestination($db, $city, $state, $country, $lat, $lng, $population, $languages, $climate, $advisory, $id){

        $citySani = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $stateSani = filter_var($state, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $countrySani = filter_var($country, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $latSani = filter_var($lat, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $lngSani = filter_var($lng, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $populationSani = filter_var($population, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $languagesSani = filter_var($languages, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $climateSani = filter_var($climate, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $advisorySani = filter_var($advisory, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);

        
        $query = "UPDATE destinations SET city = :city, state = :state, country = :country, lat = :lat, lng = :lng, population = :population, languages = :languages, climate = :climate, advisory = :advisory WHERE id = :id";
        
        $updateStatement = $db->prepare($query);
        
        $updateStatement->bindValue(':city', $citySani);
        $updateStatement->bindValue(':state', $stateSani);
        $updateStatement->bindValue(':country', $countrySani);
        $updateStatement->bindValue(':lat', $latSani);
        $updateStatement->bindValue(':lng', $lngSani);
        $updateStatement->bindValue(':population', $populationSani);
        $updateStatement->bindValue(':languages', $languagesSani);
        $updateStatement->bindValue(':climate', $climateSani);
        $updateStatement->bindValue(':advisory', $advisorySani);
        $updateStatement->bindValue(':id', $idSani);
        $updateStatement->execute();
        $updateStatement->closeCursor();
        
    }
    
    public function deleteDestination ($db, $id) {
        $query = 'DELETE FROM destinations where id = :id';
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $statement->closeCursor();
        
        return true;
    }
}

?>