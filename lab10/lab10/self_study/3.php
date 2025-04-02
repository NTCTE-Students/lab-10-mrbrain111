<?php

class DivisionByZeroException extends Exception {
    public function __construct($message = "Деление на ноль недопустимо", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

function divide($dividend, $divisor) {
    if ($divisor == 0) {
        throw new DivisionByZeroException();
    }
    return $dividend / $divisor;
}

try {
    $a = 10;
    $b = 1;
    $result = divide($a, $b);
    echo "Результат деления: $result";
} catch (DivisionByZeroException $e) {

    handleError($e);
} catch (Exception $e) {

    handleError($e);
} finally {
    echo "<br>Операция деления завершена.";
}
?>
