<?php

    class DbConnect {
        
        private $host = "juliamlim.com:3306";
        private $dbname = "wwwjulia_nomadic";
        private $user = "wwwju_admin";
        private $pass = "Carmen#5";
        private $db;
        
        public function getDb(){
            try {
                $this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pass);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $this->db;
        }
    }
?>