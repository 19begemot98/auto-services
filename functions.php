<?php
function auto_service_assets()
{
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.7');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), time(), true);
}
add_action('wp_enqueue_scripts', 'auto_service_assets');

function auto_service_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'auto_service_setup');

function register_custom_types()
{
    register_post_type('services', [
        'labels' => ['name' => 'Услуги', 'singular_name' => 'Услуга'],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    ]);

    register_post_type('feedback', [
        'labels' => [
            'name' => 'Заявки',
            'singular_name' => 'Заявка',
            'all_items' => 'Все заявки'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => ['title', 'editor'],
    ]);
}
add_action('init', 'register_custom_types');

function handle_contact_form()
{
    if (isset($_POST['contact_submit'])) {
        $name = sanitize_text_field($_POST['user_name']);
        $email = sanitize_email($_POST['user_email']);
        $message = sanitize_textarea_field($_POST['user_message']);

        $to = 'rbru-metrika@yandex.ru';
        $subject = 'Новая заявка: ' . $name;
        $body = "Имя: $name \nEmail: $email \nСообщение: $message";
        $headers = ['Content-Type: text/plain; charset=UTF-8', 'From: Webmaster <noreply@yoursite.com>'];

        wp_mail($to, $subject, $body, $headers);

        wp_insert_post([
            'post_title' => 'Заявка от ' . $name,
            'post_content' => $message,
            'post_status' => 'publish',
            'post_type' => 'feedback'
        ]);

        wp_redirect(home_url('/?status=success#contact-form'));
        exit;
    }
}
add_action('admin_post_nopriv_contact_form', 'handle_contact_form');
add_action('admin_post_contact_form', 'handle_contact_form');

function fix_ssl_attachment_url($url)
{
    if (is_ssl()) {
        $url = str_replace('http://', 'https://', $url);
    }
    return $url;
}
add_filter('wp_get_attachment_url', 'fix_ssl_attachment_url');
add_filter('wp_calculate_image_srcset', function ($sources) {
    foreach ($sources as &$source) {
        if (is_ssl()) {
            $source['url'] = str_replace('http://', 'https://', $source['url']);
        }
    }
    return $sources;
});
add_filter('wp_lazy_loading_enabled', '__return_false');

add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);

function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}