<?php

class Category {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCategories() {

        $query = "SELECT * FROM tw_categories";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->execute();

        $categories = $pdostmt->fetchAll();

        return $categories;
    }
}

