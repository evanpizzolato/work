<?php 
class FormValidate {
    
    private $errors;
    public function __construct($required){
        $this->required = $required;
    }
    
    public function validation($items) {
        
        //$this->validate = $items;
        
        //next steps Required
        //if (!empty) - then check validation
        //if is empty and required go through the required feild check
        $form_errors = true;
        
        foreach($items as $key => $item) {
            if (in_array($key, $this->required) && empty($item)) {
                $this->errors[$key] = "This field is required.";
            } else if (!empty($item)) {
                switch($key){
                    case "name":
                        if (preg_match("/[0-9_+.,!@#$%^&*();\\/|<>\"\']/", $item)) {
                            $this->errors[$key] = $key . " can not contain any numbers.";
                        } else {
                            $this->errors[$key] = "";
                        }
                        break;
                    case "email":
                        if (!filter_input(INPUT_POST, $item, FILTER_VALIDATE_EMAIL)){
                            $this->errors[$key] = "Enter a valid e-mail.";
                        } else {
                            $this->errors[$key] = "";
                        }
                        break;
                    case "message":
                        if (preg_match('/(fuck|shit|dick)/', $item)) {
                            $this->errors[$key] = "Your profanity is not appreciated.";
                        } else {
                            $this->errors[$key] = "";
                        }
                        break;
                    default:
                        $this->errors[$key] = ""; 
                        break;
                }
            } else {
                $this->errors[$key] = "";
            }
        }
        $errors = array_filter($this->errors);
        
        if (!empty($errors)) {
            $form_errors = false;
        }
        
        return $form_errors;
    }
    
    public function formErrors($success) {
        if($this->validation()=== false) {
            header('Location:'.$success);
        } else {
            foreach($formValid->errors as $key => $item) {
                echo "<br/>".$key." : ".$item."<br/>";
            }   
        }
    }
}
?>
                                    