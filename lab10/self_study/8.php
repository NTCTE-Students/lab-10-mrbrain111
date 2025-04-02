<?php

class ValidationException extends Exception {}
class ShortPasswordException extends ValidationException {}
class InvalidEmailException extends ValidationException {}
class EmptyFieldException extends ValidationException {}
function validatePassword($password) {
    if (strlen($password) < 6) {
        throw new ShortPasswordException("Пароль слишком короткий. Минимальная длина 6 символов.");
    }
}
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidEmailException("Неверный формат email.");
    }
}
function validateFields($fields) {
    foreach ($fields as $field => $value) {
        if (empty($value)) {
            throw new EmptyFieldException("Поле '$field' не должно быть пустым.");
        }
    }
}
try {
    $formData = [
        'username' => 'john_dindon',
        'email' => 'john.dindon@example.com',
        'password' => '12345',
        'confirm_password' => '12345'
    ];

    validateFields($formData);
    validateEmail($formData['email']);
    validatePassword($formData['password']);

    echo "Регистрация успешна!<br>";
} catch (ShortPasswordException | InvalidEmailException | EmptyFieldException $e) {
    echo "Ошибка: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "Неожиданная ошибка: " . $e->getMessage() . "<br>";
} finally {
    echo "Операция валидации формы регистрации завершена.<br>";
}
?>
