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
    if (!file_exists($composer = __DIR__ . '/../vendor/autoload.php')) {
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
            'assets' => require dirname(__DIR__) . '/config/assets.php',
            'theme' => require dirname(__DIR__) . '/config/theme.php',
            'view' => require dirname(__DIR__) . '/config/view.php',
        ]);
    }, true);

add_filter( 'get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});

add_action('init', 'my_sale');
function my_sale()
{
    register_post_type('sale', array(
        'labels' => array(
            'name' => 'Акции', // Основное название типа записи
            'singular_name' => 'Акция', // отдельное название записи типа Book
            'add_new' => 'Добавить новую',
            'add_new_item' => 'Добавить новую акцию',
            'edit_item' => 'Редактировать акцию',
            'new_item' => 'Новая акция',
            'view_item' => 'Посмотреть акцию',
            'search_items' => 'Найти акцию',
            'not_found' => 'Акций не найдено',
            'not_found_in_trash' => 'В корзине акций не найдено',
            'parent_item_colon' => '',
            'menu_name' => 'Акции'

        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail')
    ));

    register_taxonomy('action_type', 'sale', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Тип', 'taxonomy general name'),
            'singular_name' => _x('тип акции', 'taxonomy singular name'),
            'all_items' => __('Все типы'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Изменть тип'),
            'update_item' => __('Обновить'),
            'add_new_item' => __('Добавить тип'),
            'menu_name' => __('Тип'),
        ),
        'show_ui' => true,
        'query_var' => true,
        //'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
    ));

    register_post_type('goods', array(
        'labels' => array(
            'name' => 'Товары', // Основное название типа записи
            'singular_name' => 'Товар', // отдельное название записи типа Book
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый товар',
            'edit_item' => 'Редактировать товар',
            'new_item' => 'Новый товар',
            'view_item' => 'Посмотреть товар',
            'search_items' => 'Найти товар',
            'not_found' => 'Товаров не найдено',
            'not_found_in_trash' => 'В корзине товаров не найдено',
            'parent_item_colon' => '',
            'menu_name' => 'Товары'

        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail')
    ));

    register_taxonomy('sale_type', 'goods', array(
        'hierarchical' => false,
        'publicly_queryable'  => false,
        'labels' => array(
            'name' => _x('Скидки', 'taxonomy general name'),
            'singular_name' => _x('Скидка', 'taxonomy singular name'),
            'all_items' => __('Все скидки'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Изменть скидку'),
            'update_item' => __('Обновить'),
            'add_new_item' => __('Добавить новую скидку'),
            'menu_name' => __('Скидки'),
        ),
        'show_ui' => true,
        'query_var' => true,
        //'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
    ));

    register_taxonomy('good_type', 'goods', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Тип', 'taxonomy general name'),
            'singular_name' => _x('тип товара', 'taxonomy singular name'),
            'all_items' => __('Все типы'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Изменть тип'),
            'update_item' => __('Обновить'),
            'add_new_item' => __('Добавить тип'),
            'menu_name' => __('Тип'),
        ),
        'show_ui' => true,
        'query_var' => true,
        //'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
    ));

    register_post_type('shishamen', array(
        'labels' => array(
            'name' => 'Кальянщики', // Основное название типа записи
            'singular_name' => 'Кальянщик', // отдельное название записи типа Book
            'add_new' => 'Добавить Кальянщика',
            'add_new_item' => 'Добавить нового Кальянщика',
            'edit_item' => 'Редактировать Кальянщика',
            'new_item' => 'Новый Кальянщик',
            'view_item' => 'Посмотреть Кальянщика',
            'search_items' => 'Найти Кальянщика',
            'not_found' => 'Кальянщиков не найдено',
            'not_found_in_trash' => 'В корзине товаров не найдено',
            'parent_item_colon' => '',
            'menu_name' => 'Кальянщики'

        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail', 'comments')
    ));
}


add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels($labels)
{
    $new = array(
        'name' => 'Отзывы',
        'singular_name' => 'Отзыв',
        'add_new' => 'Добавить отзыв',
        'add_new_item' => 'Добавить отзыв',
        'edit_item' => 'Редактировать отзыв',
        'new_item' => 'Новый отзыв',
        'view_item' => 'Просмотреть отзыв',
        'search_items' => 'Поиск отзывов',
        'not_found' => 'Отзывов не найдено.',
        'not_found_in_trash' => 'Отзывов в корзине не найдено.',
        'parent_item_colon' => '',
        'all_items' => 'Все отзывы',
        'archives' => 'Архивы отзывов',
        'insert_into_item' => 'Вставить в отзыв',
        'uploaded_to_this_item' => 'Загруженные для этого отзыва',
        'featured_image' => 'Миниатюра отзыва',
        'filter_items_list' => 'Фильтровать список отзывов',
        'items_list_navigation' => 'Навигация по списку отзывов',
        'items_list' => 'Список отзывов',
        'menu_name' => 'Отзывы',
        'name_admin_bar' => 'Отзыв', // пункте "добавить"
    );

    return (object)array_merge((array)$labels, $new);
}


function login_redirect()
{
    if (strpos($_SERVER['REQUEST_URI'], 'login') !== false)
        $loc = '/wp/wp-login.php';
    elseif (strpos($_SERVER['REQUEST_URI'], 'admin') !== false)
        $loc = '/wp/wp-admin/';
}

add_action('template_redirect', 'login_redirect');


add_filter('wpcf7_before_send_mail', 'wpcf7_send_mail_telegram');
function wpcf7_send_mail_telegram($cf7)
{
    $mail = $cf7->prop('mail');
    $wpcf7 = WPCF7_ContactForm::get_current();
    $form_id = $wpcf7->id;
    if ($mail) {
        $token = "1795609045:AAEs10wLpKjNpvWeeA8KymGzYiAWeSSF7Qs";
        $chat_id = "760773666";
        $name = $_POST['name'];
        $phone = urlencode($_POST['phone']);
        if ( $form_id == 142) {
            $shisha = $_POST['text-1'];
            $shisha_qty = $_POST['text-2'];
            $cups_qty = $_POST['text-3'];
            $coal = $_POST['text-4'];
            $time = $_POST['text-5'];
            $delivery = urlencode($_POST['text-6']);
            $total = $_POST['text-9'];
            $nyFruit = $_POST['text-11'];
            $nyPresent = $_POST['text-10'];
            $arr = [
                'Город:' => 'Самара',
                'Тема:' => 'Заказ',
                'Кальян:' => $shisha . '. Количество: ' . $shisha_qty,
                'Чаши:' => $cups_qty,
                'Фруктовый подарок на Н.Г:' => $nyFruit,
                '3 чаша за репост:' => $nyPresent,
                'Уголь:' => $coal,
                'Время:' => $time,
                'Доставка:' => $delivery,
                'Имя:' => $name,
                'Телефон:' => $phone,
                'Итого:' => $total
            ];
        } else {
            $theme = $_POST['text-12'];
            $arr = [
                'Город:' => 'Самара',
                'Переход с кнопки:' => $theme,
                'Имя:' => $name,
                'Телефон:' => $phone,
            ];
        }

        foreach ($arr as $key => $value) {
            $txt .= "<b>" . $key . "</b> " . $value . "%0A";
        };
        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");
    }
}


add_action( 'wp_enqueue_scripts', 'true_loadmore_scripts' );
function true_loadmore_scripts() {
    wp_register_script('true_loadmore', get_stylesheet_directory_uri() . '/loadmore.js', array( 'jquery' ));
    wp_localize_script('true_loadmore', 'ajaxVar', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));
    wp_enqueue_script( 'true_loadmore' );
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}


add_action( 'wp_ajax_loadmore', 'actions_loadmore' );
add_action( 'wp_ajax_nopriv_loadmore', 'actions_loadmore' );

function actions_loadmore() {
    $args = [
        'posts_per_page' => 99,
        'post_status' => 'publish',
        'offset' => 9,
    ];
    query_posts($args);
    ?>
    <div class="actions-page__wrap">
    <?php
    while( have_posts() ) {
    the_post();
    ?>
    <div class="actions-page__item">
        <div class="actions-slider__img"><img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title() ?>">
        </div>
        <div class="actions-slider__info">
            <div class="actions-slider__name"><?php the_title() ?></div>
            <div class="actions-slider__text"><?php the_field('short') ?>
            </div>
            <a href="<?php echo get_post_permalink() ?>" class="actions-slider__link">Подробнее</a>
        </div>
    </div>
    <?php
    }
    ?>
    </div>
    <?php
    die();
}


add_action( 'wp_ajax_loadmore_review', 'reviews_loadmore' );
add_action( 'wp_ajax_nopriv_loadmore_review', 'reviews_loadmore' );

function reviews_loadmore() {
    $args = [
        'posts_per_page' => 99,
        'post_status' => 'publish',
        'post_type' => 'post',
        'offset' => 10,
    ];
    query_posts($args);
        while( have_posts() ) {
            the_post();
            ?>
            <div class="reviews-block__item img open-modal"><img src="<?php the_post_thumbnail_url() ?>" alt="Отзыв"></div>
            <?php
        }
    die();
}

add_action( 'wp_ajax_shishamen', 'shishamen_loadmore' );
add_action( 'wp_ajax_nopriv_shishamen', 'shishamen_loadmore' );

function shishamen_loadmore() {
    if(isset($_POST['shishamen_id'])) {
        $id = $_POST['shishamen_id'];
    }
    $shishamen = get_post($id);
     ?>
    <div class="modal-review__info">
        <div class="modal-review__img img">
          <img src="<?php echo get_the_post_thumbnail_url($id)  ?>" alt="<?php echo $shishamen->post_title; ?>">
        </div>
        <div class="modal-review__data">
            <div class="modal-review__name"><?php echo $shishamen->post_title; ?></div>
            <div class="modal-review__exp">Стаж: <?php the_field('experience', $id) ?></div>
            <div class="modal-review__desc"><?php the_field('desc', $id) ?></div>
        </div>
    </div>
    <div class="modal-review__comments">
        <?php
        $args = [
            'post_id' => $id,
            'status' => 'approve',
        ];
        $comments = get_comments( $args );
        if ($comments) {
            ?><h3>Отзывы:</h3><?php
        } ?>
        <?php
        foreach( $comments as $comment ) {
            $format = 'd.m.Y';
            $comment_ID = $comment->comment_ID;
            ?>
            <div class="modal-review__comment">
                <div>
                    <span class="modal-review__comment-name"><?php echo( $comment->comment_author ); ?></span>
<!--                    <span class="modal-review__comment-rating">--><?php //the_field('rating', $comment_ID ); ?><!--</span>-->
                    <span class="modal-review__comment-date"><?php echo get_comment_date( $format, $comment_ID ); ?></span>
                </div>
                <div class="modal-review__comment-content"><?php echo( $comment->comment_content ); ?></div>
            </div>
            <?php
        };
        ?>
    </div>
    <div class="button modal-review__add">Оставить отзыв</div>
    <div class="modal-review__hide"><span>Скрыть</span></div>
    <?php
    $commenter = wp_get_current_commenter();
    $comments_args = array(
        'fields'               => [
            'author' => '<p class="comment-form-author">
			<input id="author" class="input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . '  placeholder="Имя"/>
		</p>',
        ],
        'label_submit' => 'Отправить отзыв',
        'title_reply'=>'Оставить отзыв',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'comment_field' => '<p class="comment-form-comment"><textarea class="textarea input" id="comment" name="comment" aria-required="true" placeholder="Отзыв" rows="5"></textarea></p>',
        'class_submit' => 'button modal-review__submit',
        'class_container' => 'modal-review__form'
    );
    comment_form( $comments_args, $id );
    die();
}



function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
function kama_reorder_comment_fields( $fields ){
    $new_fields = array(); // сюда соберем поля в новом порядке
    $myorder = array('author', 'comment'); // нужный порядок
    foreach( $myorder as $key ){
        $new_fields[ $key ] = $fields[ $key ];
        unset( $fields[ $key ] );
    }

    // если остались еще какие-то поля добавим их в конец
    if( $fields )
        foreach( $fields as $key => $val )
            $new_fields[ $key ] = $val;

    return $new_fields;
}


add_action( 'comment_post', 'new_comment_notify', 15, 2 );
function new_comment_notify( $comment_ID, $comment_approved ){
    add_filter( 'comment_post_redirect', function() {
        return get_home_url() . '/reviews-thx';
    }, 10, 2 );
}

// REMOVE EMOJI ICONS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

add_filter( 'webpc_dir_name', function( $path, $directory ) {
    if ( $directory !== 'uploads' ) {
        return $path;
    }
    return 'app/uploads';
}, 10, 2 );


add_filter( 'webpc_dir_name', function( $path, $directory ) {
    if ( $directory !== 'webp' ) {
        return $path;
    }
    return 'app/uploads-webpc';
}, 10, 2 );
