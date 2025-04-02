<?php

// Функция для логирования ошибок в файл
function logError($message) {
    $logFile = __DIR__ . '/error.log'; // Путь к файлу логов в корне проекта
    $timestamp = date('Y-m-d H:i:s');  // Текущая дата и время

    // Формируем строку для записи в лог
    $logEntry = "[$timestamp] $message\n";

    // Записываем в файл
    file_put_contents($logFile, $logEntry, FILE_APPEND);
}



// Кастомное исключение для обработки ошибок
class CustomException extends Exception {
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

// Функция для симуляции ошибок
function simulateError($condition) {
    if ($condition) {
        throw new CustomException("я симуляция.");
    }
    return "Успешное выполнение.";
}

try {

    $result = simulateError(true);
    echo $result;
} catch (CustomException $e) {

    logError($e->getMessage());
    echo "Произошла ошибка: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    // Логируем другие ошибки
    logError($e->getMessage());
    echo "Произошла ошибка: " . $e->getMessage() . "<br>";
} finally {
    echo "<br>Операция завершена.";
}
?>
