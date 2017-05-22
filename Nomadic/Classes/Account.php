<?php

class Account
{
    private $db;

    public function __construct($db)
{
    $this->db = $db;
}

    //get all accounts belonging to user (by user id)
    public function getAccounts ($id) {

        $idSani = filter_var($id, FILTER_SANITIZE_STRING);

        $query = "SELECT * FROM tw_accounts WHERE users_id = :id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id', $id, PDO::PARAM_STR);
        $pdostmt->execute();
        $accounts = $pdostmt->fetchAll();
        $pdostmt->closeCursor();

        return $accounts;
    }

    //get a single account (by account id)

    public function getOneAccount($id) {

        //$idSani = filter_var($id, FILTER_SANITIZE_INT);

        $query = "SELECT * FROM tw_accounts WHERE id = :id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostmt->execute();
        $account = $pdostmt->fetch();
        $pdostmt->closeCursor();

        return $account;

    }

    //add an account
    public function addAccount($date, $name, $balance, $id) {

        $dateSani = filter_var($date, FILTER_SANITIZE_STRING);
        $nameSani = filter_var($name, FILTER_SANITIZE_STRING);
        $balanceSani = filter_var($balance, FILTER_SANITIZE_STRING);
        $idSani = filter_var($id, FILTER_SANITIZE_STRING);

        $query = "INSERT INTO tw_accounts
              (created, name, balance, users_id)
              VALUES(:created, :name, :balance, :users_id)";

        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':created', $dateSani, PDO::PARAM_STR);
        $pdostmt->bindValue(':name', $nameSani, PDO::PARAM_STR);
        $pdostmt->bindValue(':balance', $balanceSani, PDO::PARAM_STR);
        $pdostmt->bindValue(':users_id', $idSani, PDO::PARAM_STR);
        $row = $pdostmt->execute();
        $pdostmt->closeCursor();

    }

    //delete an account
    public function deleteAccount($id) {

       // $idSani = filter_var($id, FILTER_SANITIZE_INT);

        $query = "DELETE FROM tw_accounts WHERE id = :id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id', $id, PDO::PARAM_INT);
        $row = $pdostmt->execute();
        $pdostmt->closeCursor();

    }

    //rename account/update balance

    public function updateNameBalance($id, $bal, $name) {

        $balSani = filter_var($bal, FILTER_SANITIZE_STRING);
        $nameSani = filter_var($name, FILTER_SANITIZE_STRING);

        $query = "UPDATE tw_accounts 
                  SET name = :name,
                   balance = :balance
                 WHERE id = :id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostmt->bindValue(':balance', $balSani, PDO::PARAM_STR);
        $pdostmt->bindValue(':name', $nameSani, PDO::PARAM_STR);
        $row = $pdostmt->execute();

    }

}