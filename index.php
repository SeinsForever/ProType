<?php
//Мета-данные страницы
require('pages/meta.php');

//Функциональные файлы
require('components/dbconnect.php');
require('pages/auth.php');
require('pages/settings.php');
require('components/password_change.php');
require('components/record_delete.php');

//Отрисовка страницы
require('pages/page.php');

