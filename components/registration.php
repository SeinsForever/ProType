<?php
$newLogin = strtolower($_POST['newLogin']);

if(strlen($newLogin) < 3 || strlen($newLogin) > 32)
{
    $_SESSION['warning_message'] = 'Too long or too short login';
    header('Location: ../index.php?register=1');
    exit();
}

if(strlen($_POST['name']) > 32)
{
    $_SESSION['warning_message'] = 'Too long name';
    header('Location: ../index.php?register=1');
    exit();
}

if(strlen($_POST['password']) < 3 || strlen($_POST['password']) > 32)
{
    $_SESSION['warning_message'] = 'Too long or too short password';
    header('Location: ../index.php?register=1');
    exit();
}

//Проверка на оригинальность логина
$result = $conn->query("SELECT * FROM users WHERE login='".$newLogin."'");
$row = $result->fetch();
if(!empty($row))
{
    $_SESSION['warning_message'] = 'This login is already taken';
    header('Location: ../index.php?register=1');
    exit();
}

//Создание новой записи о пользователе в БД
$conn->query("INSERT INTO users (login, password, name) 
                        VALUES('".$newLogin."', 
                        '".md5($_POST['password'])."', 
                        '".$_POST['name']."')");
$result = $conn->query("SELECT * FROM users 
                                    WHERE login='".$newLogin."'");
$row = $result->fetch();
$_SESSION['username'] = $row['name'];
$_SESSION['id_auth_user'] = $row['id'];
$_SESSION['login'] = $row['login'];

//Создание новой записи о настройках пользователя в БД
$conn->query("INSERT INTO settings (id_user)
                            VALUES ('".$_SESSION['id_auth_user']."')");
$resultSettings = $conn->query("SELECT * FROM settings 
                            WHERE id_user='".$_SESSION['id_auth_user']."'");
$_SESSION['language'] = $resultSettings->fetch()['language'];

header('Location: index.php');