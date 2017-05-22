<?php

class Transaction {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTransactions($id) {

        $idSani = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $query = "SELECT * FROM tw_transactions
                    WHERE TW_Accounts_id = :id
                    ORDER BY date desc";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id', $idSani, PDO::PARAM_INT);
        $pdostmt->execute();
        $transactions = $pdostmt->fetchAll();
        $pdostmt->closeCursor();

        return $transactions;
    }


    public function addTransaction ($dateEntry, $amount, $id, $cId) {

        $dateEntrySani = filter_var($dateEntry, FILTER_SANITIZE_STRING);
        $amountSani = filter_var($amount, FILTER_SANITIZE_STRING);
        $idSani = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $cIdSani = filter_var($cId, FILTER_SANITIZE_NUMBER_INT);

        $query = "INSERT INTO tw_transactions 
                       (date, amount, TW_Accounts_id, TW_Categories_id)
                       VALUES(:date, :amount, :TW_Accounts_id, :TW_Categories_id)";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':date', $dateEntrySani, PDO::PARAM_STR);
        $pdostmt->bindValue(':amount', $amountSani, PDO::PARAM_STR);
        $pdostmt->bindValue(':TW_Accounts_id', $idSani, PDO::PARAM_INT);
        $pdostmt->bindValue(':TW_Categories_id', $cIdSani , PDO::PARAM_INT);
        $row = $pdostmt->execute();
    }

}

