<?php

$result = $conn->query("SELECT * FROM records_rus WHERE id_user=".$_SESSION['id_auth_user']);

if($row = $result->fetch())
{
    echo("Record speed at russian language:  ".$row['speed']."<br>");
    echo("At:  ".$row['date']);
    $_SESSION['recordExistsRus'] = 1;
}
else
{
    echo('No records at russian language');
    unset($_SESSION['recordExistsRus']);
}