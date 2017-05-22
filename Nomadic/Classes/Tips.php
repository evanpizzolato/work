<?php

class Tips {
    
    public function getTips($db) {
        
        $query = "SELECT * FROM tips";
        $selectStatement = $db->prepare($query);
        $selectStatement->execute();
        $tips = $selectStatement->fetchAll();
        $selectStatement->closeCursor();
        
        return $tips;
    }
    
    public function getTipById($db, $id) {
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
            
        $query = "SELECT t.content, t.date_added, t.date_edited, t.users_id, t.id, u.username, d.city FROM tips t, users u, destinations d
        WHERE t.id = :id AND t.users_id = u.id AND t.destinations_id = d.id";
        
        $statement= $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $tip = $statement->fetch();
        $statement->closeCursor();
        
        return $tip;
        
    }
    
    public function getTipsByCity($db, $destinations_id) {
        
        $destinations_idSani = filter_var($destinations_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "SELECT t.content, t.date_added, t.date_edited, t.users_id, t.id, u.username FROM tips t, destinations d, users u WHERE t.destinations_id = d.id AND t.destinations_id = :destinations_id AND t.users_id = u.id ORDER BY t.date_added";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':destinations_id', $destinations_idSani);
        $statement->execute();
        $tips = $statement->fetchAll();
        $statement->closeCursor();
        
        return $tips;
 
    }
    
    public function newTip($db, $content, $date_added, $users_id, $destinations_id) {
        $query = "INSERT INTO tips (content, date_added, users_id, destinations_id) VALUES (:content, :date_added, :users_id, :destinations_id)";
        
        $contentSani = filter_var($content, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_addedSani = filter_var($date_added, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $users_idSani = filter_var($users_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);        
        $destinations_idSani = filter_var($destinations_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $insertStatement = $db->prepare($query);
        $insertStatement->bindValue(':content', $contentSani);
        $insertStatement->bindValue(':date_added', $date_addedSani);
        $insertStatement->bindValue(':users_id', $users_id);        
        $insertStatement->bindValue(':destinations_id', $destinations_idSani);
        $insertStatement->execute();
        $insertStatement->closeCursor();
        
    }
    
    public function editTip ($db, $content, $date_edited, $id) {
        $query = "UPDATE tips SET content = :content, date_edited = :date_edited WHERE id = :id";
        
        $contentSani = filter_var($content, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_editedSani = filter_var($date_edited, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':content', $contentSani);
        $statement->bindValue(':date_edited', $date_editedSani);
        $statement->bindValue(':id', $idSani);
        
        $statement->execute();
    }
    
    public function deleteTip ($db, $id) {
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = 'DELETE FROM tips WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $statement->closeCursor();
        
        return true;
    }
        
}

?>