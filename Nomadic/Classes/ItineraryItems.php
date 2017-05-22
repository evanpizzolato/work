<?php

class ItineraryItems
    
{
    public function getItineraryItems($db) {
        
        $query = "SELECT * FROM itinerary_items";
        $statement = $db->prepare($query);
        $statement->execute();
        $vacations = $statement->fetchAll();
        $statement->closeCursor();

        return $vacations;
    }
    
    public function getItineraryItemsByVacation($db, $vacation_id) {
        
        $query = "SELECT * FROM itinerary_items WHERE vacation_id = :vacation_id ORDER BY date, time_start ASC";
        
        $vacation_idSani = filter_var($vacation_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':vacation_id', $vacation_idSani);
        $statement->execute();
        $activities = $statement->fetchAll();
        $statement->closeCursor();
        
        return $activities;        
    }
    
    public function getItineraryItem($db, $id){
        
        $query = "SELECT i.id, i.name, i.description, i.notes, i.time_start, i.time_end, i.location, i.date, i.vacation_id, v.users_id FROM itinerary_items i, vacations v WHERE i.id = :id AND i.vacation_id = v.id";
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $vacation = $statement->fetch();
        $statement->closeCursor();
        
        return $vacation;
    }
    
    public function newItineraryItem ($db, $name, $description, $notes, $time_start, $time_end, $location, $date, $vacation_id){
        
        $query = "INSERT INTO itinerary_items (name, description, notes, time_start, time_end, location, date, vacation_id) 
            VALUES
            (:name, :description, :notes, :time_start, :time_end, :location, :date, :vacation_id)";
        
        $nameSani = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $descriptionSani = filter_var($description, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $notesSani = filter_var($notes, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $time_startSani =filter_var($time_start, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $time_endSani = filter_var($time_end, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $locationSani =filter_var($location, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $dateSani =filter_var($date, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $vacation_idSani =filter_var($vacation_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':name', $nameSani);
        $pdostmt->bindValue(':description', $descriptionSani);
        $pdostmt->bindValue(':notes', $notesSani);
        $pdostmt->bindValue(':time_start', $time_startSani);
        $pdostmt->bindValue(':time_end', $time_endSani);
        $pdostmt->bindValue(':location', $locationSani);
        $pdostmt->bindValue(':date', $dateSani);
        $pdostmt->bindValue(':vacation_id', $vacation_idSani);
        $pdostmt->execute();
        $pdostmt->closeCursor();

    }
    
    public function editItineraryItem ($db, $name, $description, $notes, $time_start, $time_end, $location, $date, $id) {
        
        $query = "UPDATE itinerary_items SET name = :name, description = :description, notes = :notes, time_start = :time_start, time_end = :time_end, location = :location, date = :date WHERE id = :id";
        
        $nameSani = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $descriptionSani = filter_var($description, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $notesSani = filter_var($notes, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $time_startSani = filter_var($time_start, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $time_endSani = filter_var($time_end, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $locationSani = filter_var($location, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $dateSani = filter_var($date, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $nameSani);
        $statement->bindValue(':description', $descriptionSani);
        $statement->bindValue(':notes', $notesSani);
        $statement->bindValue(':time_start', $time_startSani);
        $statement->bindValue(':time_end', $time_endSani);
        $statement->bindValue(':location', $locationSani);
        $statement->bindValue(':date', $dateSani);
        $statement->bindValue(':id', $idSani);
        $statement->execute();        
    
    }
    
    public function deleteItineraryItem ($db, $id) {
        
        $query = 'DELETE FROM itinerary_items WHERE id = :id';
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $statement->closeCursor();

    }
}