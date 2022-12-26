<div class="inputZone">

    <?php

//    Сообщение от сервера
    if($_SESSION['warning_message'])
    {
        echo('<div class="container warning" style="margin-bottom: 1rem">'.$_SESSION['warning_message'].'</div>');
    }

//    Страница профиля
    if($_GET['profile'])
    {
        if(!$_SESSION['id_auth_user'])
        {
            header('Location: index.php?login=1');
        }
        unset($_SESSION['warning_message']);

        require('components/profile.php');
    }

//    Страница регистрации
    elseif($_GET['register'])
    {
        if($_SESSION['id_auth_user'])
        {
            header('Location: index.php');
        }
        unset($_SESSION['warning_message']);

        require('components/register_form.php');
    }

//    Страница логина
    elseif($_GET['login'])
    {
        if($_SESSION['id_auth_user'])
        {
            header('Location: index.php');
        }
        unset($_SESSION['warning_message']);

        require('components/login_form.php');
    }

//    Страница всех рекордов
    elseif($_GET['records'])
    {
        require('components/records_list.php');
    }

//    Страница информации о странице
    elseif($_GET['info'])
    {
        require('components/info.php');
    }

//    Главная страница набора текста
    else
    {
        if($_GET)
        {
            header('Location: index.php');
            die;
        }
        require('components/typing_form.php');
    }
    ?>

</div>
