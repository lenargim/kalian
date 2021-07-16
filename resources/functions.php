<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);

add_action('init', 'my_sale');
function my_sale(){
    register_post_type('sale', array(
        'labels'             => array(
            'name'               => 'Акции', // Основное название типа записи
            'singular_name'      => 'Акция', // отдельное название записи типа Book
            'add_new'            => 'Добавить новую',
            'add_new_item'       => 'Добавить новую акцию',
            'edit_item'          => 'Редактировать акцию',
            'new_item'           => 'Новая акция',
            'view_item'          => 'Посмотреть акцию',
            'search_items'       => 'Найти акцию',
            'not_found'          => 'Акций не найдено',
            'not_found_in_trash' => 'В корзине акций не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Акции'

        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title','editor','thumbnail')
    ) );

    register_post_type('goods', array(
        'labels'             => array(
            'name'               => 'Товары', // Основное название типа записи
            'singular_name'      => 'Товар', // отдельное название записи типа Book
            'add_new'            => 'Добавить новый',
            'add_new_item'       => 'Добавить новый товар',
            'edit_item'          => 'Редактировать товар',
            'new_item'           => 'Новый товар',
            'view_item'          => 'Посмотреть товар',
            'search_items'       => 'Найти товар',
            'not_found'          => 'Товаров не найдено',
            'not_found_in_trash' => 'В корзине товаров не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Товары'

        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title','thumbnail')
    ) );

    register_taxonomy('sale_type', 'goods',array(
        'hierarchical'  => false,
        'labels'        => array(
            'name'                        => _x( 'Скидки', 'taxonomy general name' ),
            'singular_name'               => _x( 'Скидка', 'taxonomy singular name' ),
            'all_items'                   => __( 'Все скидки' ),
            'parent_item'                 => null,
            'parent_item_colon'           => null,
            'edit_item'                   => __( 'Изменть скидку' ),
            'update_item'                 => __( 'Обновить' ),
            'add_new_item'                => __( 'Добавить новую скидку' ),
            'menu_name'                   => __( 'Скидки' ),
        ),
        'show_ui'       => true,
        'query_var'     => true,
        //'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
    ));
}


add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
    $new = array(
        'name'                  => 'Отзывы',
        'singular_name'         => 'Отзыв',
        'add_new'               => 'Добавить отзыв',
        'add_new_item'          => 'Добавить отзыв',
        'edit_item'             => 'Редактировать отзыв',
        'new_item'              => 'Новый отзыв',
        'view_item'             => 'Просмотреть отзыв',
        'search_items'          => 'Поиск отзывов',
        'not_found'             => 'Отзывов не найдено.',
        'not_found_in_trash'    => 'Отзывов в корзине не найдено.',
        'parent_item_colon'     => '',
        'all_items'             => 'Все отзывы',
        'archives'              => 'Архивы отзывов',
        'insert_into_item'      => 'Вставить в отзыв',
        'uploaded_to_this_item' => 'Загруженные для этого отзыва',
        'featured_image'        => 'Миниатюра отзыва',
        'filter_items_list'     => 'Фильтровать список отзывов',
        'items_list_navigation' => 'Навигация по списку отзывов',
        'items_list'            => 'Список отзывов',
        'menu_name'             => 'Отзывы',
        'name_admin_bar'        => 'Отзыв', // пункте "добавить"
    );

    return (object) array_merge( (array) $labels, $new );
}


function login_redirect(){
    if( strpos($_SERVER['REQUEST_URI'], 'login')!==false )
        $loc = '/wp/wp-login.php';
    elseif( strpos($_SERVER['REQUEST_URI'], 'admin')!==false )
        $loc = '/wp/wp-admin/';
}

add_action('template_redirect', 'login_redirect');



add_filter( 'wpcf7_before_send_mail', 'wpcf7_send_mail_telegram' );
function wpcf7_send_mail_telegram($cf7)
{
    $mail = $cf7->prop('mail');
    if ($mail) {
        $token = "1795609045:AAEs10wLpKjNpvWeeA8KymGzYiAWeSSF7Qs";
        $chat_id = "760773666";
        $shisha = $_POST['text-1'];
        $shisha_qty = $_POST['text-2'];
        $cups_qty = $_POST['text-3'];
        $coal = $_POST['text-4'];
        $time = $_POST['text-5'];
        $delivery = urlencode($_POST['text-6']);
        $name = $_POST['text-7'];
        $phone = urlencode($_POST['text-8']);
        $total = $_POST['text-9'];
        $wpcf7 = WPCF7_ContactForm::get_current();
        $arr = [
            'Город:'    =>  'Самара',
            'Кальян:'   =>  $shisha . ' ' . $shisha_qty,
            'Чаши:'     =>  $cups_qty,
            'Уголь:'    =>  $coal,
            'Время:'    =>  $time,
            'Доставка:' =>  $delivery,
            'Имя:'      =>  $name,
            'Телефон:'  =>  $phone,
            'Итого:'    =>  $total
        ];
        foreach($arr as $key => $value) {
            $txt .= "<b>".$key."</b> ".$value."%0A";
        };
        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
    }
}
