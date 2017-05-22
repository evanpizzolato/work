<?php

/*
THIS IS A LIBRARY FOR VALIDATION FUNCTIONS CONTAINING VALIDATION FOR:
    - Empty validation
    - Integer validation
    - Minimum length validation
    - Maximum length validation
    - Email validation
    - Email confirmation validation
    - Password validation (min. 8 chars, req. 1 capital letter, req. 1 number)
    - Password confirmation validation
    - Phone
    - Date
    - Boolean
    - Float
*/

class Validation
{
    //VARIABLES
        private $inputs = [];
        private $input = "";
        public $message = "";
        private $flag = false;

    //CONSTRUCTOR FOR VALIDATION OBJECT
        public function __construct(){
            $this->inputs = [];
            $this->input = "";
            $this->message = "";
            $this->flag = false;
        }
    
    //SET METHODS
        public function setInputs(...$valueIn){
            $this->inputs = $valueIn;
        }

        public function setInput($valueIn){
            $this->input = $valueIn;
        }
    
        public function setMessage($valueIn){
            $this->message = $valueIn;
        }

        public function setFlag() {
            $this->flag = true;
        }
        

    //GET METHODS
        public function getInputs() {
            return $this->inputs;
        }

        public function getInput() {
            return $this->input;
        }
    
        public function getMessage() {
            return $this->message;
        }

        public function getFlag() {
            return $this->flag;
        }
    
    
    //VALIDATION METHODS
        //EMPTY
    public function validateEmpty () {
        if(empty($this->input)) {
            $this->message = "None of these fields can be empty!";
            $this->setFlag();
            return $this->message;
        } else {
            $this->message = "Valid!";
            return $this->message;
        }
    }
        
        //INTEGER
    public function validateInteger () {
        if(!filter_var($this->input, FILTER_VALIDATE_INT)==true) {
            $this->message = "This must be an integer!";
            $this->setFlag();
            return $this->message;
        } else {
            $this->message = "Valid!";
            return $this->message;
        }
    }
    
        //MINIMUM LENGTH (OF A STRING)
    public function validateMinLength ($minLength) {
        if(strlen($this->input) < $minLength) {
            $this->message = "The minimum length of this string is " . $minLength . " characters!";
            $this->setFlag();
            return $this->message;
        }
    }
    
        //MAXIMUM LENGTH (OF A STRING)
    public function validateMaxLength ($maxLength) {
        if(strlen($this->input) > $maxLength) {
            $this->message = "The maximum length of this string is " . $maxLength . " characters!";
            $this->setFlag();
            return $this->message;
        }
    }
    
    
        //EMAIL
    public function validateEmail () {
        if(!filter_var($this->input, FILTER_VALIDATE_EMAIL)==true) {
            $this->message = "This must be a valid email address!";
            $this->setFlag();
            return $this->message;
        } else {
            $this->message = "Valid!";
            return $this->message;
        }
    }
    
        //EMAIL CONFIRM
    public function validateEmailConfirm ($valueIn) {
        if($this->input !== $valueIn) {
            $this->message = "This must be the same email address!";
            $this->setFlag();
            return $this->message;
        }
    }
    
        //PASSWORD
    public function validatePassword () {
        if(!preg_match('/^(?=.*\d)(?=.*[A-Z])[0-9A-Za-z!@#$%]{8,30}$/', $this->input)) {
            $this->message = "Your password must contain one number, one capital letter, and must be between 8-30 characters!";
            $this->setFlag();
            return $this->message;
        } else {
            $this->message = "Valid password";
            return $this->message;
        }
    }
    
        //PASSWORD CONFIRM
    public function validatePasswordConfirm ($valueIn) {
        if($this->input !== $valueIn) {
            $this->message = "This must be the same password!";
            $this->setFlag();
            return $this->message;
        }
    }
    
        //PHONE
    public function validatePhone () {
        if(!preg_match('/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i', $this->input)) {
            $this->message = "This is not a valid phone number!";
            $this->setFlag();
            return $this->message;
        } else {
            $this->message = "Valid!";
            return $this->message;
        }
    }
    
        //DATE
    public function validateDate () {
        $dateArray = explode('-', $this->input);
        if (count($dateArray) == 3) {
            if (checkdate($dateArray[1], $dateArray[2], $dateArray[0])) {
                $this->message = "This is a valid date!";
                return $this->message;
            } else {
                $this->message = "Your date must consist of day, month, and year in a YYYY-MM-DD format!";
                $this->setFlag();
                return $this->message;
            }
        } else {
            $this->message = "Your date must consist of day, month, and year in a YYYY-MM-DD format!";
            $this->setFlag();
            return $this->message;
        }
    }
    
    
        //BOOLEAN
    public function validateBoolean() {
        if(filter_var($this->input, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)!==null) {
            $this->message = "Valid!";
            return $this->message;
        } else {
            $this->message = "This must be a true or false value!";
            $this->setFlag();
            return $this->message;

        }
    }
        
        //FLOAT
    public function validateFloat () {
        if(filter_var($this->input, FILTER_VALIDATE_FLOAT)==false) {
            $this->message = "This must be a float!";
            $this->setFlag();
            return $this->message;
        } else {
            $this->message = "Valid!";
            return $this->message;
        }
    }
    
    
}

?>