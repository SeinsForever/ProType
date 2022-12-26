<?php

if($_POST['oldPassword'])
{
    if(strlen($_POST['newPassword']) < 3 || strlen($_POST['newPassword']) > 32)
    {
        $_SESSION['warning_message'] = 'Too long or too short new password';
        header('Location: ../index.php?profile=1');
        exit();
    }

    $result = $conn->query("SELECT * FROM users WHERE id='".$_SESSION['id_auth_user']."'");
    $row = $result->fetch();

    if($row['password'] == md5($_POST['oldPassword']))
    {
        $conn->query("UPDATE users SET 
                       password = '".md5($_POST['newPassword'])."'
                       WHERE id = ".$_SESSION['id_auth_user']);

        $_SESSION['warning_message'] = 'Password has been successfully changed';
        header('Location: ../index.php?profile=1');
    }
    else
    {
        $_SESSION['warning_message'] = 'Wrong password';
        header('Location: ../index.php?profile=1');
    }
}