<?php

class Search {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
//search query function
public function search($searchQ){

        $searchQSani = filter_var($searchQ, FILTER_SANITIZE_STRING);

        //$query = "SELECT * FROM search WHERE name = :searchQ";
        $query = "SELECT * FROM search WHERE name LIKE '%{$searchQSani}%'";
        $pdostmt = $this->db->prepare($query);
        //$pdostmt->bindValue(':searchQ', $searchQ, PDO::PARAM_STR);
        $pdostmt->bindvalue($searchQSani, PDO::PARAM_STR);
        $pdostmt->execute();
        $results = $pdostmt->fetchAll();
        $pdostmt->closeCursor();

        return $results;
}
//insert into search history function
public function addSearchHist($date, $searchQ, $url, $id){

    $dateSani = filter_var($date, FILTER_SANITIZE_STRING);
    $searchQSani = filter_var($searchQ, FILTER_SANITIZE_STRING);
    $urlSani = filter_var($url, FILTER_VALIDATE_URL);
    $idSani = filter_var($id, FILTER_SANITIZE_STRING);

    $query = "INSERT INTO search_history
              (date, query, url, users_id)
              VALUES(:date, :searchQ, :url, :id)";
     $pdostmt = $this->db->prepare($query);
     $pdostmt->bindValue(':date', $dateSani, PDO::PARAM_STR);
     $pdostmt->bindValue(':searchQ', $searchQSani, PDO::PARAM_STR);
     $pdostmt->bindValue(':url', $urlSani, PDO::PARAM_STR);
     $pdostmt->bindValue(':id', $idSani, PDO::PARAM_STR);
     $row = $pdostmt->execute();
     $pdostmt->closeCursor();
}

//view search history
public function getSearchHist($id){

    $idSani = filter_var($id, FILTER_SANITIZE_STRING);

    $query = "SELECT * FROM search_history 
              WHERE users_id = :id 
              ORDER BY date DESC";
    $pdostmt = $this->db->prepare($query);
    $pdostmt->bindValue(':id', $idSani, PDO::PARAM_STR);
    $pdostmt->execute();
    $searchHist = $pdostmt->fetchAll();
    $pdostmt->closeCursor();

    return $searchHist;

}

//delete search history
public function deleteSearchHist($id) {

    $idSani = filter_var($id, FILTER_SANITIZE_STRING);

    $query = "DELETE FROM search_history WHERE users_id = :id";
    $pdostmt = $this->db->prepare($query);
    $pdostmt->bindValue(':id', $idSani, PDO::PARAM_STR);
    $row = $pdostmt->execute();
    $pdostmt->closeCursor();
}

//add new searchable feature

public function addSearchFeat($name, $description, $link){

    $nameSani = filter_var($name, FILTER_SANITIZE_STRING);
    $descriptionSani = filter_var($description, FILTER_SANITIZE_STRING);
    $linkSani = filter_var($link, FILTER_SANITIZE_STRING);

    $query = "INSERT INTO search 
              (name, description, url) 
              VALUES(:name, :description, :link)";
    $pdostmt = $this->db->prepare($query);
    $pdostmt->bindValue(':name', $nameSani, PDO::PARAM_STR);
    $pdostmt->bindValue(':description', $descriptionSani, PDO::PARAM_STR);
    $pdostmt->bindValue(':link', $linkSani, PDO::PARAM_STR);
    $row = $pdostmt->execute();
    $pdostmt->closeCursor();

}

//search forum
public function searchForum($searchQ){

    $searchQSani = filter_var($searchQ, FILTER_SANITIZE_STRING);

    $query = "SELECT forum_categories.name, forum_categories.description, forum_topics.title, forum_topics.date, forum_replies.content, 
              forum_replies.date, users.username 
              FROM forum_categories 
              LEFT JOIN forum_topics ON forum_categories.id = forum_topics.forum_categories_id 
              LEFT JOIN forum_replies ON forum_replies.forum_topics_id = forum_topics.id 
              LEFT JOIN users ON forum_topics.users_id = users.id 
              WHERE forum_categories.name LIKE '%{$searchQSani}%' 
              OR forum_categories.description LIKE '%{$searchQSani}%' 
              OR forum_topics.title LIKE '%{$searchQSani}%' 
              OR forum_replies.content LIKE '%{$searchQSani}%'
              OR users.username LIKE '%{$searchQSani}%'";
    $pdostmt = $this->db->prepare($query);
    $pdostmt->bindValue($searchQSani, PDO::PARAM_STR);
    $pdostmt->execute();
    $results = $pdostmt->fetchAll();
    $pdostmt->closeCursor();

    return $results;
}


}//end Search Class