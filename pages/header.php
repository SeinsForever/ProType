<div class="wrapper">
    <div class="container menu">

        <a class="icons" href="/?profile=1">
            <img src="../img/profile.png" alt="profile" class="logo" width="30px">
        </a>

        <a class="icons" href="/?records=1">
            <img src="../img/records.png" alt="records" class="logo" width="30px">
        </a>

        <a class="icons" href="/?info=1">
            <img src="../img/info.png" alt="info" class="logo" width="30px">
        </a>

        <a class="icons" href="/?languageChange=1">
            <img src="../img/language.png" alt="settings" class="logo" width="30px">
        </a>
    </div>

    <a class="icons" href="/">
        <img src="../img/Logov1.png" alt="logo" class="logo" width="135px">
    </a>

    <div class="container info">

        <?php
        if($_SESSION['username'])
        {
            echo('Hello, '.$_SESSION['username'].'!');
            echo('<br><span><a href="../index.php?logout=1">Out</a></span>');
        }
        else
        {
            echo('<span><a href="../index.php?login=1">Sign In</a></span>');
            echo('<span><a href="../index.php?register=1">Sign Up</a></span>');
        }
        ?>
    </div>
</div>