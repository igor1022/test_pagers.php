<?php

setlocale (LC_ALL, 'nl_NL'); // Преобразуем каракули в кириллицу

/*
*
*  Настройки
*
*/

$options = array(
    'enable'        => true, // Скрипт работает только если значение TRUE
    /* Настройки CSV */
    'filename'      => 'import.csv', // Имя файла CSV (можем менять на нужное). Находиться должен в одной папке со скриптом
    'delimiter'     => ';', // Какой разделитель используется
    /* Настройки подключения к БД */
    'db_server'     => 'localhost', // Сервер БД
    'db_user'       => 'root', // Имя пользователя
    'db_password'   => '', // Пароль
    'db_base'       => 'data' // Имя базы данных

);

if(!$options['enable']) die('Скрипт отключен, дальнейшая обработка данных невозможна!');

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_');
    return str_replace($rus, $lat, $str);
}

$link = mysql_connect($options['db_server'], $options['db_user'], $options['db_password']);
if (!$link) {
    die('Connect error: ' . mysql_error());
}

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");


$db_selected = mysql_select_db($options['db_base'], $link);
if (!$db_selected) {
    die ('Not found db db_data: ' . mysql_error());
}

// Отключаем индексацию таблицы, для максимального быстродействия

mysql_query("ALTER TABLE `".$options['db_base']."` DISABLE KEYS");

foreach (csv_to_array($options['filename']) as $val) {


}

// Включаем индексацию таблицы

mysql_query("ALTER TABLE `".$options['db_base']."` ENABLE KEYS");

// Закрываем соединение с БД

mysql_close($link);