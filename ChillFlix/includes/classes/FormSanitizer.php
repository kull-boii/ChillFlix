<?php
class FormSanitizer {

    // sanitize form string just helps us to get proper and valid inputs from the user
    // main aim is to remove any whitespaces and to capitalize the first char of the name
    // making it static so that we can call the function without any object 
    public static function sanitizeFormString($inputText) {
        $inputText = strip_tags($inputText); // to prevent any html tags to be inserted
        $inputText = trim($inputText); // to remove any whitespaces (if present)
        $inputText = strtolower($inputText);
        $inputText = ucfirst($inputText); // upperCase First Char
        return $inputText;
    }

    public static function sanitizeFormUsername($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }

    public static function sanitizeFormPassword($inputText) {
        $inputText = strip_tags($inputText);
        return $inputText;
    }

    public static function sanitizeFormEmail($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }

}
?>