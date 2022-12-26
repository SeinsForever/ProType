<?php

$limit = 5;

$resultRecord = $conn->query("SELECT id_user, speed, date 
                FROM records_eng ORDER BY speed DESC LIMIT ".$limit);

if($_SESSION['id_auth_user'])
{
    $resultRecordOwn = $conn->query("SELECT id_user, speed, date 
                            FROM records_eng ORDER BY speed DESC");
    $i = 0;
    while($rowRecordOwn = $resultRecordOwn->fetch())
    {
        $i++;
        if($rowRecordOwn['id_user'] == $_SESSION['id_auth_user'])
        {
            break;
        }
    }
}
?>
<section class="form">
    <div class="container">
        <h3>
            Global TOP 5 (English language):<br><br>
        </h3>
        <ol style="padding-inline-start: 1rem;">
                <?php while($rowRecord = $resultRecord->fetch()) {?>
            <li>
                <?php
                $resultUser = $conn->query("SELECT name FROM users 
                                        WHERE id=".$rowRecord['id_user']);?>
                <h3><?= $resultUser->fetch()['name'] ?></h3>
                <h4><?= $rowRecord['speed'] ?> characters/min | <?= $rowRecord['date'] ?></h4>
            </li>
            <?php }; ?>
        </ol>
        <?php
        if($_SESSION['id_auth_user'] && $rowRecordOwn['speed'])
        { ?>
            <!-- Графическая линия -->
            <hr>
            <h3>
                Let's watch on your records:<br><br>
            </h3>

            <ol style="padding-inline-start: 1rem;" start = "<?= $i ?>">
                <li>
                    <h3><?= $_SESSION['username'] ?></h3>
                    <h4><?= $rowRecordOwn['speed'] ?> characters/min | <?= $rowRecordOwn['date'] ?></h4>
                </li>
            </ol>

        <?php
        }
        ?>
    </div>
</section>
