<?php

class Vacation
{
    public function getVacations($db){
        
        $query = "SELECT * FROM vacations ORDER BY date_start ASC";
        $statement = $db->prepare($query);
        $statement->execute();
        $vacations = $statement->fetchAll();
        $statement->closeCursor();

        return $vacations;
    }
    
    public function getVacationById($db, $id) {
        $query = "SELECT v.id, v.length, v.name, v.date_start, v.date_end, v.users_id, v.destinations_id, d.city FROM vacations v, destinations d WHERE v.id = :id AND v.destinations_id = d.id";
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $vacation = $statement->fetch();
        $statement->closeCursor();
        
        return $vacation;        
    }
    
    public function getVacationsByUser($db, $users_id) {
        $query = "SELECT v.id, v.length, v.name, v.date_start, v.date_end, v.users_id, v.destinations_id, d.city FROM vacations v, destinations d WHERE users_id = :users_id AND v.destinations_id = d.id";
        
        $users_idSani = filter_var($users_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':users_id', $users_idSani);
        $statement->execute();
        $vacations = $statement->fetchAll();
        $statement->closeCursor();
        
        return $vacations;
    }
    
    public function newVacation($db, $length, $name, $date_start, $date_end, $users_id, $destinations_id) {
        
        $query = "INSERT INTO vacations (length, name, date_start, date_end, users_id, destinations_id) 
            VALUES
            (:length, :name, :date_start, :date_end, :users_id, :destinations_id)";
        
        $nameSani = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $lengthSani = filter_var($length, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_startSani = filter_var($date_start, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_endSani = filter_var($date_end, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $users_idSani = filter_var($users_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);        
        $destinations_idSani = filter_var($destinations_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':length', $lengthSani);        
        $pdostmt->bindValue(':name', $nameSani);
        $pdostmt->bindValue(':date_start', $date_startSani);
        $pdostmt->bindValue(':date_end', $date_endSani);
        $pdostmt->bindValue(':users_id', $users_idSani);        
        $pdostmt->bindValue(':destinations_id', $destinations_idSani);
        $pdostmt->execute();
        $pdostmt->closeCursor();

    }
    
    public function editVacation($db, $length, $name, $date_start, $date_end, $destinations_id, $id) {
        
        $query = "UPDATE vacations SET length = :length, name = :name, date_start = :date_start, date_end = :date_end, destinations_id = :destinations_id WHERE id = :id";
        
        $nameSani = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $lengthSani = filter_var($length, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_startSani = filter_var($date_start, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_endSani = filter_var($date_end, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $destinations_idSani = filter_var($destinations_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':length', $lengthSani);        
        $statement->bindValue(':name', $nameSani);
        $statement->bindValue(':date_start', $date_startSani);
        $statement->bindValue(':date_end', $date_endSani);
        $statement->bindValue(':destinations_id', $destinations_idSani);
        $statement->bindValue(':id', $idSani);
        $statement->execute();        
    }
    
    public function deleteVacation ($db, $id) {
        
        $query = 'DELETE FROM vacations WHERE id = :id';
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $statement->closeCursor();
    }
    
}
?>