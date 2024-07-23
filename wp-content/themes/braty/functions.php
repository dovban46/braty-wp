<?php
/**
 * braty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package braty
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function braty_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on braty, use a find and replace
		* to change 'braty' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'braty', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'braty' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'braty_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'braty_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function braty_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'braty_content_width', 640 );
}
add_action( 'after_setup_theme', 'braty_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function braty_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'braty' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'braty' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'braty_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function braty_scripts() {
	wp_enqueue_style( 'braty-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'braty-style', 'rtl', 'replace' );

	wp_enqueue_script( 'braty-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'braty_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}




function braty_enqueue_styles_and_scripts() {
    wp_enqueue_style( 'braty-main-min-css', get_template_directory_uri() . '/dist/main.min.css', array(), null, 'all' );
    wp_enqueue_style( 'braty-main-css', get_template_directory_uri() . '/dist/main.css', array(), null, 'all' );
	wp_enqueue_style( 'braty-bootstrap-min-css', get_template_directory_uri() . '/dist/bootstrap.min.css', array(), null, 'all' );

	wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), false, true);
    wp_enqueue_script( 'braty-main-min-js', get_template_directory_uri() . '/dist/main.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'braty-main-js', get_template_directory_uri() . '/src/js/main.js', array('jquery'), null, true );
	wp_enqueue_script('main-js', get_template_directory_uri() . '/src/js/main.js', array('jquery', 'swiper-js', 'bootstrap-js', 'pagination-js', 'threejs', 'threejs-add', 'threejs-control'), false, true);
}
add_action( 'wp_enqueue_scripts', 'braty_enqueue_styles_and_scripts' );



require get_template_directory() . '/inc/theme-acf.php';

if ( ! function_exists( 'mytheme_register_nav_menu' ) ) {

	function mytheme_register_nav_menu(){
		register_nav_menus( array(
	    	'Main-menu' => __( 'Primary Menu', 'text_domain' ),
	    	'Main-footer-menu'  => __( 'Footer Menu', 'text_domain' ),
		) );
	}
	add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
}

function my_custom_cart_icon() {
    ?>
    <div class="cart-icon">
        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-customlocation">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cart.svg" alt="card" />
            <?php
                // Get the cart contents count dynamically
                $cart_count = WC()->cart->get_cart_contents_count();
                echo '<p class="cart-icon-counter"><span>' . $cart_count . '</span></p>';
            ?>
        </a>
    </div>
    <?php
}
add_action('woocommerce_after_main_content', 'my_custom_cart_icon', 10);


function my_custom_account_icon() {
    ?>
    <div class="account-icon">
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="account-customlocation">
            <p><?php echo esc_html('Мій кабінет'); ?></p>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/account.svg" alt="account" />
        </a>
    </div>
    <?php
}
add_action('woocommerce_before_account_navigation', 'my_custom_account_icon', 10);


add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
         case 'UAH': $currency_symbol = 'грн'; break;
     }
     return $currency_symbol;
}

add_filter('woocommerce_breadcrumb_defaults', 'change_breadcrumb_delimiter');
function change_breadcrumb_delimiter($defaults) {
    $defaults['delimiter'] = ' <svg width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 1L6 5L2 9" stroke="#494949" stroke-width="1.5" stroke-linecap="round"> </path></svg> ';
    return $defaults;
}

//word replacement home
add_filter('woocommerce_get_breadcrumb', 'change_breadcrumb_home_text');
function change_breadcrumb_home_text($crumbs) {
    if (!empty($crumbs[0][0]) && $crumbs[0][0] === 'Home') {
        $crumbs[0][0] = 'Головна';
    }
    return $crumbs;
}

//word replacement cart
function change_cart_title() {
    if ( is_cart() ) {
        add_filter( 'the_title', 'custom_cart_title', 10, 2 );
    }
}
add_action( 'wp', 'change_cart_title' );
function custom_cart_title( $title, $id ) {
    if ( is_cart() && get_the_ID() === $id ) {
        return 'Кошик';
    }
    return $title;
}


add_filter( 'woocommerce_loop_add_to_cart_link', 'custom_add_to_cart_button', 10, 2 );
function custom_add_to_cart_button( $button, $product ) {

        // Change the image URL to the desired image path
        $image_url = get_stylesheet_directory_uri() . '/assets/images/button-cart.svg';

        // Construct the HTML markup with the image and custom text
        $button = sprintf(
            '<a href="%s" class="%s" %s><img src="%s" alt="Add to Cart" /> %s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_url( $image_url ),
            'В кошик'
        );
    
    return $button;
}

add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text');
function custom_add_to_cart_text() {
    echo '<svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.1566 0.902329C6.30486 0.625765 6.19306 0.28592 5.90868 0.142951C5.62431 -1.8023e-05 5.26944 0.107795 5.12118 0.382015L2.85833 4.57969H0.777778C0.347569 4.57969 0 4.91484 0 5.32969C0 5.74453 0.347569 6.07969 0.777778 6.07969L2.03924 10.943C2.21181 11.611 2.83403 12.0797 3.54861 12.0797H10.4514C11.166 12.0797 11.7882 11.611 11.9608 10.943L13.2222 6.07969C13.6524 6.07969 14 5.74453 14 5.32969C14 4.91484 13.6524 4.57969 13.2222 4.57969H11.1417L8.87882 0.382015C8.73056 0.107795 8.37813 -1.8023e-05 8.09132 0.142951C7.80451 0.28592 7.69514 0.625765 7.8434 0.902329L9.82674 4.57969H4.17326L6.1566 0.902329ZM4.66667 7.20469V9.4547C4.66667 9.66095 4.49167 9.8297 4.27778 9.8297C4.06389 9.8297 3.88889 9.66095 3.88889 9.4547V7.20469C3.88889 6.99844 4.06389 6.82969 4.27778 6.82969C4.49167 6.82969 4.66667 6.99844 4.66667 7.20469ZM7 6.82969C7.21389 6.82969 7.38889 6.99844 7.38889 7.20469V9.4547C7.38889 9.66095 7.21389 9.8297 7 9.8297C6.78611 9.8297 6.61111 9.66095 6.61111 9.4547V7.20469C6.61111 6.99844 6.78611 6.82969 7 6.82969ZM10.1111 7.20469V9.4547C10.1111 9.66095 9.93611 9.8297 9.72222 9.8297C9.50833 9.8297 9.33333 9.66095 9.33333 9.4547V7.20469C9.33333 6.99844 9.50833 6.82969 9.72222 6.82969C9.93611 6.82969 10.1111 6.99844 10.1111 7.20469Z" fill="white"/>
    </svg>'. 'В Корзину';

}


function is_product_in_cart($product_id) {
    $cart = WC()->cart->get_cart();
    foreach ($cart as $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            return true;
        }
    }
    return false;
}

//adding minus and plus to button with quantity
add_action( 'wp_footer', 'custom_quantity_plus_minus_script' );
function custom_quantity_plus_minus_script() {
    if ( is_singular( 'product' ) ) {
        ?>
        <script>
            jQuery(document).ready(function($) {
                $('body').on('click', '.quantity-plus', function(e){
                    e.preventDefault();
                    var $input = $(this).prev('input.qty');
                    var val = parseInt($input.val());
                    $input.val( val + 1 ).change();
                });

                $('body').on('click', '.quantity-minus', function(e){
                    e.preventDefault();
                    var $input = $(this).next('input.qty');
                    var val = parseInt($input.val());
                    if (val > 1) {
                        $input.val( val - 1 ).change();
                    }
                });
            });
        </script>
        <?php
    }
}

function custom_woocommerce_after_shop_loop_item() {
    global $product;
    $product_id = $product->get_id();

    if (is_product_in_cart($product_id)) {
        echo '<a href="' . wc_get_cart_url() . '" class="button added-to-cart">Переглянути кошик  ' . '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.7071 7.57085C17.0976 7.96137 17.0976 8.59454 16.7071 8.98506L10.3431 15.349C9.95262 15.7395 9.31946 15.7395 8.92893 15.349C8.53841 14.9585 8.53841 14.3253 8.92893 13.9348L14.5858 8.27795L8.92893 2.6211C8.53841 2.23058 8.53841 1.59741 8.92893 1.20689C9.31946 0.816362 9.95262 0.816362 10.3431 1.20689L16.7071 7.57085ZM0 7.27795L16 7.27795V9.27795L0 9.27795L0 7.27795Z" fill="#B5B5B5"/>
        </svg>
        ' .'</a>';
    } else {
        woocommerce_template_loop_add_to_cart();
    }
}
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'custom_woocommerce_after_shop_loop_item', 10);


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'custom_woocommerce_rating_display', 5 );

function custom_woocommerce_rating_display() {
    global $product;

    $average = $product->get_average_rating();

    $rating_html = '<span class="custom-star" >&#9733;</span>';
    $rating_html .= '<span class="rating-number" >' . number_format( $average, 1, ',', '' ) . '</span>';

    echo '<div class="custom-rating">' . $rating_html . '</div>';
}



add_action('custom_single_product_image', 'woocommerce_show_product_images', 5);

add_action('custom_single_product_title', 'woocommerce_template_single_title', 5);

//weight loss
function custom_single_product_weight() {
    global $product;
    $weight = $product->get_weight();
    if ($weight) {
        echo '<div class="product-weight">' . esc_html($weight) . 'г' . '</div>';
    }
}
add_action('custom_single_product_weight', 'custom_single_product_weight', 20);



//output of composition and description
function custom_single_product_fields() {
    global $product;
    $storage = get_post_meta($product->get_id(), 'storage', true);
    $description = get_post_meta($product->get_id(), 'description', true);
    if ($storage || $description) {
		echo '<div class="product-additional-info">';
        if ($storage) {
            echo '<div class="product-storage">' . esc_html($storage) . '</div>';
        }
        if ($description) {
            echo '<div class="product-description">' . esc_html($description) . '</div>';
        }
		echo '</div>';
    }
}
add_action('custom_single_product_additional_info', 'custom_single_product_fields', 30);

add_action('custom_single_product_rating', 'woocommerce_template_single_rating', 10);

add_action('custom_single_product_price', 'woocommerce_template_single_price', 10);

add_action('custom_single_product_excerpt', 'woocommerce_template_single_excerpt', 20);

add_action('custom_single_product_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);

add_action('custom_single_product_meta', 'woocommerce_template_single_meta', 40);

add_action('custom_single_product_sharing', 'woocommerce_template_single_sharing', 50);

//displaying the "View Cart" button on the product page
remove_all_actions('woocommerce_single_product_summary');
function custom_view_in_cart_button() {
    global $product;

    if ( WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) ) ) {
        $cart_url = wc_get_cart_url();
        
        echo '<a href="' . esc_url( $cart_url ) . '" class="button added-to-cart">' . __('Дивитися кошик', 'woocommerce') . '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.7071 7.57085C17.0976 7.96137 17.0976 8.59454 16.7071 8.98506L10.3431 15.349C9.95262 15.7395 9.31946 15.7395 8.92893 15.349C8.53841 14.9585 8.53841 14.3253 8.92893 13.9348L14.5858 8.27795L8.92893 2.6211C8.53841 2.23058 8.53841 1.59741 8.92893 1.20689C9.31946 0.816362 9.95262 0.816362 10.3431 1.20689L16.7071 7.57085ZM0 7.27795L16 7.27795V9.27795L0 9.27795L0 7.27795Z" fill="#B5B5B5"/>
        </svg>
        ' . '</a>';
    }
}
add_action('woocommerce_after_add_to_cart_button', 'custom_view_in_cart_button');

// Check if the product has a discount on the product page
function display_discounted_price_block() {
    global $product;

    if ( $product->is_on_sale() ) {
        do_action('custom_single_product_price');
    }
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
function custom_woocommerce_catalog_ordering() {
    ?>
    <div class="custom-ordering">
        <?php woocommerce_catalog_ordering(); ?>
        <div class="quantity">
            <label for="product_per_page"><?php echo esc_html('Показати'); ?> </label>
            <input type="text" id="product_per_page" name="products_per_page" />
        </div>
    </div>
    <?php
}

// Hook your custom function to the same action with a higher priority
add_action( 'woocommerce_before_shop_loop', 'custom_woocommerce_catalog_ordering', 40 );

// Modify products per page based on user input
add_filter( 'loop_shop_per_page', 'custom_shop_per_page', 20 );

function custom_shop_per_page( $per_page ) {
    // Retrieve the value from the query string or default to 8
    $per_page = isset( $_GET['products_per_page'] ) ? intval( $_GET['products_per_page'] ) : 8;
    return $per_page;
}


//changing text in filters
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );
function custom_woocommerce_catalog_orderby( $sortby ) {
    $sortby['menu_order'] = 'За замовчуванням'; 
    $sortby['popularity'] = 'За популярність'; 
    $sortby['rating'] = 'За рейтингом';
    $sortby['date'] = 'За новизною';
    $sortby['price'] = 'За зростанням ціни'; 
    $sortby['price-desc'] = 'За спаданням ціни'; 

    return $sortby;
}

function enqueue_lightgallery_scripts() {

    wp_enqueue_style('lightgallery-css', get_template_directory_uri() . '/../../../node_modules/lightgallery/css/lightgallery.css');

    wp_enqueue_script('lightgallery-js', get_template_directory_uri() . '/../../../node_modules/lightgallery/lightgallery.min.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightgallery_scripts');

//handling the comment form
function handle_custom_review_form_submission() {
    if (isset($_POST['submit_custom_review'])) {
        $rating = intval($_POST['rating']);
        $name = sanitize_text_field($_POST['custom_name']);
        $phone = sanitize_text_field($_POST['custom_phone']);
        $comment = sanitize_textarea_field($_POST['custom_comment']);
        $product_id = intval($_POST['product_id']);
        
        $commentdata = array(
            'comment_post_ID' => $product_id,
            'comment_author' => $name,
            'comment_content' => $comment,
            'comment_type' => 'review',
            'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
            'comment_agent' => $_SERVER['HTTP_USER_AGENT'],
            'comment_date' => current_time('mysql'),
            'comment_approved' => 1,
        );

        $comment_id = wp_insert_comment($commentdata);
        
        if ($comment_id) {
            update_comment_meta($comment_id, 'rating', $rating);

            wp_redirect(get_permalink($product_id) . '?review_submitted=true');
            exit;
        }
    }
}
add_action('init', 'handle_custom_review_form_submission');

//add to cart single
function get_additional_products() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'product_cat' => 'Додатки'
    );

    $loop = new WP_Query($args);
    $products = array();

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            global $product;
            $products[] = $product;
        }
        wp_reset_postdata();
    }

    return $products;
}

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['gltf'] = 'model/gltf+json';
    $mimes['glb'] = 'model/gltf-binary';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// add + and - to quantity-input
add_action('woocommerce_before_add_to_cart_quantity', 'custom_quantity_wrapper_start');
function custom_quantity_wrapper_start() {
    echo '<div class="quantity">';
    echo '<div class="quantity-buttons">';
    echo '<button type="button" class="quantity-button quantity-minus">-</button>';
}

add_action('woocommerce_after_add_to_cart_quantity', 'custom_quantity_wrapper_end');
function custom_quantity_wrapper_end() {
    echo '<button type="button" class="quantity-button quantity-plus">+</button>';
    echo '</div>';
    echo '</div>';
}


add_filter('woocommerce_locate_template', 'custom_wc_locate_template', 10, 3);

function custom_wc_locate_template($template, $template_name, $template_path) {
    global $woocommerce;
    $_template = $template;
    if (!$template_path) $template_path = $woocommerce->template_url;
    $plugin_path = untrailingslashit(plugin_dir_path(__FILE__)) . '/woocommerce/';

    $template = locate_template(array(
        $template_path . $template_name,
        $template_name
    ));
    if (!$template && file_exists($plugin_path . $template_name))
        $template = $plugin_path . $template_name;

    if (!$template)
        $template = $_template;

    return $template;
}


function set_default_rating_if_no_rating($average, $product_id) {
    if ($average == 0) {
        return 5;
    }
    return $average;
}
add_filter('woocommerce_product_get_average_rating', 'set_default_rating_if_no_rating', 10, 2);
add_filter('woocommerce_product_get_rating_count', 'set_default_rating_if_no_rating', 10, 2);



function prevent_product_title_change($post_id, $post, $update) {
    // Перевіряємо, чи це товар і чи він оновлюється
    if ($post->post_type != 'product' || !$update) {
        return;
    }

    // Отримуємо оригінальну назву товару
    $original_title = get_post_meta($post_id, '_original_product_title', true);

    // Якщо оригінальна назва вже збережена, встановлюємо її назад
    if (!empty($original_title)) {
        remove_action('save_post', 'prevent_product_title_change', 10);
        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => $original_title,
        ));
        add_action('save_post', 'prevent_product_title_change', 10, 3);
    } else {
        // Зберігаємо оригінальну назву товару, якщо її ще немає
        add_post_meta($post_id, '_original_product_title', $post->post_title, true);
    }
}
add_action('save_post', 'prevent_product_title_change', 10, 3);

















//removing the product from the cart
// add_action( 'wp_ajax_remove_product_from_cart', 'remove_product_from_cart' );
// add_action( 'wp_ajax_nopriv_remove_product_from_cart', 'remove_product_from_cart' );
// function remove_product_from_cart() {

//     if ( isset( $_POST['cart_key'] ) ) {
//         $cart_item_key = sanitize_text_field( $_POST['cart_key'] );

//         WC()->cart->remove_cart_item( $cart_item_key );

//         echo json_encode( array(
//             'success' => true,
//             'message' => __( 'Товар видалено з кошика', 'woocommerce' )
//         ) );
//     } else {
//         echo json_encode( array(
//             'success' => false,
//             'message' => __( 'Missing cart key', 'woocommerce' )
//         ) );
//     }
//     wp_die();
// }

// // Додавання AJAX дії для оновлення кількості товарів у кошику
// add_action( 'wp_ajax_update_cart_quantity', 'update_cart_quantity' );
// add_action( 'wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity' );
// function update_cart_quantity() {
//     if ( isset( $_POST['cart_key'] ) && isset( $_POST['quantity'] ) ) {
//         $cart_item_key = sanitize_text_field( $_POST['cart_key'] );
//         $quantity = intval( $_POST['quantity'] );

//         if ( $quantity > 0 ) {
//             WC()->cart->set_quantity( $cart_item_key, $quantity );
//             WC()->cart->calculate_totals();
            
//             $total_items = WC()->cart->get_cart_contents_count();
//             $total_price = WC()->cart->get_cart_total();

//             echo json_encode( array(
//                 'success' => true,
//                 'total_items' => $total_items,
//                 'total_price' => $total_price
//             ) );
//         } else {
//             echo json_encode( array(
//                 'success' => false,
//                 'message' => __( 'Invalid quantity', 'woocommerce' )
//             ) );
//         }
//     } else {
//         echo json_encode( array(
//             'success' => false,
//             'message' => __( 'Missing parameters', 'woocommerce' )
//         ) );
//     }
//     wp_die();
// }



