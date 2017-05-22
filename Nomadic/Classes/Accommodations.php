<?php

/**
 * Created by PhpStorm.
 * User: evan
 * Date: 2017-03-19
 * Time: 5:44 PM
 */
class Accommodations
{


    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAccommodations($Destinations_id, $Exp_Levels_id) {
        $db = $this->db;

        $query = "SELECT * FROM locations 
                  WHERE location_categories_id = 2 
                  AND destinations_id = :Destinations_id
                  AND exp_levels_id = :Exp_Levels_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":Destinations_id", $Destinations_id, PDO::PARAM_INT);
        $statement->bindValue(":Exp_Levels_id", $Exp_Levels_id, PDO::PARAM_INT);
        $statement->execute();
        
        $hotels = $statement->fetchAll();
        $statement->closeCursor();

        return $hotels;
    }
}
?>