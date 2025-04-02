<?php

class MathException extends Exception {}
class DivisionByZeroException extends MathException {}
class UnsupportedOperationException extends MathException {}
class InvalidMathArgumentException extends MathException {}

function divide($dividend, $divisor) {
    if ($divisor == 0) {
        throw new DivisionByZeroException("Деление на ноль недопустимо.");
    }
    return $dividend / $divisor;
}

function calculateSqrt($number) {
    if ($number < 0) {
        throw new InvalidMathArgumentException("Корень из отрицательного числа недопустим.");
    }
    return sqrt($number);
}

function performOperation($operation, $a, $b = null) {
    switch ($operation) {
        case 'divide':
            return divide($a, $b);
        case 'sqrt':
            return calculateSqrt($a);
        default:
            throw new UnsupportedOperationException("Операция '$operation' не поддерживается.");
    }
}

try {
    $result = performOperation('divide', 10, 2);
    echo "Результат деления: $result<br>";

    $result = performOperation('sqrt', 4);
    echo "Результат вычисления корня: $result<br>";

    $result = performOperation('unknown', 10);
    echo "Результат операции: $result<br>";

} catch (DivisionByZeroException | InvalidMathArgumentException | UnsupportedOperationException $e) {
    echo "Ошибка: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "Неожиданная ошибка: " . $e->getMessage() . "<br>";
} finally {
    echo "Операция выполнена.<br>";
}
?>
