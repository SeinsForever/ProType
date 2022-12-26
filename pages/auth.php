<?php
session_start();

//Выход из аккаунта
if($_GET['logout'])
{
    session_unset();
    header('Location: index.php');
}

//Регистрация
if($_POST['newLogin'])
{
    require('components/registration.php');
}

//Авторизация в аккаунте
if($_POST['login'])
{
    require('components/login.php');
};

