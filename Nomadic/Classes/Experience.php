<?php

/**
 * Created by PhpStorm.
 * User: evan
 * Date: 2017-03-16
 * Time: 3:59 PM
 */
class Experience
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getExperienceName()
    {

        $query = "SELECT * FROM exp_levels WHERE id = 1 OR id = 2 OR id = 3"; //add and where statement WHERE el.name DOESNT equal 'ALL'
        $statement = $this->db->prepare($query);
        $statement->execute();
        $experienceType = $statement->fetchAll();
        $statement->closeCursor();

        return $experienceType;
    }


}