<?php

if($_SESSION['username'])
{
    $result = $conn->query("SELECT * FROM settings WHERE id_user=".$_SESSION['id_auth_user']);
    $row = $result->fetch()['language'];
    $_SESSION['language'] = $row;

    if($_GET['languageChange'])
    {
        if($row === 'eng')
        {
            $result = $conn->query("UPDATE settings 
                           SET language='rus' WHERE id_user=".$_SESSION['id_auth_user']);
            $_SESSION['language'] = 'rus';
        }
        elseif($row === 'rus')
        {
            $result = $conn->query("UPDATE settings 
                    SET language='eng' WHERE id_user=".$_SESSION['id_auth_user']);
            $_SESSION['language'] = 'eng';
        }
        header("Location:index.php");
        die();
    }
}
else
{
    if($_GET['languageChange'])
    {
        //Если установлен английский язык
        if ($_SESSION['language'] == 'eng') {
            $_SESSION['language'] = 'rus';
        }
        //Если установлен русский язык
        elseif ($_SESSION['language'] == 'rus') {
            $_SESSION['language'] = 'eng';
        }
        //Если язык не задан
        else
        {
            $_SESSION['language'] = 'eng';
        }
        header("Location:index.php");
        die();
    }
}

