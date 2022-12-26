<?php

$result = $conn->query("SELECT * FROM records_eng WHERE id_user=".$_SESSION['id_auth_user']);

if($row = $result->fetch())
{
    echo("Record speed at english language:  ".$row['speed']."<br>");
    echo("At:  ".$row['date']);
    $_SESSION['recordExistsEng'] = 1;
}
else
{
    echo('No records at english language<br><br>');
    unset($_SESSION['recordExistsEng']);
}
