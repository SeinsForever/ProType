<?php

$result = $conn->query("SELECT * FROM users WHERE login='".strtolower($_POST['login'])."'");

if($row = $result->fetch())
{
    if(md5($_POST['password']) == $row['password'])
    {
        //загрузка данных пользователя
        $_SESSION['username'] = $row['name'];
        $_SESSION['id_auth_user'] = $row['id'];
        $_SESSION['login'] = $row['login'];

        //загрузка настроек пользователя
        $resultSettings = $conn->query("SELECT * FROM settings 
                                        WHERE id_user='".$_SESSION['id_auth_user']."'");
        if(!$rowSettings = $resultSettings->fetch())
        {
            $conn->query("INSERT INTO settings (id_user)
                                VALUES ('".$_SESSION['id_auth_user']."')");
            $resultSettings = $conn->query("SELECT * FROM settings
                                                WHERE id_user='".$_SESSION['id_auth_user']."'");
            $rowSettings = $resultSettings->fetch();
        }
        $_SESSION['language'] = $rowSettings['language'];

        header('Location: index.php');
    }
    else
    {
        $_SESSION['warning_message'] = 'Неверный пароль';
        header('Location: ../index.php?login=1');
    }
}
else
{
    $_SESSION['warning_message'] = 'Неверный логин';
    header('Location: ../index.php?login=1');
}

