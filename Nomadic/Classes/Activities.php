<?php

/**
 * Created by PhpStorm.
 * User: evan
 * Date: 2017-03-19
 * Time: 6:21 PM
 */
class Activities
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getActivities($Destinations_id)
    {

        $query = "SELECT * FROM locations 
                  WHERE location_categories_id = 1 
                  AND destinations_id = :Destinations_id";
        $statement = $this->db->prepare($query);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $statement->bindValue(":Destinations_id", $Destinations_id, PDO::PARAM_STR);
        $statement->execute();
        $activities = $statement->fetchAll();
        $statement->closeCursor();

        return $activities;
    }

}