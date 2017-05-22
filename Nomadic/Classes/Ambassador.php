<?php 

class Ambassador
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    //get point total from forum_topics to check if a user is an ambassador
    
    public function getTotal($id) {
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING);
        
        $query = "SELECT SUM(total) FROM forum_topics
                  WHERE :id = users_id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id', $idSani, PDO::PARAM_STR);
        $pdostmt->execute();
        $total = $pdostmt->fetch();
        $pdostmt->closeCursor();
        
        return $total;        
    }
    
    //get image path to display next to user 
    
    public function getBadge($id) {
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING);
        
        $query = "SELECT filePath FROM ambassador_categories
                  WHERE :id = id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostmt->execute();
        $path = $pdostmt->fetch();
        $pdostmt->closeCursor();
        
        return $path;
        
    }
    
    
}//end class Ambassador