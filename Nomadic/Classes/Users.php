<?php

class Users {
    
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    
    //gets all usernames for the user-management function
    public function allUsernames() {
        $db = $this->db;
        
        $query = "SELECT * FROM users";
        $getStmt = $db->prepare($query);
        $getStmt->execute();
        
        $users = $getStmt->fetchAll(PDO::FETCH_OBJ);
        
        return $users;
    }
    public function getUser($id) {
        $db = $this->db;
        
        $query = "SELECT * FROM users WHERE username = :id";
        $getStmt = $db->prepare($query);
        $getStmt->bindValue(':id', $id, PDO::PARAM_STR);
        $getStmt->execute();
        
        $dbPass = $getStmt->fetch();
        
        return $dbPass;
    }
    public function deleteUser($id) {
        $db = $this->db;
        $query = "DELETE FROM users WHERE username = :id";
        
        $delStmt = $db->prepare($query);
        $delStmt->bindValue(':id', $id, PDO::PARAM_STR);
        
        $delStmt->execute();
        $delStmt->closeCursor();
    }
    public function getUserRoles() {
        $db = $this->db;
        
        $query = "SELECT * FROM user_roles";
        $getStmt = $db->prepare($query);
        $getStmt->execute();
        
        $users = $getStmt->fetchAll(PDO::FETCH_OBJ);
        
        return $users;
    }
    public function newUser($username, $email, $password, $first, $last, $role) {
        $db = $this->db;
        
        $id = uniqid();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sanitizeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        // If role does not equal either nomad or advertisement accounts, default to nomad
        if ($role == "advertise") {
            $role = 3;
        } else {
            $role = 2;
        }

        $query = "INSERT INTO users (id, username, firstname, lastname, email, password, user_roles_id) VALUES (:id, :user, :first, :last, :email, :pass, :ur_id)";
        $addStmt = $db->prepare($query);

        $addStmt->bindValue(':id', $id, PDO::PARAM_STR);
        $addStmt->bindValue(':user', $username, PDO::PARAM_STR);
        $addStmt->bindValue(':email', $sanitizeEmail, PDO::PARAM_STR);
        $addStmt->bindValue(':pass', $passwordHash, PDO::PARAM_STR);
        $addStmt->bindValue(':first', $first, PDO::PARAM_STR);
        $addStmt->bindValue(':last', $last, PDO::PARAM_STR);
        $addStmt->bindValue(':ur_id', $role, PDO::PARAM_INT);
        $addStmt->execute();
        
        $newChat = fopen("xml/".$id.".xml","w");
        fwrite($newChat, "<?xml version='1.0' encoding='UTF-8'?>");
        fwrite($newChat, "<map id='".$id."'>");
        fwrite($newChat, "<markers/>");
        fwrite($newChat, "</map>");
    }
    //Function to check if the username is taken
    // it's outside the add new user function so that function only runs after everthing is valid
    public function usernameCheck($username) {
        $db = $this->db;
        
        $query = "SELECT username FROM users WHERE username = :username";
        $chkStmt = $db->prepare($query);
        $chkStmt->bindValue(':username', $username, PDO::PARAM_STR);
        $chkStmt->execute();
        
        $dbUsername = $chkStmt->fetch();
        
        if ($chkStmt->rowCount() == 0) {
            return true;
        } else {
            return [false, error => "Sorry this username is taken."];
        }
    }
    //This function validates the users credentials against the info in the database
    public function userLogin($username, $password) {
        $db = $this->db;
        
        $query = "SELECT * FROM users WHERE username = :username";
        $chkStmt = $db->prepare($query);
        $chkStmt->bindValue(':username', $username, PDO::PARAM_STR);
        $chkStmt->execute();
        
        $dbPass = $chkStmt->fetch();
        
        if($chkStmt->rowCount() == 0) {
            return ["error"=>"Sorry username not found.", "login" => false];
        } else if (password_verify($password, $dbPass["password"])) {
            return ["user" => $dbPass, "login" => true];
        } else {
            return ["error"=>"Sorry password is incorrect.", "login" => false ];
        }
    }
    public function updateUser($id, $first, $last, $email, $password, $birthday) {
        $db = $this->db;
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sanitizeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        $query = "UPDATE users SET firstname=:first, lastname=:last, email=:email, password=:pass, birthday=:birth, WHERE id = :id";
        $chgStmt = $db->prepare($query);
        $chgStmt->bindValue(':first', $first, PDO::PARAM_STR);
        $chgStmt->bindValue(':last', $last, PDO::PARAM_STR);
        $chgStmt->bindValue(':email', $sanitizeEmail, PDO::PARAM_STR);
        $chgStmt->bindValue(':pass', $passwordHash, PDO::PARAM_STR);
        $chgStmt->bindValue(':birth', $birthday, PDO::PARAM_STR);
        $chgStmt->execute();
    }
}

?>