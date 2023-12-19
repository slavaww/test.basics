<?php
/**
 * The functions
 *
 * @package WordPress
 * @subpackage basics_theme
 * @since basics_theme 1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
 /**
 * Структура подключаемых файлов темы

 * ./
 * ../
 *    ajax-callbacks/    - обработчики ajax событий
 *    inc/               - модули/утилиты/сниппеты
 *    post_types/        - кастомные типы постов, их настройки
 *    shortcodes/        - регистраиця шорткодов
 *
 * ./customize.php        - настройки темы оформления (цвета, банеры, всплывающее сообщение, ...)
 * ./editor-formats.php   - настройка формато визуального редактора
 * ./enqueue.php          - загрузка css/js файлов темы
 * ./theme-setup.php      - настройки темы (features)
 * ./utils.php            - вспомогательыне фунции
 * ./widgets.php          - регистрация виджетов и сайдбаров темы
 * ./wordpress.php        - оптимизация дефолтных настроек WP remove_(action/filter)
 *
 */

// Array of files to include.
$understrap_includes = array(
	'/theme-setup.php',
    '/enqueue.php',
    '/save_form.php',
    '/post_types/cities.php',
    '/post_types/realty.php',
);

// Include files.
foreach ( $understrap_includes as $file ) {
	include get_theme_file_path( 'functions' . $file );
}