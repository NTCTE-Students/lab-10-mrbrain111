<?php

class ShopException extends Exception {
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class InsufficientFundsException extends ShopException {
    public function __construct($message = "Недостаточно средств на счете", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class ProductNotFoundException extends ShopException {
    public function __construct($message = "Товар отсутствует на складе", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class OrderException extends ShopException {
    public function __construct($message = "Ошибка в заказе", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

function checkFunds($balance, $amount) {
    if ($balance < $amount) {
        throw new InsufficientFundsException("Недостаточно средств на счете. Текущий баланс: $balance, требуемая сумма: $amount");
    }
    return true;
}

function checkProductAvailability($product, $inventory) {
    if (!isset($inventory[$product]) || $inventory[$product] <= 0) {
        throw new ProductNotFoundException("Товар '$product' отсутствует на складе");
    }
    return true;
}

function placeOrder($product, $amount, $balance, $inventory) {
    try {
        checkProductAvailability($product, $inventory);

        checkFunds($balance, $amount);

        echo "Заказ успешно оформлен. Товар: $product, сумма: $amount<br>";
    } catch (ShopException $e) {
        echo "Ошибка: " . $e->getMessage() . "<br>";
    } catch (Exception $e) {
        echo "Неожиданная ошибка: " . $e->getMessage() . "<br>";
    }
}

$balance = 160;
$amount = 150;
$product = "Телефон";
$inventory = [
    "Телефон" => 5,
    "Ноутбук" => 0,
];

placeOrder($product, $amount, $balance, $inventory);
