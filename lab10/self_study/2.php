<?php

class FileReadException extends Exception {
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

function readFile($filePath) {
    if (!file_exists($filePath)) {
        throw new FileReadException("Файл не найден: $filePath");
    }

    if (!is_readable($filePath)) {
        throw new FileReadException("Файл не доступен для чтения: $filePath");
    }

    return file_get_contents($filePath);
}

try {
    $filePath = "example.txt";

    $fileContent = readFile($filePath);
    echo "Содержимое файла:<br>";
    echo nl2br($fileContent);
} catch (FileReadException $e) {
    handleError($e);
} catch (Exception $e) {

    handleError($e);
} finally {
    echo "<br>Операция чтения файла завершена.";
}
?>
