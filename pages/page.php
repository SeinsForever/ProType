<!--Для использования данных в JS-->
<div class="data-php" data-language="<?= $_SESSION['language'] ?>"
     data-idUser="<?= $_SESSION['id_auth_user']; ?>"></div>

<body id="body">
    <div class="display">
        <div class="centerWrapper">

            <?php
            require('header.php');
            require('main.php');
            require('footer.php');
            ?>

        </div>
    </div>
</body>
