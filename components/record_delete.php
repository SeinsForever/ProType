<?php

if($_GET['recordDeleteRus'])
{
    $conn->query("DELETE FROM records_rus WHERE id_user = ".$_SESSION['id_auth_user']);
    $_SESSION['warning_message'] = 'Record has been successfully deleted (Russian)';
    header('Location: ../index.php?profile=1');
}

elseif($_GET['recordDeleteEng'])
{
    $conn->query("DELETE FROM records_eng WHERE id_user = ".$_SESSION['id_auth_user']);
    $_SESSION['warning_message'] = 'Record has been successfully deleted (English)';
    header('Location: ../index.php?profile=1');
}