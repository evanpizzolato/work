<?php

class FeedbackForm
{
    public function _construct($db) {
        return $db;
    }

    public function getForms($db){

        $query = "SELECT * FROM contact_form";
        
        $pdostmt = $db->prepare($query);
        $pdostmt->execute();
        $forms = $pdostmt->fetchAll();
        $pdostmt->closeCursor();

        return $forms;
    }
    
    public function getForm($db, $id){
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "SELECT * FROM contact_form WHERE id = :id";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $form = $statement->fetch();
        $statement->closeCursor();
        
        return $form;
    }
    
    public function newForm ($db, $firstname, $lastname, $address, $country, $email, $phone, $subject, $comment, $date_submitted, $users_id) {
        $firstnameSani = filter_var($firstname, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $lastnameSani = filter_var($lastname, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $addressSani = filter_var($address, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $countrySani = filter_var($country, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $emailSani = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $phoneSani = filter_var($phone, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $subjectSani = filter_var($subject, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $commentSani = filter_var($comment, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_submittedSani = filter_var($date_submitted, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $users_idSani = filter_var($users_id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "INSERT INTO contact_form (firstname, lastname, address, country, email, phone, subject, comment, date_submitted, users_id) VALUES (:firstname, :lastname, :address, :country, :email, :phone, :subject, :comment, :date_submitted, :users_id)";
        
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':firstname', $firstnameSani);
        $pdostmt->bindValue(':lastname', $lastnameSani);
        $pdostmt->bindValue(':address', $addressSani);
        $pdostmt->bindValue(':country', $countrySani);
        $pdostmt->bindValue(':email', $emailSani);
        $pdostmt->bindValue(':phone', $phoneSani);
        $pdostmt->bindValue(':subject', $subjectSani);
        $pdostmt->bindValue(':comment', $commentSani);
        $pdostmt->bindValue(':date_submitted', $date_submittedSani);
        $pdostmt->bindValue(':users_id', $users_idSani);
        $pdostmt->execute();
        $pdostmt->closeCursor();
        
        return true;        
    }
    
    
    /*public function newForm ($db ,$f_name, $l_name, $address, $country, $email, $phone, $subject, $comment, $date_submitted) {
        
        $f_nameSani = filter_var($f_name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $l_nameSani = filter_var($l_name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $addressSani = filter_var($address, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $countrySani = filter_var($country, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $emailSani = filter_var($email, FILTER_SANITIZE_EMAIL, FILTER_FLAG_ENCODE_AMP);
        $phoneSani = filter_var($phone, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $subjectSani = filter_var($subject, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $commentSani = filter_var($comment, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_submittedSani = filter_var($date_submitted, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "INSERT INTO contact_form (firstname, lastname, address, country, email, phone, subject, comment, date_submitted) 
            VALUES
            (:f_name, :l_name, :address, :country, :email, :phone, :subject, :comment, :date_submitted)";
        
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':firstname', $f_nameSani);
        $pdostmt->bindValue(':lastname', $l_nameSani);
        $pdostmt->bindValue(':address', $addressSani);
        $pdostmt->bindValue(':country', $countrySani);
        $pdostmt->bindValue(':email', $emailSani);
        $pdostmt->bindValue(':phone', $phoneSani);
        $pdostmt->bindValue(':subject', $subjectSani);
        $pdostmt->bindValue(':comment', $commentSani);
        $pdostmt->bindValue(':date_submitted', $date_submittedSani);        
        $pdostmt->execute();
        $pdostmt->closeCursor();
        
        return true;
        
    }*/
    
    public function deleteForm($db, $id){
        
        $query = 'DELETE FROM contact_form WHERE id = :id';
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $statement->closeCursor();
        
        return true;
    }
    
    public function editForm ($db, $firstname, $lastname, $address, $country, $email, $phone, $subject, $comment, $date_edited, $edit_reason, $reply_status, $id) {
        
        $firstnameSani = filter_var($firstname, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $lastnameSani = filter_var($lastname, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $addressSani = filter_var($address, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $countrySani = filter_var($country, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $emailSani = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $phoneSani = filter_var($phone, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $subjectSani = filter_var($subject, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $commentSani = filter_var($comment, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $date_editedSani = filter_var($date_edited, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $edit_reasonSani = filter_var($edit_reason, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $reply_statusSani = filter_var($reply_status, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        
        $query = "UPDATE contact_form SET firstname = :firstname, lastname = :lastname, address = :address, country = :country, email = :email, phone = :phone, subject = :subject, comment = :comment, date_edited = :date_edited, edit_reason = :edit_reason, reply_status = :reply_status WHERE id = :id";
        
        $statement = $db->prepare($query);
        
        $statement->bindValue(':firstname', $firstnameSani);
        $statement->bindValue(':lastname', $lastnameSani);
        $statement->bindValue(':address', $addressSani);
        $statement->bindValue(':country', $countrySani);
        $statement->bindValue(':email', $emailSani);
        $statement->bindValue(':phone', $phoneSani);
        $statement->bindValue(':subject', $subjectSani);
        $statement->bindValue(':comment', $commentSani);
        $statement->bindValue(':date_edited', $date_editedSani);
        $statement->bindValue(':edit_reason', $edit_reasonSani);
        $statement->bindValue(':reply_status', $reply_statusSani);
        $statement->bindValue(':id', $idSani);
        
        $statement->execute();
        $statement->closeCursor();
        
        return true;
        
    }
    
    
    /*public function editForm($db, $f_name, $l_name, $address, $country, $email, $phone, $subject, $comment, $date_edited, $edit_reason, $reply_status, $id){
                                          
        $f_nameSani = filter_var($f_name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $l_nameSani = filter_var($l_name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $addressSani = filter_var($address, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $countrySani = filter_var($country, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $emailSani = filter_var($email, FILTER_SANITIZE_EMAIL, FILTER_FLAG_ENCODE_AMP);
        $phoneSani = filter_var($phone, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $subjectSani = filter_var($subject, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $commentSani = filter_var($comment, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $date_editedSani = filter_var($date_edited, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);  
        $edit_reasonSani = filter_var($edit_reason, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);  
        $reply_statusSani = filter_var($reply_status, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        $idSani = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);        
        
        $query = "UPDATE contact_form SET f_name = :f_name, l_name = :l_name, address = :address, country = :country, email = :email, phone = :phone, subject = :subject, comment = :comment, date_edited = :date_edited, edit_reason = :edit_reason, reply_status = :reply_status WHERE id = :id";
        
        $statement = $db->prepare($query);
        
        $statement->bindValue(':f_name', $f_nameSani);
        $statement->bindValue(':l_name', $l_nameSani);
        $statement->bindValue(':address', $addressSani);
        $statement->bindValue(':country', $countrySani);
        $statement->bindValue(':email', $emailSani);
        $statement->bindValue(':phone', $phoneSani);
        $statement->bindValue(':subject', $subjectSani);
        $statement->bindValue(':comment', $commentSani);
        $statement->bindValue(':date_edited', $date_editedSani);
        $statement->bindValue(':edit_reason', $edit_reasonSani);
        $statement->bindValue(':reply_status', $reply_statusSani);        
        $statement->bindValue(':id', $idSani);
        $statement->execute();
        $statement->closeCursor();
        
        return true;
    }*/
    
}