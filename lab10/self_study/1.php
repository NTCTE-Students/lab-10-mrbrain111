<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

class ValidationException extends Exception {}

$emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('Неверный формат email');
        }
        echo "Email-адрес корректен: $email";
    } catch (ValidationException $e) {
        $emailErr = $e->getMessage();
    } finally {
        echo "<br>Проверка завершена.";
    }
}

?>
