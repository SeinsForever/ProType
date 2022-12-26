<div class="container" style="margin-bottom: 1rem">
    <h1 class="catalog-title" style="margin-bottom: 2rem">
        Hello, <?= $_SESSION['login']?>
    </h1>

    <!--Линия-->
    <hr>

    <h3>
        Password change:<br><br>
    </h3>
    <form method="post" action="index.php">
        <p>Old password</p>
        <label for="id3">
            <input type="password" name="oldPassword" id="id5" required>
        </label>

        <p>New password</p>
        <label for="id3">
            <input type="password" name="newPassword" id="id6" required placeholder="3-32 characters">
        </label>
        <button type="submit">Change</button>
    </form>

    <hr>

    <h3>
        Let's watch on your records:<br><br>
    </h3>
    <div>
        <div style="margin-bottom: 1rem">
            <?php
            require('components/record_search_eng.php');
            if($_SESSION['recordExistsEng'])
            {
                echo('<br><a href="index.php?recordDeleteEng=1">Delete record</a>');
            }?>

        </div>

        <div>
            <?php
            require('components/record_search_rus.php');
            if($_SESSION['recordExistsRus'])
            {
                echo('<br><a href="index.php?recordDeleteRus=1">Delete record</a>');
            } ?>
        </div>
    </div>
</div>