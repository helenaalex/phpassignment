<?php 
    //function to clean user input of all unnecessary and malicious characters
    function validate($input) {
        $input = trim(stripslashes(htmlspecialchars($input)));
        return $input;
    }

    //function to check if subject is not empty
    function valsubject($input) {
        if (empty($input)) {
            $_SESSION['subjectErr'] = "Select an option";
            $_SESSION['valid'] = false;
        } else {
            return $input;  
        }   
    }

    //function to check if name is not empty and contains only letters, digits and whitespaces
    function valname($input) {
        if (empty($input)) {
            $_SESSION['nameErr'] = "Name is required";
            $_SESSION['valid'] = false;
        } else {
            $input = validate($input);
            if (!preg_match("/^[a-zA-Z 0-9\s]*$/",$input)) {
                $_SESSION['nameErr'] = "Only letters, digits and whitespaces are allowed";
                $_SESSION['valid'] = false;
            }
            return $input;
        }
    }

    //function to check if phone number is not empty and has correct format 
    function valtel($input) {
        if (empty($input)) {
            $_SESSION['telErr'] = "Phone number is required";
            $_SESSION['valid'] = false;
        } else {
            $input = filter_var(validate($input), FILTER_SANITIZE_NUMBER_INT);
            if (strlen($input) < 10 || strlen($input) > 15) {
                $_SESSION['telErr'] = "Phone number should contain from 10 to 15 characters";
                $_SESSION['valid'] = false;
            }
            return $input;
        }
    }

    //function to check if email is not empty and has correct format
    function valemail($input) {
        if (empty($input)) {
            $_SESSION['emailErr'] = "E-mail is required";
            $_SESSION['valid'] = false;
        } else {
            $input = validate($input);
            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['emailErr'] = "Invalid E-mail format";
                $_SESSION['valid'] = false;
            }
            return $input;
        } 
    }

    //message field can be left empty, but should still be validated
    function valmes($input) {
        if (!empty($input)) {
            $input = validate($input);
            return $input;
        }
    }
