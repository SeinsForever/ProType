<?php
require('dbconnect.php');

$message = explode(";", trim(array_keys($_POST)[0], '"'));

// $message[i], i соответствует:
//    0 — id пользователя
//    1 — скорость печати
//    2 — язык текста

// Проверка на попытку взлома
if($message[1] > 1500)
{
    die;
}

if($message[2] == 'rus')
{
    $result = $conn->query("SELECT * FROM records_rus WHERE id_user=".$message[0]);

    if(!$row = $result->fetch())
    {
        $result = $conn->query("INSERT INTO records_rus (id_user,date,speed)
                                VALUES ('".$message[0]."','".date('Y-m-d H:i:s', time())."','".$message[1]."')");
        die();
    }

    if($row['speed'] < $message[1])
    {
        $conn->query("UPDATE records_rus SET 
                       date = '".date('Y-m-d H:i:s', time())."', 
                       speed = '".$message[1]."'  
                       WHERE id_user = ".$message[0]);
        die();
    }
    die();
}

if($message[2] == 'eng')
{
    $result = $conn->query("SELECT * FROM records_eng WHERE id_user=".$message[0]);

    if(!$row = $result->fetch())
    {
        $result = $conn->query("INSERT INTO records_eng (id_user,date,speed)
                                VALUES ('".$message[0]."','".date('Y-m-d H:i:s', time())."','".$message[1]."')");
        die();
    }

    if($row['speed'] < $message[1])
    {
        $conn->query("UPDATE records_eng SET 
                       date = '".date('Y-m-d H:i:s', time())."', 
                       speed = '".$message[1]."'  
                       WHERE id_user = ".$message[0]);
        die();
    }
    die();
}

