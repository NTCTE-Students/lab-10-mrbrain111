<?php

class DatabaseConnectionException extends Exception {
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
function connectToDatabase($host, $username, $password, $dbname) {
    try {

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        echo "Успешное подключение к базе данных.<br>";
        return $pdo;
    } catch (PDOException $e) {

        throw new DatabaseConnectionException("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}

function handleError($exception) {
    echo "Произошла ошибка: " . $exception->getMessage() . "<br>";
}

try {
    $host = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "testdb";

    $pdo = connectToDatabase($host, $username, $password, $dbname);
} catch (DatabaseConnectionException $e) {
    handleError($e);
} catch (Exception $e) {
    handleError($e);
} finally {
    echo "<br>Операция подключения к базе данных завершена.";
}
?>
