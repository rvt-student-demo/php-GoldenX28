<?php

class FormManager {
    public static function isPostRequest() {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }

    public static function isGetRequest() {
        return $_SERVER["REQUEST_METHOD"] == "GET";
    }

    public static function saveDataToCsv($data) {
        $file = fopen("data.csv", "a");
        fputcsv($file, $data);
        fclose($file);
    }

    public static function redirectToPage($pageName) {
        header("Location: " . $pageName);
        exit();
    }

    /**
     * return empty array if no erorrs, or assoc array with current errors
     */
    public static function validateFormData($data) {
        $formErrors = [];
        if (!preg_match("/^[a-zA-Z0-9\s]+$/", $data[0])) {
            $formErrors["name"] = "Name must contain only letters and digits";
        } 
        if (filter_var($data[1], FILTER_VALIDATE_EMAIL) == false) {
            $formErrors["email"] = "Email not valid";
        } 
        if (strlen($data[2]) <= 10) {
            $formErrors["message"] = "Message must contain more than 10 letters";
        }
        return $formErrors;
    }

    public static function getInputError($inputField) {
        if (isset($_SESSION["form_errors"][$inputField])
        && !empty($_SESSION["form_errors"][$inputField])) {
            return $_SESSION["form_errors"][$inputField];
        }
    }

} 