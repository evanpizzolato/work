<?php

/**
 * Created by PhpStorm.
 * User: evan
 * Date: 2017-04-04
 * Time: 12:26 PM
 */
class Votes
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllTopics()
    {
        $db = $this->db;

        $query = "SELECT * FROM forum_topics";
        $statement = $db->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $topics = $statement->fetchAll();
        $statement->closeCursor();

        return $topics;
    }

    public function updateVotesUp($id)
    {
        $db = $this->db;

        $query = "UPDATE forum_topics SET total = total +1 WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        //$statement->bindValue(":value", $value, PDO::PARAM_INT);
        $statement->bindValue(":id", $id, PDO::PARAM_STR);
        $updateVotesUp = $statement->execute();
        $statement->closeCursor();

        return $updateVotesUp;
    }

    public function updateVotesDown($id)
    {
        $db = $this->db;

        $query = "UPDATE forum_topics SET total = total -1 WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        //$statement->bindValue(":value", $value, PDO::PARAM_INT);
        $statement->bindValue(":id", $id, PDO::PARAM_STR);
        $updateVotesDown = $statement->execute();
        $statement->closeCursor();

        return $updateVotesDown;
    }

    public function getTotal($id)
    {
        $db = $this->db;

        $query = "SELECT total FROM forum_topics WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->bindValue(":id", $id, PDO::PARAM_STR);
        $statement->execute();
        $getTotal = $statement->fetchAll();
        $statement->closeCursor();

        return $getTotal;
    }
}