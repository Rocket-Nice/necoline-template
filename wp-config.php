<?php

/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', "wp_necoline");

/** Имя пользователя базы данных */
define('DB_USER', "root");

/** Пароль к базе данных */
define('DB_PASSWORD', "2304730qQ");

/** Имя сервера базы данных */
define('DB_HOST', "localhost");

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`P1%nXi<Y.e?$5Xyo`$tTc|BuYb6V3^hRSRn[/8PM3ZVCqy| 9hJvGJ.inK.|_6>');
define('SECURE_AUTH_KEY',  '.pV*k%[-wFD=g!^6cH.Jlh[BTXKgBKRE`I!._*T+1C(D{@Gjb&]zv=Mk13kwaWjo');
define('LOGGED_IN_KEY',    '[}Q|V{A.TbqWFu4DP0IsRfWZHrqtI=Zh(%KK (,&In,qzRGh2Zsxiz3.[#-r64Ty');
define('NONCE_KEY',        'veJM60%B,Nz|c3%aoAF}zW=,i_6>*JGXgRlRz:*oUHWKV/V*nnoSo{;2%lMkaoG?');
define('AUTH_SALT',        '+i+HK-$fS(cZkALHoDkOAF2D&0r5xttqm)-iwu<j2tCugVRrfBZn!1d%PM0JaS`0');
define('SECURE_AUTH_SALT', 'Ox>h;f-4>#m3tY1}D&dmtm)W*#/b6A~4IMA5;>L/{9*C7O#nR::^a`y(`^7SUM 5');
define('LOGGED_IN_SALT',   'Y.+CTh0RW6PVT0t{m{$hTmK|H#[??)DS3-:SJ{D0pv5:Kh:AJ2Axg!v)jB(/c[u*');
define('NONCE_SALT',       'DL?BD%4DfZ-)-!|#V>W?AI*?^96kY8l`=N.qnF8 <1v=|FFU& :DuZFW=`aVmifz');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */

// Увеличение лимита памяти PHP
define('WP_MEMORY_LIMIT', '256M');

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
