<?php

//Подключение к БД
try {
    $conn = new PDO("mysql:host=TEXT;dbname=TEXT",
        'TEXT', 'TEXT');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к БД: " . $e->getMessage(), $e->getCode();
    die();
}

