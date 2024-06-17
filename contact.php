<?php

include "classes/FormManager.php";
session_start();

// Declare empty array for form errors
$formErrors = [];

if (FormManager::isPostRequest()) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $formData = [$name, $email, $message];
    $_SESSION["form_errors"] = FormManager::validateFormData($formData);

    if (empty($formErrors)) {
        FormManager::saveDataToCsv($formData);
    }
    FormManager::redirectToPage("contact.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "inc/head.php";?>
<body>
    <?php include "inc/navigation.php";?>
    <p>Šeit būs kontakt forma ar mani.</p>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <span class="text-error">
            <?php echo FormManager::getInputError("name");?>
        </span>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <span class="text-error">
            <?php echo FormManager::getInputError("email");?>
        </span>

        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea>
        <span class="text-error">
            <?php echo FormManager::getInputError("message");?>
        </span>

        <input type="submit" value="Submit">
    </form>
</body>
</html>