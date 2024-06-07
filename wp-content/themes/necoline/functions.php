<?php
//THEME SUPPORTS
add_action('after_setup_theme', function () {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
});
$current_language = pll_current_language();


//THEME EXTRAS
//require_once get_template_directory() . '/inc/post-types.php';
//require_once get_template_directory() . '/inc/spa.php';
//require_once get_template_directory() . '/inc/ajax.php';
require_once get_template_directory() . '/inc/theme-image.php';



//THEME MENUS
add_action('after_setup_theme', 'neco_register_nav_menu');

function neco_register_nav_menu()
{
	// register_nav_menu( 'main', 'Top Menu' );
	register_nav_menus([
		'main' => esc_html__('Основное меню'),
		'mobile' => esc_html__('Мобильное меню'),
		'footer_menu_1' => esc_html__('Меню в подвале 1'),
		'footer_menu_2' => esc_html__('Меню в подвале 2'),
		'footer_menu_3' => esc_html__('Меню в подвале 3'),
		'footer_menu_4' => esc_html__('Меню в подвале 4'),
	]);
}
add_filter('nav_menu_item_id', 'filter_menu_item_css_id', 10, 4);
function filter_menu_item_css_id($menu_id, $item, $args, $depth)
{
	return $args->theme_location === 'main' ? '' : $menu_id;
}

// Изменяем атрибут class у тега li
add_filter('nav_menu_css_class', 'filter_nav_menu_css_classes', 10, 4);
function filter_nav_menu_css_classes($classes, $item, $args, $depth)
{
	if ($args->theme_location === 'main') {
		$classes = [];
		if ($depth == 0) {
			$classes = [
				'main-header__item'
			];
		}

		global $wpdb;
		$has_children = $wpdb->get_var("SELECT COUNT(meta_id) FROM wp_postmeta WHERE meta_key='_menu_item_menu_item_parent' AND meta_value='" . $item->ID . "'");
		if ($has_children > 0) {
			$classes[] = 'drop-down';
		}

		if ($item->current) {
			$classes[] = 'menu--active';
		}
		if ($depth > 0) {
			$classes[] = 'main-header__inner-item';
		}
		// var_dump($item);
	}
	if ($args->theme_location === 'mobile') {
		if (in_array('menu-item-has-children', $classes)) {
			$dropdown = true;
		}
		if ($dropdown) {
			$classes[] = 'mobile-menu__item';
			$args->before = '<div class="mobile-menu__link-container">';
			$args->after = '<button class="mobile-menu__more-button"></button></div>';
		} else {
			$args->before = '';
			$args->after = '';
		}
	}

	return $classes;
}

// Изменяет класс у вложенного ul
add_filter('nav_menu_submenu_css_class', 'filter_nav_menu_submenu_css_class', 10, 3);
function filter_nav_menu_submenu_css_class($classes, $args, $depth)
{
	if ($args->theme_location === 'main') {
		$classes = [
			'main-header__inner-list'
		];
	}
	if ($args->theme_location === 'mobile') {
		$classes = [
			'mobile-menu__inner-list'
		];
	}

	return $classes;
}

// ДОбавляем классы ссылкам
add_filter('nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4);
function filter_nav_menu_link_attributes($atts, $item, $args, $depth)
{
	if ($args->theme_location === 'main') {
		$atts['class'] = 'main-header__link title title--h6';

		if ($item->current) {
			$atts['class'] .= ' menu-link--active';
		}
		if ($depth > 0) {
			$atts['class'] = 'main-header__inner-link';
		}
	}
	if ($args->theme_location === 'mobile') {
		$atts['class'] = 'mobile-menu__link title title--h6';
		if ($depth > 0) {
			$atts['class'] = 'mobile-menu__inner-link title title--h6';
		}
	}

	return $atts;
}

//THEME STYLES & SCRIPTS
add_action('wp_enqueue_scripts', 'theme_styles_and_scripts');

function theme_styles_and_scripts()
{
	$ver = '1.4';
	$css_url = get_template_directory_uri() . '/assets/css/';
	$js_url = get_template_directory_uri() . '/assets/js/';

	//Enqueue Fonts
	wp_enqueue_style('Roboto', 'https://fonts.googleapis.com/css2?family=Roboto&display=swap', array(), null);
	wp_enqueue_style('HalvarBd', get_template_directory_uri() . '/assets/fonts/HalvarBreit-Bd/style.css', array(), null);
	wp_enqueue_style('HalvarRg', get_template_directory_uri() . '/assets/fonts/HalvarBreit-Rg/style.css', array(), null);

	//Enqueue main theme style
	wp_enqueue_style('css-main', get_stylesheet_uri(), array(), $ver);

	//Enqueue additional .css files
	wp_enqueue_style('css-variables', $css_url . 'variables.css', array(), $ver);
	wp_enqueue_style('css-normalize', $css_url . 'normalize.css', array(), $ver);

	wp_enqueue_style('main-css', $css_url . 'main.css', array(), $ver);

	//Enqueue .js files
	wp_enqueue_script('imask-js', $js_url . 'imask.js', array(), $ver, true);
	wp_enqueue_script('custom-js', $js_url . 'custom.js', array(), $ver, true);
	wp_enqueue_script('main-js', $js_url . 'main.js', array('jquery'), $ver, true);

	if (is_page_template('schedule-ships.php')) {
		wp_enqueue_style('schedule-css', $css_url . 'schedule.css', array(), $ver);
		wp_enqueue_script('schedule-js', $js_url . 'schedule.js', array('jquery'), $ver, true);
		//wp_localize_script( 'schedule-js', 'necoajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		//wp_enqueue_script( 'schedule-js');
		wp_register_script('my-custom-script', get_template_directory_uri() . '/assets/js/ajax-filter.js', array('jquery'), $ver, true);
		wp_localize_script('my-custom-script', 'myScriptParams', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script('my-custom-script');
	}
	if (is_page_template('main-page.php')) {
		wp_enqueue_style('main-page-css', $css_url . 'main-page.css', array(), $ver);
		wp_enqueue_script('main-page-js', $js_url . 'main-page.js', array('jquery'), $ver, true);
	}
	if (is_404()) {
		wp_enqueue_style('404-css', $css_url . '404.css', array(), $ver);
		wp_enqueue_script('404-js', $js_url . '404.js', array('jquery'), $ver, true);
	}
	if (is_page_template('page-about.php')) {
		wp_enqueue_style('about-css', $css_url . 'about-company.css', array(), $ver);
		wp_enqueue_style('team-css', $css_url . 'team-page.css', array(), $ver);
		wp_enqueue_script('about-js', $js_url . 'about-company.js', array('jquery'), $ver, true);
		wp_enqueue_script('team-js', $js_url . 'team-page.js', array('jquery'), $ver, true);
	}
	if (is_page_template('page-activities.php')) {
		wp_enqueue_style('activities-css', $css_url . 'activities.css', array(), $ver);
		wp_enqueue_script('activities-js', $js_url . 'activities.js', array('jquery'), $ver, true);
	}
	if (is_page_template('page-services.php')) {
		wp_enqueue_style('services-css', $css_url . 'services-page.css', array(), $ver);
		wp_enqueue_script('services-js', $js_url . 'services-page.js', array('jquery'), $ver, true);
	}
	if (is_page_template('schedule-railway.php')) {
		wp_enqueue_style('railway-css', $css_url . 'railway-schedule.css', array(), $ver);
		wp_enqueue_script('railway-js', $js_url . 'railway-schedule.js', array('jquery'), $ver, true);
		wp_enqueue_script('jquery-ui-autocomplete');
		wp_register_script('railway-filter', get_template_directory_uri() . '/assets/js/ajax-filter-railway.js', array('jquery'), $ver, true);
		wp_localize_script('railway-filter', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script('railway-filter');
	}
	if (is_page_template('page-documents.php')) {
		wp_enqueue_style('documentations-css', $css_url . 'documentations.css', array(), $ver);
		wp_enqueue_script('documentations-js', $js_url . 'documentations.js', array('jquery'), $ver, true);
	}
	if (is_page_template('page-contacts.php')) {
		wp_enqueue_style('contacts-css', $css_url . 'contacts.css', array(), $ver);
		wp_enqueue_script('contacts-js', $js_url . 'contacts.js', array('jquery'), $ver, true);
	}
	if (is_page_template('page-shipping.php')) {
		wp_enqueue_style('shipping-css', $css_url . 'shipping-page.css', array(), $ver);
		wp_enqueue_script('shipping-js', $js_url . 'shipping-page.js', array('jquery'), $ver, true);
	}
	if (is_tax('directions')) {
		wp_enqueue_style('directions-css', $css_url . 'directions.css', array(), $ver);
		wp_enqueue_script('directions-js', $js_url . 'directions.js', array('jquery'), $ver, true);
	}
	if (is_page_template('ships.php')) {
		wp_enqueue_style('ship-css', $css_url . 'ship-page.css', array(), $ver);
		wp_enqueue_script('ship-js', $js_url . 'ship-page.js', array('jquery'), $ver, true);
	}
	if (is_singular('services')) {
		wp_enqueue_style('service-css', $css_url . 'directions-service.css', array(), $ver);
		wp_enqueue_script('service-js', $js_url . 'directions-service.js', array('jquery'), $ver, true);
	}
	if (is_page_template('page-multimodal.php')) {
		wp_enqueue_style('multimodal-css', $css_url . 'multimodal.css', array(), $ver);
		wp_enqueue_script('multimodal-js', $js_url . 'multimodal.js', array('jquery'), $ver, true);
	}
	if (is_category()) {
		wp_enqueue_style('cats-css', $css_url . 'cats.css', array(), $ver);
		// wp_enqueue_script( 'cats-js', $js_url . 'cats.js', array('jquery'), $ver, true);
		wp_register_script('cats-pagination', get_template_directory_uri() . '/assets/js/cats-pagination.js', array('jquery'), $ver, true);
		wp_localize_script('cats-pagination', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script('cats-pagination');
		wp_enqueue_script('cats-custom', $js_url . 'cats-custom.js', array(), $ver, true);
	}
	if (is_single()) {
		wp_enqueue_style('post-css', $css_url . 'post.css', array(), $ver);
	}
}


//ENABLING - DISABLING GUTENBERG FOR CERTAIN POST TYPES
add_filter('use_block_editor_for_post_type', 'theme_gutenberg_support_for_post_types', 10, 2);

function theme_gutenberg_support_for_post_types($use_block_editor, $post_type)
{
	if ($post_type == 'post') {
		return true;
	} else {
		return false;
	}
}

//NecoLine
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'  => 'Настройки темы',
		'menu_title'  => 'Настройки темы',
		'menu_slug'   => 'all-settings',
		'capability'  => 'edit_posts',
		'position'    => '30.1',
		'redirect'    => false,
		'icon_url'    => 'dashicons-screenoptions',
	));

	// Страница опций для английского языка, создание страницы опций, для примера
	// acf_add_options_page(array(
	// 	'page_title'  => 'Theme Settings (EN)',
	// 	'menu_title'  => 'Theme Settings (EN)',
	// 	'menu_slug'   => 'theme-settings-en',
	// 	'capability'  => 'edit_posts',
	// 	'position'    => '30.2',
	// 	'redirect'    => false,
	// 	'icon_url'    => 'dashicons-screenoptions',
	// ));
}

add_action('init', 'necoline_register_types');
function necoline_register_types()
{
	register_post_type('services', [
		'labels'             => [
			'name'               => 'Сервисы', // Основное название типа записи
			'singular_name'      => 'Сервисы', // отдельное название записи
			'add_new'            => 'Добавить Сервис',
			'add_new_item'       => 'Добавить новый Сервис',
			'edit_item'          => 'Редактировать Сервис',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать Сервисы',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Сервисы'

		],
		'public'             => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-controls-repeat',
		'hierarchical'       => 'false',
		'supports'           => array('title', 'thumbnail'),
		'has_arhive'         => true,
	]);
	register_taxonomy('directions', ['services', 'ships'], [
		'labels'                => [
			'name'              => 'Направления',
			'singular_name'     => 'Направления',
			'search_items'      => 'Найти направление',
			'all_items'         => 'Группа услуг',
			'view_item '        => 'Посмотреть',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить направление',
			'new_item_name'     => 'Добавить направление',
			'menu_name'         => 'Направления',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true
	]);
	register_post_type('ships', [
		'labels'             => [
			'name'               => 'Флот', // Основное название типа записи
			'singular_name'      => 'Флот', // отдельное название записи
			'add_new'            => 'Добавить Судно',
			'add_new_item'       => 'Добавить новое Судно',
			'edit_item'          => 'Редактировать',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать Судно',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Флот'

		],
		'public'             => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-sos',
		'hierarchical'       => 'false',
		'supports'           => array('title', 'thumbnail'),
		'has_arhive'         => true,
	]);
	register_post_type('containers', [
		'labels'             => [
			'name'               => 'Контейнеры', // Основное название типа записи
			'singular_name'      => 'Контейнеры', // отдельное название записи
			'add_new'            => 'Добавить контейнер',
			'add_new_item'       => 'Добавить новый контейнер',
			'edit_item'          => 'Редактировать',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать контейнер',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Контейнеры'

		],
		'public'             => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-networking',
		'hierarchical'       => 'false',
		'supports'           => array('title', 'thumbnail', 'editor'),
		'has_arhive'         => true,
	]);
	register_post_type('ports_posts', [
		'labels'             => [
			'name'               => 'Порты', // Основное название типа записи
			'singular_name'      => 'Порты', // отдельное название записи
			'add_new'            => 'Добавить порт',
			'add_new_item'       => 'Добавить новый порт',
			'edit_item'          => 'Редактировать',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать порт',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Порты'

		],
		'public'             => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-share',
		'hierarchical'       => 'false',
		'supports'           => array('title', 'thumbnail'),
		'has_arhive'         => true,
	]);
	register_taxonomy('ports', ['ports_posts'], [
		'labels'                => [
			'name'              => 'Типы портов',
			'singular_name'     => 'Типы портов',
			'search_items'      => 'Найти порт',
			'all_items'         => 'Типы портов',
			'view_item '        => 'Посмотреть',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить тип',
			'new_item_name'     => 'Добавить тип',
			'menu_name'         => 'Типы портов',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true
	]);
	register_post_type('schedule-1', [
		'labels'             => [
			'name'               => 'Список рейсов', // Основное название типа записи
			'singular_name'      => 'Расписание движения судов', // отдельное название записи
			'add_new'            => 'Добавить рейс',
			'add_new_item'       => 'Добавить новый рейс',
			'edit_item'          => 'Редактировать',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать рейс',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Расписание судов'

		],
		'public'             => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-list-view',
		'hierarchical'       => 'false',
		'supports'           => array('title', 'thumbnail'),
		'has_arhive'         => true,
	]);

	register_post_type('stations', [
		'labels'             => [
			'name'               => 'Станции', // Основное название типа записи
			'singular_name'      => 'Станции', // отдельное название записи
			'add_new'            => 'Добавить станцию',
			'add_new_item'       => 'Добавить новую Станцию',
			'edit_item'          => 'Редактировать Станцию',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать Станцию',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Станции'

		],
		'public'             => true,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-list-view',
		'hierarchical'       => 'false',
		'supports'           => array('title', 'thumbnail'),
		'has_arhive'         => true,
	]);
	register_taxonomy('station_type', ['stations'], [
		'labels'                => [
			'name'              => 'Типы Станций',
			'singular_name'     => 'Типы Станций',
			'search_items'      => 'Найти Станцию',
			'all_items'         => 'Типы Станции',
			'view_item '        => 'Посмотреть',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить Тип',
			'new_item_name'     => 'Добавить Тип',
			'menu_name'         => 'Типы Станций',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true
	]);
	// register_taxonomy( 'station_end', [ 'stations' ], [
	// 	'labels'                => [
	// 		'name'              => 'Станции назначения',
	// 		'singular_name'     => 'Станция назначения',
	// 		'search_items'      => 'Найти станцию',
	// 		'all_items'         => 'Станции назначения',
	// 		'view_item '        => 'Посмотреть',
	// 		'edit_item'         => 'Редактировать',
	// 		'update_item'       => 'Обновить',
	// 		'add_new_item'      => 'Добавить станцию',
	// 		'new_item_name'     => 'Добавить станцию',
	// 		'menu_name'         => 'Станции назначения',
	// 	],
	// 	'description'           => '', // описание таксономии
	// 	'public'                => true,
	// 	'hierarchical'          => true
	// ] );
	// register_taxonomy( 'station_operation', [ 'stations' ], [
	// 	'labels'                => [
	// 		'name'              => 'Станции операции',
	// 		'singular_name'     => 'Станция операции',
	// 		'search_items'      => 'Найти станцию',
	// 		'all_items'         => 'Станции операции',
	// 		'view_item '        => 'Посмотреть',
	// 		'edit_item'         => 'Редактировать',
	// 		'update_item'       => 'Обновить',
	// 		'add_new_item'      => 'Добавить станцию',
	// 		'new_item_name'     => 'Добавить станцию',
	// 		'menu_name'         => 'Станции операции',
	// 	],
	// 	'description'           => '', // описание таксономии
	// 	'public'                => true,
	// 	'hierarchical'          => true
	// ] );
	register_post_type('docs', [
		'labels'             => [
			'name'               => 'Документы', // Основное название типа записи
			'singular_name'      => 'Документы', // отдельное название записи
			'add_new'            => 'Добавить документ',
			'add_new_item'       => 'Добавить новый документ',
			'edit_item'          => 'Редактировать',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать документ',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Документы'

		],
		'public'             => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-pdf',
		'hierarchical'       => 'false',
		'supports'           => array('title'),
		'has_arhive'         => true,
	]);

	register_taxonomy('document_type', ['docs'], [
		'labels'                => [
			'name'              => 'Типы документа',
			'singular_name'     => 'Типы документов',
			'search_items'      => 'Найти документ',
			'all_items'         => 'Типы документов',
			'view_item '        => 'Посмотреть',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить Тип',
			'new_item_name'     => 'Добавить Тип',
			'menu_name'         => 'Типы документов',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true
	]);

	register_post_type('team', [
		'labels'             => [
			'name'               => 'Сотрудники', // Основное название типа записи
			'singular_name'      => 'Сотрудники', // отдельное название записи
			'add_new'            => 'Добавить сотрудника',
			'add_new_item'       => 'Добавить нового сотрудника',
			'edit_item'          => 'Редактировать сотрудника',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Искать сотрудников',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Сотрудники'

		],
		'public'             => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-groups',
		'hierarchical'       => 'false',
		'supports'           => array('title', 'thumbnail'),
		'has_arhive'         => true,
	]);
	register_taxonomy('departments', ['team'], [
		'labels'                => [
			'name'              => 'Подразделения',
			'singular_name'     => 'Подразделения',
			'search_items'      => 'Найти подразделение',
			'all_items'         => 'Подразделения',
			'view_item '        => 'Посмотреть',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить подразделение',
			'new_item_name'     => 'Добавить подразделение',
			'menu_name'         => 'Подразделения',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => true
	]);
}

function neco_taxonomy_filter()
{
	global $typenow; // тип поста
	if ($typenow == 'ports_posts') { // для каких типов постов отображать
		$taxes = array('ports'); // таксономии через запятую
		foreach ($taxes as $tax) {
			$current_tax = isset($_GET[$tax]) ? $_GET[$tax] : '';
			$tax_obj = get_taxonomy($tax);
			$tax_name = mb_strtolower($tax_obj->labels->name);
			// функция mb_strtolower переводит в нижний регистр
			// она может не работать на некоторых хостингах, если что, убирайте её отсюда
			$terms = get_terms($tax);
			if (count($terms) > 0) {
				echo "<select name='$tax' id='$tax' class='postform'>";
				echo "<option value=''>Все $tax_name</option>";
				foreach ($terms as $term) {
					echo '<option value=' . $term->slug, $current_tax == $term->slug ? ' selected="selected"' : '', '>' . $term->name . ' (' . $term->count . ')</option>';
				}
				echo "</select>";
			}
		}
	}
}

add_action('restrict_manage_posts', 'neco_taxonomy_filter');


//Del ACF menu
// add_action( 'admin_menu', 'true_remove_acf_menu' );

// function true_remove_acf_menu(){
// 	remove_menu_page( 'edit.php?post_type=acf-field-group' );
// }

add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu()
{
	remove_menu_page('edit-comments.php'); // Комментарии	
}

//Test Filtr
function my_enqueue_assets()
{
	wp_enqueue_script('my-custom-script', get_template_directory_uri() . '/assets/js/ajax-filter.js', array('jquery'), null, true);

	wp_localize_script('my-custom-script', 'myScriptParams', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		// Другие локализованные данные, если необходимы
	));
}

add_action('wp_enqueue_scripts', 'my_enqueue_assets');


// документы

add_action('wp_ajax_load_documents', 'load_documents');
add_action('wp_ajax_nopriv_load_documents', 'load_documents');

function load_documents()
{
	ob_start();

	$args = array(
		'post_type'      => 'docs',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);

	if (isset($_POST['doc-type']) && $_POST['doc-type'] !== '') {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'document_type',
				'field'    => 'name',
				'terms'    => $_POST['doc-type'],
			)
		);
	} else {
		unset($args['tax_query']);
	}

	$query = new WP_Query($args);
?>
	<div class="documentations">
		<?php
		if ($_POST['tab-index-doc'] === "0") {
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
					<?php if (have_rows('files')) : the_row();
					?>
						<div class="documentations__item">
							<div class="documentations__text-contet">
								<div class="documentations__pdf-icon">
									<img src="<?php theme_image('file-pdf.svg') ?>" alt="PDF" />
								</div>
								<div class="documentations__text">
									<div class="documentations__title title title--h4"><?php the_title() ?></div>
									<a href="#" class="documentations__history-link title"><?php the_sub_field('date') ?></a>
								</div>
							</div>
							<div class="documentations__action">
								<a href="<?php the_sub_field('file') ?>" class="documentations__button documentations__button--primary button button--primary title title--button" download>
									<span><?php esc_html_e('скачать', 'necoline'); ?></span>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M12 16L7 11L8.4 9.55L11 12.15V4H13V12.15L15.6 9.55L17 11L12 16ZM4 20V15H6V18H18V15H20V20H4Z" fill="currentColor" />
									</svg>
								</a>
								<a href="<?php the_sub_field('file') ?>" class="documentations__button documentations__button--outline button title title--button" target="_blank">
									<span><?php esc_html_e('подробнее', 'necoline'); ?></span>
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g id="icon/watch">
											<g id="Vector">
												<mask id="path-1-outside-1_1901_21493" maskUnits="userSpaceOnUse" x="2.5" y="3" width="19" height="18" fill="black">
													<rect fill="white" x="2.5" y="3" width="19" height="18" />
													<path d="M15.1875 4C15.4089 4 15.6247 4.03333 15.835 4.1C16.0452 4.16667 16.2389 4.26667 16.416 4.4C16.5931 4.53333 16.748 4.68333 16.8809 4.85C17.0137 5.01667 17.1188 5.21111 17.1963 5.43333L20.2095 14.5C20.4032 15.0722 20.5 15.6611 20.5 16.2667C20.5 16.7833 20.4032 17.2667 20.2095 17.7167C20.0158 18.1667 19.7502 18.5611 19.4126 18.9C19.075 19.2389 18.6821 19.5056 18.2339 19.7C17.7856 19.8944 17.3014 19.9944 16.7812 20C16.2887 20 15.8156 19.9056 15.3618 19.7167C14.908 19.5278 14.5041 19.2583 14.1499 18.9083C13.8013 18.5583 13.5329 18.1556 13.3447 17.7C13.1566 17.2444 13.0625 16.7667 13.0625 16.2667V12.5333H10.9375V16.2667C10.9375 16.7611 10.8434 17.2361 10.6553 17.6917C10.4671 18.1472 10.1987 18.5528 9.8501 18.9083C9.50146 19.2583 9.10026 19.5278 8.64648 19.7167C8.19271 19.9056 7.7168 20 7.21875 20C6.7041 20 6.22266 19.9028 5.77441 19.7083C5.32617 19.5139 4.93327 19.2472 4.5957 18.9083C4.25814 18.5694 3.99251 18.175 3.79883 17.725C3.60514 17.275 3.50553 16.7889 3.5 16.2667C3.5 15.6611 3.59684 15.0722 3.79053 14.5C3.8182 14.4222 3.88184 14.2333 3.98145 13.9333C4.08105 13.6333 4.2028 13.2611 4.34668 12.8167C4.49056 12.3722 4.65381 11.8833 4.83643 11.35C5.01904 10.8167 5.20166 10.275 5.38428 9.725C5.56689 9.175 5.74398 8.64167 5.91553 8.125C6.08708 7.60833 6.23926 7.14722 6.37207 6.74167C6.50488 6.33611 6.61003 6.01389 6.6875 5.775C6.76497 5.53611 6.80648 5.41389 6.81201 5.40833C6.89502 5.20278 7.00293 5.01389 7.13574 4.84167C7.26855 4.66944 7.42074 4.51944 7.59229 4.39167C7.76383 4.26389 7.95475 4.16944 8.16504 4.10833C8.37533 4.04722 8.59115 4.01111 8.8125 4C9.22201 4 9.5568 4.06667 9.81689 4.2C10.077 4.33333 10.2873 4.51111 10.4478 4.73333C10.6082 4.95556 10.7244 5.21389 10.7964 5.50833C10.8683 5.80278 10.9126 6.10833 10.9292 6.425C10.9458 6.74167 10.9541 7.05833 10.9541 7.375C10.9541 7.69167 10.9486 7.98889 10.9375 8.26667H13.0625C13.0625 7.99444 13.0597 7.7 13.0542 7.38333C13.0487 7.06667 13.0514 6.74722 13.0625 6.425C13.0736 6.10278 13.1206 5.8 13.2036 5.51667C13.2866 5.23333 13.4001 4.975 13.5439 4.74167C13.6878 4.50833 13.8981 4.32778 14.1748 4.2C14.4515 4.07222 14.7891 4.00556 15.1875 4ZM7.21875 18.9333C7.58398 18.9333 7.92708 18.8639 8.24805 18.725C8.56901 18.5861 8.84847 18.3944 9.08643 18.15C9.32438 17.9056 9.5153 17.6222 9.65918 17.3C9.80306 16.9778 9.875 16.6333 9.875 16.2667C9.875 15.9 9.80583 15.5556 9.66748 15.2333C9.52913 14.9111 9.33822 14.6306 9.09473 14.3917C8.85124 14.1528 8.56901 13.9611 8.24805 13.8167C7.92708 13.6722 7.58398 13.6 7.21875 13.6C6.85352 13.6 6.51042 13.6694 6.18945 13.8083C5.86849 13.9472 5.58903 14.1389 5.35107 14.3833C5.11312 14.6278 4.9222 14.9111 4.77832 15.2333C4.63444 15.5556 4.5625 15.9 4.5625 16.2667C4.5625 16.6333 4.63167 16.9778 4.77002 17.3C4.90837 17.6222 5.09928 17.9028 5.34277 18.1417C5.58626 18.3806 5.86849 18.5722 6.18945 18.7167C6.51042 18.8611 6.85352 18.9333 7.21875 18.9333ZM9.875 6.13333C9.875 5.98333 9.84733 5.84444 9.79199 5.71667C9.73665 5.58889 9.66195 5.47778 9.56787 5.38333C9.4738 5.28889 9.36035 5.21111 9.22754 5.15C9.09473 5.08889 8.95638 5.06111 8.8125 5.06667C8.59668 5.06667 8.39469 5.13333 8.20654 5.26667C8.01839 5.4 7.88558 5.57222 7.80811 5.78333L5.40918 13C5.69141 12.85 5.9847 12.7361 6.28906 12.6583C6.59342 12.5806 6.90332 12.5389 7.21875 12.5333C7.40137 12.5333 7.62272 12.5583 7.88281 12.6083C8.1429 12.6583 8.40576 12.7333 8.67139 12.8333C8.93701 12.9333 9.17773 13.0528 9.39355 13.1917C9.60938 13.3306 9.76986 13.4861 9.875 13.6583V6.13333ZM13.0625 11.4667V9.33333H10.9375V11.4667H13.0625ZM14.125 13.6583C14.2246 13.4861 14.3823 13.3306 14.5981 13.1917C14.814 13.0528 15.0547 12.9361 15.3203 12.8417C15.5859 12.7472 15.8488 12.6722 16.1089 12.6167C16.369 12.5611 16.5931 12.5333 16.7812 12.5333C17.0967 12.5333 17.4066 12.5722 17.7109 12.65C18.0153 12.7278 18.3086 12.8444 18.5908 13L16.1919 5.78333C16.12 5.57222 15.9899 5.4 15.8018 5.26667C15.6136 5.13333 15.4089 5.06667 15.1875 5.06667C15.0381 5.06667 14.8997 5.09444 14.7725 5.15C14.6452 5.20556 14.5345 5.28056 14.4404 5.375C14.3464 5.46944 14.2689 5.58333 14.208 5.71667C14.1471 5.85 14.1195 5.98889 14.125 6.13333V13.6583ZM16.7812 18.9333C17.1465 18.9333 17.4896 18.8639 17.8105 18.725C18.1315 18.5861 18.411 18.3944 18.6489 18.15C18.8869 17.9056 19.0778 17.6222 19.2217 17.3C19.3656 16.9778 19.4375 16.6333 19.4375 16.2667C19.4375 15.9 19.3683 15.5556 19.23 15.2333C19.0916 14.9111 18.9007 14.6306 18.6572 14.3917C18.4137 14.1528 18.1315 13.9611 17.8105 13.8167C17.4896 13.6722 17.1465 13.6 16.7812 13.6C16.416 13.6 16.0729 13.6694 15.752 13.8083C15.431 13.9472 15.1515 14.1389 14.9136 14.3833C14.6756 14.6278 14.4847 14.9111 14.3408 15.2333C14.1969 15.5556 14.125 15.9 14.125 16.2667C14.125 16.6333 14.1942 16.9778 14.3325 17.3C14.4709 17.6222 14.6618 17.9028 14.9053 18.1417C15.1488 18.3806 15.431 18.5722 15.752 18.7167C16.0729 18.8611 16.416 18.9333 16.7812 18.9333Z" />
												</mask>
												<path d="M15.1875 4C15.4089 4 15.6247 4.03333 15.835 4.1C16.0452 4.16667 16.2389 4.26667 16.416 4.4C16.5931 4.53333 16.748 4.68333 16.8809 4.85C17.0137 5.01667 17.1188 5.21111 17.1963 5.43333L20.2095 14.5C20.4032 15.0722 20.5 15.6611 20.5 16.2667C20.5 16.7833 20.4032 17.2667 20.2095 17.7167C20.0158 18.1667 19.7502 18.5611 19.4126 18.9C19.075 19.2389 18.6821 19.5056 18.2339 19.7C17.7856 19.8944 17.3014 19.9944 16.7812 20C16.2887 20 15.8156 19.9056 15.3618 19.7167C14.908 19.5278 14.5041 19.2583 14.1499 18.9083C13.8013 18.5583 13.5329 18.1556 13.3447 17.7C13.1566 17.2444 13.0625 16.7667 13.0625 16.2667V12.5333H10.9375V16.2667C10.9375 16.7611 10.8434 17.2361 10.6553 17.6917C10.4671 18.1472 10.1987 18.5528 9.8501 18.9083C9.50146 19.2583 9.10026 19.5278 8.64648 19.7167C8.19271 19.9056 7.7168 20 7.21875 20C6.7041 20 6.22266 19.9028 5.77441 19.7083C5.32617 19.5139 4.93327 19.2472 4.5957 18.9083C4.25814 18.5694 3.99251 18.175 3.79883 17.725C3.60514 17.275 3.50553 16.7889 3.5 16.2667C3.5 15.6611 3.59684 15.0722 3.79053 14.5C3.8182 14.4222 3.88184 14.2333 3.98145 13.9333C4.08105 13.6333 4.2028 13.2611 4.34668 12.8167C4.49056 12.3722 4.65381 11.8833 4.83643 11.35C5.01904 10.8167 5.20166 10.275 5.38428 9.725C5.56689 9.175 5.74398 8.64167 5.91553 8.125C6.08708 7.60833 6.23926 7.14722 6.37207 6.74167C6.50488 6.33611 6.61003 6.01389 6.6875 5.775C6.76497 5.53611 6.80648 5.41389 6.81201 5.40833C6.89502 5.20278 7.00293 5.01389 7.13574 4.84167C7.26855 4.66944 7.42074 4.51944 7.59229 4.39167C7.76383 4.26389 7.95475 4.16944 8.16504 4.10833C8.37533 4.04722 8.59115 4.01111 8.8125 4C9.22201 4 9.5568 4.06667 9.81689 4.2C10.077 4.33333 10.2873 4.51111 10.4478 4.73333C10.6082 4.95556 10.7244 5.21389 10.7964 5.50833C10.8683 5.80278 10.9126 6.10833 10.9292 6.425C10.9458 6.74167 10.9541 7.05833 10.9541 7.375C10.9541 7.69167 10.9486 7.98889 10.9375 8.26667H13.0625C13.0625 7.99444 13.0597 7.7 13.0542 7.38333C13.0487 7.06667 13.0514 6.74722 13.0625 6.425C13.0736 6.10278 13.1206 5.8 13.2036 5.51667C13.2866 5.23333 13.4001 4.975 13.5439 4.74167C13.6878 4.50833 13.8981 4.32778 14.1748 4.2C14.4515 4.07222 14.7891 4.00556 15.1875 4ZM7.21875 18.9333C7.58398 18.9333 7.92708 18.8639 8.24805 18.725C8.56901 18.5861 8.84847 18.3944 9.08643 18.15C9.32438 17.9056 9.5153 17.6222 9.65918 17.3C9.80306 16.9778 9.875 16.6333 9.875 16.2667C9.875 15.9 9.80583 15.5556 9.66748 15.2333C9.52913 14.9111 9.33822 14.6306 9.09473 14.3917C8.85124 14.1528 8.56901 13.9611 8.24805 13.8167C7.92708 13.6722 7.58398 13.6 7.21875 13.6C6.85352 13.6 6.51042 13.6694 6.18945 13.8083C5.86849 13.9472 5.58903 14.1389 5.35107 14.3833C5.11312 14.6278 4.9222 14.9111 4.77832 15.2333C4.63444 15.5556 4.5625 15.9 4.5625 16.2667C4.5625 16.6333 4.63167 16.9778 4.77002 17.3C4.90837 17.6222 5.09928 17.9028 5.34277 18.1417C5.58626 18.3806 5.86849 18.5722 6.18945 18.7167C6.51042 18.8611 6.85352 18.9333 7.21875 18.9333ZM9.875 6.13333C9.875 5.98333 9.84733 5.84444 9.79199 5.71667C9.73665 5.58889 9.66195 5.47778 9.56787 5.38333C9.4738 5.28889 9.36035 5.21111 9.22754 5.15C9.09473 5.08889 8.95638 5.06111 8.8125 5.06667C8.59668 5.06667 8.39469 5.13333 8.20654 5.26667C8.01839 5.4 7.88558 5.57222 7.80811 5.78333L5.40918 13C5.69141 12.85 5.9847 12.7361 6.28906 12.6583C6.59342 12.5806 6.90332 12.5389 7.21875 12.5333C7.40137 12.5333 7.62272 12.5583 7.88281 12.6083C8.1429 12.6583 8.40576 12.7333 8.67139 12.8333C8.93701 12.9333 9.17773 13.0528 9.39355 13.1917C9.60938 13.3306 9.76986 13.4861 9.875 13.6583V6.13333ZM13.0625 11.4667V9.33333H10.9375V11.4667H13.0625ZM14.125 13.6583C14.2246 13.4861 14.3823 13.3306 14.5981 13.1917C14.814 13.0528 15.0547 12.9361 15.3203 12.8417C15.5859 12.7472 15.8488 12.6722 16.1089 12.6167C16.369 12.5611 16.5931 12.5333 16.7812 12.5333C17.0967 12.5333 17.4066 12.5722 17.7109 12.65C18.0153 12.7278 18.3086 12.8444 18.5908 13L16.1919 5.78333C16.12 5.57222 15.9899 5.4 15.8018 5.26667C15.6136 5.13333 15.4089 5.06667 15.1875 5.06667C15.0381 5.06667 14.8997 5.09444 14.7725 5.15C14.6452 5.20556 14.5345 5.28056 14.4404 5.375C14.3464 5.46944 14.2689 5.58333 14.208 5.71667C14.1471 5.85 14.1195 5.98889 14.125 6.13333V13.6583ZM16.7812 18.9333C17.1465 18.9333 17.4896 18.8639 17.8105 18.725C18.1315 18.5861 18.411 18.3944 18.6489 18.15C18.8869 17.9056 19.0778 17.6222 19.2217 17.3C19.3656 16.9778 19.4375 16.6333 19.4375 16.2667C19.4375 15.9 19.3683 15.5556 19.23 15.2333C19.0916 14.9111 18.9007 14.6306 18.6572 14.3917C18.4137 14.1528 18.1315 13.9611 17.8105 13.8167C17.4896 13.6722 17.1465 13.6 16.7812 13.6C16.416 13.6 16.0729 13.6694 15.752 13.8083C15.431 13.9472 15.1515 14.1389 14.9136 14.3833C14.6756 14.6278 14.4847 14.9111 14.3408 15.2333C14.1969 15.5556 14.125 15.9 14.125 16.2667C14.125 16.6333 14.1942 16.9778 14.3325 17.3C14.4709 17.6222 14.6618 17.9028 14.9053 18.1417C15.1488 18.3806 15.431 18.5722 15.752 18.7167C16.0729 18.8611 16.416 18.9333 16.7812 18.9333Z" fill="#314D71" />
												<path d="M15.1875 4C15.4089 4 15.6247 4.03333 15.835 4.1C16.0452 4.16667 16.2389 4.26667 16.416 4.4C16.5931 4.53333 16.748 4.68333 16.8809 4.85C17.0137 5.01667 17.1188 5.21111 17.1963 5.43333L20.2095 14.5C20.4032 15.0722 20.5 15.6611 20.5 16.2667C20.5 16.7833 20.4032 17.2667 20.2095 17.7167C20.0158 18.1667 19.7502 18.5611 19.4126 18.9C19.075 19.2389 18.6821 19.5056 18.2339 19.7C17.7856 19.8944 17.3014 19.9944 16.7812 20C16.2887 20 15.8156 19.9056 15.3618 19.7167C14.908 19.5278 14.5041 19.2583 14.1499 18.9083C13.8013 18.5583 13.5329 18.1556 13.3447 17.7C13.1566 17.2444 13.0625 16.7667 13.0625 16.2667V12.5333H10.9375V16.2667C10.9375 16.7611 10.8434 17.2361 10.6553 17.6917C10.4671 18.1472 10.1987 18.5528 9.8501 18.9083C9.50146 19.2583 9.10026 19.5278 8.64648 19.7167C8.19271 19.9056 7.7168 20 7.21875 20C6.7041 20 6.22266 19.9028 5.77441 19.7083C5.32617 19.5139 4.93327 19.2472 4.5957 18.9083C4.25814 18.5694 3.99251 18.175 3.79883 17.725C3.60514 17.275 3.50553 16.7889 3.5 16.2667C3.5 15.6611 3.59684 15.0722 3.79053 14.5C3.8182 14.4222 3.88184 14.2333 3.98145 13.9333C4.08105 13.6333 4.2028 13.2611 4.34668 12.8167C4.49056 12.3722 4.65381 11.8833 4.83643 11.35C5.01904 10.8167 5.20166 10.275 5.38428 9.725C5.56689 9.175 5.74398 8.64167 5.91553 8.125C6.08708 7.60833 6.23926 7.14722 6.37207 6.74167C6.50488 6.33611 6.61003 6.01389 6.6875 5.775C6.76497 5.53611 6.80648 5.41389 6.81201 5.40833C6.89502 5.20278 7.00293 5.01389 7.13574 4.84167C7.26855 4.66944 7.42074 4.51944 7.59229 4.39167C7.76383 4.26389 7.95475 4.16944 8.16504 4.10833C8.37533 4.04722 8.59115 4.01111 8.8125 4C9.22201 4 9.5568 4.06667 9.81689 4.2C10.077 4.33333 10.2873 4.51111 10.4478 4.73333C10.6082 4.95556 10.7244 5.21389 10.7964 5.50833C10.8683 5.80278 10.9126 6.10833 10.9292 6.425C10.9458 6.74167 10.9541 7.05833 10.9541 7.375C10.9541 7.69167 10.9486 7.98889 10.9375 8.26667H13.0625C13.0625 7.99444 13.0597 7.7 13.0542 7.38333C13.0487 7.06667 13.0514 6.74722 13.0625 6.425C13.0736 6.10278 13.1206 5.8 13.2036 5.51667C13.2866 5.23333 13.4001 4.975 13.5439 4.74167C13.6878 4.50833 13.8981 4.32778 14.1748 4.2C14.4515 4.07222 14.7891 4.00556 15.1875 4ZM7.21875 18.9333C7.58398 18.9333 7.92708 18.8639 8.24805 18.725C8.56901 18.5861 8.84847 18.3944 9.08643 18.15C9.32438 17.9056 9.5153 17.6222 9.65918 17.3C9.80306 16.9778 9.875 16.6333 9.875 16.2667C9.875 15.9 9.80583 15.5556 9.66748 15.2333C9.52913 14.9111 9.33822 14.6306 9.09473 14.3917C8.85124 14.1528 8.56901 13.9611 8.24805 13.8167C7.92708 13.6722 7.58398 13.6 7.21875 13.6C6.85352 13.6 6.51042 13.6694 6.18945 13.8083C5.86849 13.9472 5.58903 14.1389 5.35107 14.3833C5.11312 14.6278 4.9222 14.9111 4.77832 15.2333C4.63444 15.5556 4.5625 15.9 4.5625 16.2667C4.5625 16.6333 4.63167 16.9778 4.77002 17.3C4.90837 17.6222 5.09928 17.9028 5.34277 18.1417C5.58626 18.3806 5.86849 18.5722 6.18945 18.7167C6.51042 18.8611 6.85352 18.9333 7.21875 18.9333ZM9.875 6.13333C9.875 5.98333 9.84733 5.84444 9.79199 5.71667C9.73665 5.58889 9.66195 5.47778 9.56787 5.38333C9.4738 5.28889 9.36035 5.21111 9.22754 5.15C9.09473 5.08889 8.95638 5.06111 8.8125 5.06667C8.59668 5.06667 8.39469 5.13333 8.20654 5.26667C8.01839 5.4 7.88558 5.57222 7.80811 5.78333L5.40918 13C5.69141 12.85 5.9847 12.7361 6.28906 12.6583C6.59342 12.5806 6.90332 12.5389 7.21875 12.5333C7.40137 12.5333 7.62272 12.5583 7.88281 12.6083C8.1429 12.6583 8.40576 12.7333 8.67139 12.8333C8.93701 12.9333 9.17773 13.0528 9.39355 13.1917C9.60938 13.3306 9.76986 13.4861 9.875 13.6583V6.13333ZM13.0625 11.4667V9.33333H10.9375V11.4667H13.0625ZM14.125 13.6583C14.2246 13.4861 14.3823 13.3306 14.5981 13.1917C14.814 13.0528 15.0547 12.9361 15.3203 12.8417C15.5859 12.7472 15.8488 12.6722 16.1089 12.6167C16.369 12.5611 16.5931 12.5333 16.7812 12.5333C17.0967 12.5333 17.4066 12.5722 17.7109 12.65C18.0153 12.7278 18.3086 12.8444 18.5908 13L16.1919 5.78333C16.12 5.57222 15.9899 5.4 15.8018 5.26667C15.6136 5.13333 15.4089 5.06667 15.1875 5.06667C15.0381 5.06667 14.8997 5.09444 14.7725 5.15C14.6452 5.20556 14.5345 5.28056 14.4404 5.375C14.3464 5.46944 14.2689 5.58333 14.208 5.71667C14.1471 5.85 14.1195 5.98889 14.125 6.13333V13.6583ZM16.7812 18.9333C17.1465 18.9333 17.4896 18.8639 17.8105 18.725C18.1315 18.5861 18.411 18.3944 18.6489 18.15C18.8869 17.9056 19.0778 17.6222 19.2217 17.3C19.3656 16.9778 19.4375 16.6333 19.4375 16.2667C19.4375 15.9 19.3683 15.5556 19.23 15.2333C19.0916 14.9111 18.9007 14.6306 18.6572 14.3917C18.4137 14.1528 18.1315 13.9611 17.8105 13.8167C17.4896 13.6722 17.1465 13.6 16.7812 13.6C16.416 13.6 16.0729 13.6694 15.752 13.8083C15.431 13.9472 15.1515 14.1389 14.9136 14.3833C14.6756 14.6278 14.4847 14.9111 14.3408 15.2333C14.1969 15.5556 14.125 15.9 14.125 16.2667C14.125 16.6333 14.1942 16.9778 14.3325 17.3C14.4709 17.6222 14.6618 17.9028 14.9053 18.1417C15.1488 18.3806 15.431 18.5722 15.752 18.7167C16.0729 18.8611 16.416 18.9333 16.7812 18.9333Z" stroke="#314D71" stroke-width="0.6" mask="url(#path-1-outside-1_1901_21493)" />
											</g>
										</g>
									</svg>
								</a>
							</div>
						</div>
					<?php endif; ?>
					<?php endwhile;
			endif;
		} else {
			$i = 0;
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
					if (have_rows('files')) :
						while (have_rows('files')) : the_row();
							if (get_row_index() > 1) : ?>
								<div class="documentations__item">
									<div class="documentations__text-contet">
										<div class="documentations__pdf-icon">
											<img src="<?php theme_image('file-pdf.svg') ?>" alt="PDF" />
										</div>
										<div class="documentations__text">
											<div class="documentations__title title title--h4"><?php the_title() ?></div>
											<a href="#" class="documentations__history-link title"><?php the_sub_field('date') ?></a>
										</div>
									</div>
									<div class="documentations__action">
										<a href="<?php the_sub_field('file') ?>" class="documentations__button documentations__button--primary button button--primary title title--button">
											<span>скачать</span>
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M12 16L7 11L8.4 9.55L11 12.15V4H13V12.15L15.6 9.55L17 11L12 16ZM4 20V15H6V18H18V15H20V20H4Z" fill="currentColor" />
											</svg>
										</a>
										<a href="<?php the_sub_field('file') ?>" class="documentations__button documentations__button--outline button title title--button">
											<span>подробнее</span>
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<g id="icon/watch">
													<g id="Vector">
														<mask id="path-1-outside-1_1901_21493" maskUnits="userSpaceOnUse" x="2.5" y="3" width="19" height="18" fill="black">
															<rect fill="white" x="2.5" y="3" width="19" height="18" />
															<path d="M15.1875 4C15.4089 4 15.6247 4.03333 15.835 4.1C16.0452 4.16667 16.2389 4.26667 16.416 4.4C16.5931 4.53333 16.748 4.68333 16.8809 4.85C17.0137 5.01667 17.1188 5.21111 17.1963 5.43333L20.2095 14.5C20.4032 15.0722 20.5 15.6611 20.5 16.2667C20.5 16.7833 20.4032 17.2667 20.2095 17.7167C20.0158 18.1667 19.7502 18.5611 19.4126 18.9C19.075 19.2389 18.6821 19.5056 18.2339 19.7C17.7856 19.8944 17.3014 19.9944 16.7812 20C16.2887 20 15.8156 19.9056 15.3618 19.7167C14.908 19.5278 14.5041 19.2583 14.1499 18.9083C13.8013 18.5583 13.5329 18.1556 13.3447 17.7C13.1566 17.2444 13.0625 16.7667 13.0625 16.2667V12.5333H10.9375V16.2667C10.9375 16.7611 10.8434 17.2361 10.6553 17.6917C10.4671 18.1472 10.1987 18.5528 9.8501 18.9083C9.50146 19.2583 9.10026 19.5278 8.64648 19.7167C8.19271 19.9056 7.7168 20 7.21875 20C6.7041 20 6.22266 19.9028 5.77441 19.7083C5.32617 19.5139 4.93327 19.2472 4.5957 18.9083C4.25814 18.5694 3.99251 18.175 3.79883 17.725C3.60514 17.275 3.50553 16.7889 3.5 16.2667C3.5 15.6611 3.59684 15.0722 3.79053 14.5C3.8182 14.4222 3.88184 14.2333 3.98145 13.9333C4.08105 13.6333 4.2028 13.2611 4.34668 12.8167C4.49056 12.3722 4.65381 11.8833 4.83643 11.35C5.01904 10.8167 5.20166 10.275 5.38428 9.725C5.56689 9.175 5.74398 8.64167 5.91553 8.125C6.08708 7.60833 6.23926 7.14722 6.37207 6.74167C6.50488 6.33611 6.61003 6.01389 6.6875 5.775C6.76497 5.53611 6.80648 5.41389 6.81201 5.40833C6.89502 5.20278 7.00293 5.01389 7.13574 4.84167C7.26855 4.66944 7.42074 4.51944 7.59229 4.39167C7.76383 4.26389 7.95475 4.16944 8.16504 4.10833C8.37533 4.04722 8.59115 4.01111 8.8125 4C9.22201 4 9.5568 4.06667 9.81689 4.2C10.077 4.33333 10.2873 4.51111 10.4478 4.73333C10.6082 4.95556 10.7244 5.21389 10.7964 5.50833C10.8683 5.80278 10.9126 6.10833 10.9292 6.425C10.9458 6.74167 10.9541 7.05833 10.9541 7.375C10.9541 7.69167 10.9486 7.98889 10.9375 8.26667H13.0625C13.0625 7.99444 13.0597 7.7 13.0542 7.38333C13.0487 7.06667 13.0514 6.74722 13.0625 6.425C13.0736 6.10278 13.1206 5.8 13.2036 5.51667C13.2866 5.23333 13.4001 4.975 13.5439 4.74167C13.6878 4.50833 13.8981 4.32778 14.1748 4.2C14.4515 4.07222 14.7891 4.00556 15.1875 4ZM7.21875 18.9333C7.58398 18.9333 7.92708 18.8639 8.24805 18.725C8.56901 18.5861 8.84847 18.3944 9.08643 18.15C9.32438 17.9056 9.5153 17.6222 9.65918 17.3C9.80306 16.9778 9.875 16.6333 9.875 16.2667C9.875 15.9 9.80583 15.5556 9.66748 15.2333C9.52913 14.9111 9.33822 14.6306 9.09473 14.3917C8.85124 14.1528 8.56901 13.9611 8.24805 13.8167C7.92708 13.6722 7.58398 13.6 7.21875 13.6C6.85352 13.6 6.51042 13.6694 6.18945 13.8083C5.86849 13.9472 5.58903 14.1389 5.35107 14.3833C5.11312 14.6278 4.9222 14.9111 4.77832 15.2333C4.63444 15.5556 4.5625 15.9 4.5625 16.2667C4.5625 16.6333 4.63167 16.9778 4.77002 17.3C4.90837 17.6222 5.09928 17.9028 5.34277 18.1417C5.58626 18.3806 5.86849 18.5722 6.18945 18.7167C6.51042 18.8611 6.85352 18.9333 7.21875 18.9333ZM9.875 6.13333C9.875 5.98333 9.84733 5.84444 9.79199 5.71667C9.73665 5.58889 9.66195 5.47778 9.56787 5.38333C9.4738 5.28889 9.36035 5.21111 9.22754 5.15C9.09473 5.08889 8.95638 5.06111 8.8125 5.06667C8.59668 5.06667 8.39469 5.13333 8.20654 5.26667C8.01839 5.4 7.88558 5.57222 7.80811 5.78333L5.40918 13C5.69141 12.85 5.9847 12.7361 6.28906 12.6583C6.59342 12.5806 6.90332 12.5389 7.21875 12.5333C7.40137 12.5333 7.62272 12.5583 7.88281 12.6083C8.1429 12.6583 8.40576 12.7333 8.67139 12.8333C8.93701 12.9333 9.17773 13.0528 9.39355 13.1917C9.60938 13.3306 9.76986 13.4861 9.875 13.6583V6.13333ZM13.0625 11.4667V9.33333H10.9375V11.4667H13.0625ZM14.125 13.6583C14.2246 13.4861 14.3823 13.3306 14.5981 13.1917C14.814 13.0528 15.0547 12.9361 15.3203 12.8417C15.5859 12.7472 15.8488 12.6722 16.1089 12.6167C16.369 12.5611 16.5931 12.5333 16.7812 12.5333C17.0967 12.5333 17.4066 12.5722 17.7109 12.65C18.0153 12.7278 18.3086 12.8444 18.5908 13L16.1919 5.78333C16.12 5.57222 15.9899 5.4 15.8018 5.26667C15.6136 5.13333 15.4089 5.06667 15.1875 5.06667C15.0381 5.06667 14.8997 5.09444 14.7725 5.15C14.6452 5.20556 14.5345 5.28056 14.4404 5.375C14.3464 5.46944 14.2689 5.58333 14.208 5.71667C14.1471 5.85 14.1195 5.98889 14.125 6.13333V13.6583ZM16.7812 18.9333C17.1465 18.9333 17.4896 18.8639 17.8105 18.725C18.1315 18.5861 18.411 18.3944 18.6489 18.15C18.8869 17.9056 19.0778 17.6222 19.2217 17.3C19.3656 16.9778 19.4375 16.6333 19.4375 16.2667C19.4375 15.9 19.3683 15.5556 19.23 15.2333C19.0916 14.9111 18.9007 14.6306 18.6572 14.3917C18.4137 14.1528 18.1315 13.9611 17.8105 13.8167C17.4896 13.6722 17.1465 13.6 16.7812 13.6C16.416 13.6 16.0729 13.6694 15.752 13.8083C15.431 13.9472 15.1515 14.1389 14.9136 14.3833C14.6756 14.6278 14.4847 14.9111 14.3408 15.2333C14.1969 15.5556 14.125 15.9 14.125 16.2667C14.125 16.6333 14.1942 16.9778 14.3325 17.3C14.4709 17.6222 14.6618 17.9028 14.9053 18.1417C15.1488 18.3806 15.431 18.5722 15.752 18.7167C16.0729 18.8611 16.416 18.9333 16.7812 18.9333Z" />
														</mask>
														<path d="M15.1875 4C15.4089 4 15.6247 4.03333 15.835 4.1C16.0452 4.16667 16.2389 4.26667 16.416 4.4C16.5931 4.53333 16.748 4.68333 16.8809 4.85C17.0137 5.01667 17.1188 5.21111 17.1963 5.43333L20.2095 14.5C20.4032 15.0722 20.5 15.6611 20.5 16.2667C20.5 16.7833 20.4032 17.2667 20.2095 17.7167C20.0158 18.1667 19.7502 18.5611 19.4126 18.9C19.075 19.2389 18.6821 19.5056 18.2339 19.7C17.7856 19.8944 17.3014 19.9944 16.7812 20C16.2887 20 15.8156 19.9056 15.3618 19.7167C14.908 19.5278 14.5041 19.2583 14.1499 18.9083C13.8013 18.5583 13.5329 18.1556 13.3447 17.7C13.1566 17.2444 13.0625 16.7667 13.0625 16.2667V12.5333H10.9375V16.2667C10.9375 16.7611 10.8434 17.2361 10.6553 17.6917C10.4671 18.1472 10.1987 18.5528 9.8501 18.9083C9.50146 19.2583 9.10026 19.5278 8.64648 19.7167C8.19271 19.9056 7.7168 20 7.21875 20C6.7041 20 6.22266 19.9028 5.77441 19.7083C5.32617 19.5139 4.93327 19.2472 4.5957 18.9083C4.25814 18.5694 3.99251 18.175 3.79883 17.725C3.60514 17.275 3.50553 16.7889 3.5 16.2667C3.5 15.6611 3.59684 15.0722 3.79053 14.5C3.8182 14.4222 3.88184 14.2333 3.98145 13.9333C4.08105 13.6333 4.2028 13.2611 4.34668 12.8167C4.49056 12.3722 4.65381 11.8833 4.83643 11.35C5.01904 10.8167 5.20166 10.275 5.38428 9.725C5.56689 9.175 5.74398 8.64167 5.91553 8.125C6.08708 7.60833 6.23926 7.14722 6.37207 6.74167C6.50488 6.33611 6.61003 6.01389 6.6875 5.775C6.76497 5.53611 6.80648 5.41389 6.81201 5.40833C6.89502 5.20278 7.00293 5.01389 7.13574 4.84167C7.26855 4.66944 7.42074 4.51944 7.59229 4.39167C7.76383 4.26389 7.95475 4.16944 8.16504 4.10833C8.37533 4.04722 8.59115 4.01111 8.8125 4C9.22201 4 9.5568 4.06667 9.81689 4.2C10.077 4.33333 10.2873 4.51111 10.4478 4.73333C10.6082 4.95556 10.7244 5.21389 10.7964 5.50833C10.8683 5.80278 10.9126 6.10833 10.9292 6.425C10.9458 6.74167 10.9541 7.05833 10.9541 7.375C10.9541 7.69167 10.9486 7.98889 10.9375 8.26667H13.0625C13.0625 7.99444 13.0597 7.7 13.0542 7.38333C13.0487 7.06667 13.0514 6.74722 13.0625 6.425C13.0736 6.10278 13.1206 5.8 13.2036 5.51667C13.2866 5.23333 13.4001 4.975 13.5439 4.74167C13.6878 4.50833 13.8981 4.32778 14.1748 4.2C14.4515 4.07222 14.7891 4.00556 15.1875 4ZM7.21875 18.9333C7.58398 18.9333 7.92708 18.8639 8.24805 18.725C8.56901 18.5861 8.84847 18.3944 9.08643 18.15C9.32438 17.9056 9.5153 17.6222 9.65918 17.3C9.80306 16.9778 9.875 16.6333 9.875 16.2667C9.875 15.9 9.80583 15.5556 9.66748 15.2333C9.52913 14.9111 9.33822 14.6306 9.09473 14.3917C8.85124 14.1528 8.56901 13.9611 8.24805 13.8167C7.92708 13.6722 7.58398 13.6 7.21875 13.6C6.85352 13.6 6.51042 13.6694 6.18945 13.8083C5.86849 13.9472 5.58903 14.1389 5.35107 14.3833C5.11312 14.6278 4.9222 14.9111 4.77832 15.2333C4.63444 15.5556 4.5625 15.9 4.5625 16.2667C4.5625 16.6333 4.63167 16.9778 4.77002 17.3C4.90837 17.6222 5.09928 17.9028 5.34277 18.1417C5.58626 18.3806 5.86849 18.5722 6.18945 18.7167C6.51042 18.8611 6.85352 18.9333 7.21875 18.9333ZM9.875 6.13333C9.875 5.98333 9.84733 5.84444 9.79199 5.71667C9.73665 5.58889 9.66195 5.47778 9.56787 5.38333C9.4738 5.28889 9.36035 5.21111 9.22754 5.15C9.09473 5.08889 8.95638 5.06111 8.8125 5.06667C8.59668 5.06667 8.39469 5.13333 8.20654 5.26667C8.01839 5.4 7.88558 5.57222 7.80811 5.78333L5.40918 13C5.69141 12.85 5.9847 12.7361 6.28906 12.6583C6.59342 12.5806 6.90332 12.5389 7.21875 12.5333C7.40137 12.5333 7.62272 12.5583 7.88281 12.6083C8.1429 12.6583 8.40576 12.7333 8.67139 12.8333C8.93701 12.9333 9.17773 13.0528 9.39355 13.1917C9.60938 13.3306 9.76986 13.4861 9.875 13.6583V6.13333ZM13.0625 11.4667V9.33333H10.9375V11.4667H13.0625ZM14.125 13.6583C14.2246 13.4861 14.3823 13.3306 14.5981 13.1917C14.814 13.0528 15.0547 12.9361 15.3203 12.8417C15.5859 12.7472 15.8488 12.6722 16.1089 12.6167C16.369 12.5611 16.5931 12.5333 16.7812 12.5333C17.0967 12.5333 17.4066 12.5722 17.7109 12.65C18.0153 12.7278 18.3086 12.8444 18.5908 13L16.1919 5.78333C16.12 5.57222 15.9899 5.4 15.8018 5.26667C15.6136 5.13333 15.4089 5.06667 15.1875 5.06667C15.0381 5.06667 14.8997 5.09444 14.7725 5.15C14.6452 5.20556 14.5345 5.28056 14.4404 5.375C14.3464 5.46944 14.2689 5.58333 14.208 5.71667C14.1471 5.85 14.1195 5.98889 14.125 6.13333V13.6583ZM16.7812 18.9333C17.1465 18.9333 17.4896 18.8639 17.8105 18.725C18.1315 18.5861 18.411 18.3944 18.6489 18.15C18.8869 17.9056 19.0778 17.6222 19.2217 17.3C19.3656 16.9778 19.4375 16.6333 19.4375 16.2667C19.4375 15.9 19.3683 15.5556 19.23 15.2333C19.0916 14.9111 18.9007 14.6306 18.6572 14.3917C18.4137 14.1528 18.1315 13.9611 17.8105 13.8167C17.4896 13.6722 17.1465 13.6 16.7812 13.6C16.416 13.6 16.0729 13.6694 15.752 13.8083C15.431 13.9472 15.1515 14.1389 14.9136 14.3833C14.6756 14.6278 14.4847 14.9111 14.3408 15.2333C14.1969 15.5556 14.125 15.9 14.125 16.2667C14.125 16.6333 14.1942 16.9778 14.3325 17.3C14.4709 17.6222 14.6618 17.9028 14.9053 18.1417C15.1488 18.3806 15.431 18.5722 15.752 18.7167C16.0729 18.8611 16.416 18.9333 16.7812 18.9333Z" fill="#314D71" />
														<path d="M15.1875 4C15.4089 4 15.6247 4.03333 15.835 4.1C16.0452 4.16667 16.2389 4.26667 16.416 4.4C16.5931 4.53333 16.748 4.68333 16.8809 4.85C17.0137 5.01667 17.1188 5.21111 17.1963 5.43333L20.2095 14.5C20.4032 15.0722 20.5 15.6611 20.5 16.2667C20.5 16.7833 20.4032 17.2667 20.2095 17.7167C20.0158 18.1667 19.7502 18.5611 19.4126 18.9C19.075 19.2389 18.6821 19.5056 18.2339 19.7C17.7856 19.8944 17.3014 19.9944 16.7812 20C16.2887 20 15.8156 19.9056 15.3618 19.7167C14.908 19.5278 14.5041 19.2583 14.1499 18.9083C13.8013 18.5583 13.5329 18.1556 13.3447 17.7C13.1566 17.2444 13.0625 16.7667 13.0625 16.2667V12.5333H10.9375V16.2667C10.9375 16.7611 10.8434 17.2361 10.6553 17.6917C10.4671 18.1472 10.1987 18.5528 9.8501 18.9083C9.50146 19.2583 9.10026 19.5278 8.64648 19.7167C8.19271 19.9056 7.7168 20 7.21875 20C6.7041 20 6.22266 19.9028 5.77441 19.7083C5.32617 19.5139 4.93327 19.2472 4.5957 18.9083C4.25814 18.5694 3.99251 18.175 3.79883 17.725C3.60514 17.275 3.50553 16.7889 3.5 16.2667C3.5 15.6611 3.59684 15.0722 3.79053 14.5C3.8182 14.4222 3.88184 14.2333 3.98145 13.9333C4.08105 13.6333 4.2028 13.2611 4.34668 12.8167C4.49056 12.3722 4.65381 11.8833 4.83643 11.35C5.01904 10.8167 5.20166 10.275 5.38428 9.725C5.56689 9.175 5.74398 8.64167 5.91553 8.125C6.08708 7.60833 6.23926 7.14722 6.37207 6.74167C6.50488 6.33611 6.61003 6.01389 6.6875 5.775C6.76497 5.53611 6.80648 5.41389 6.81201 5.40833C6.89502 5.20278 7.00293 5.01389 7.13574 4.84167C7.26855 4.66944 7.42074 4.51944 7.59229 4.39167C7.76383 4.26389 7.95475 4.16944 8.16504 4.10833C8.37533 4.04722 8.59115 4.01111 8.8125 4C9.22201 4 9.5568 4.06667 9.81689 4.2C10.077 4.33333 10.2873 4.51111 10.4478 4.73333C10.6082 4.95556 10.7244 5.21389 10.7964 5.50833C10.8683 5.80278 10.9126 6.10833 10.9292 6.425C10.9458 6.74167 10.9541 7.05833 10.9541 7.375C10.9541 7.69167 10.9486 7.98889 10.9375 8.26667H13.0625C13.0625 7.99444 13.0597 7.7 13.0542 7.38333C13.0487 7.06667 13.0514 6.74722 13.0625 6.425C13.0736 6.10278 13.1206 5.8 13.2036 5.51667C13.2866 5.23333 13.4001 4.975 13.5439 4.74167C13.6878 4.50833 13.8981 4.32778 14.1748 4.2C14.4515 4.07222 14.7891 4.00556 15.1875 4ZM7.21875 18.9333C7.58398 18.9333 7.92708 18.8639 8.24805 18.725C8.56901 18.5861 8.84847 18.3944 9.08643 18.15C9.32438 17.9056 9.5153 17.6222 9.65918 17.3C9.80306 16.9778 9.875 16.6333 9.875 16.2667C9.875 15.9 9.80583 15.5556 9.66748 15.2333C9.52913 14.9111 9.33822 14.6306 9.09473 14.3917C8.85124 14.1528 8.56901 13.9611 8.24805 13.8167C7.92708 13.6722 7.58398 13.6 7.21875 13.6C6.85352 13.6 6.51042 13.6694 6.18945 13.8083C5.86849 13.9472 5.58903 14.1389 5.35107 14.3833C5.11312 14.6278 4.9222 14.9111 4.77832 15.2333C4.63444 15.5556 4.5625 15.9 4.5625 16.2667C4.5625 16.6333 4.63167 16.9778 4.77002 17.3C4.90837 17.6222 5.09928 17.9028 5.34277 18.1417C5.58626 18.3806 5.86849 18.5722 6.18945 18.7167C6.51042 18.8611 6.85352 18.9333 7.21875 18.9333ZM9.875 6.13333C9.875 5.98333 9.84733 5.84444 9.79199 5.71667C9.73665 5.58889 9.66195 5.47778 9.56787 5.38333C9.4738 5.28889 9.36035 5.21111 9.22754 5.15C9.09473 5.08889 8.95638 5.06111 8.8125 5.06667C8.59668 5.06667 8.39469 5.13333 8.20654 5.26667C8.01839 5.4 7.88558 5.57222 7.80811 5.78333L5.40918 13C5.69141 12.85 5.9847 12.7361 6.28906 12.6583C6.59342 12.5806 6.90332 12.5389 7.21875 12.5333C7.40137 12.5333 7.62272 12.5583 7.88281 12.6083C8.1429 12.6583 8.40576 12.7333 8.67139 12.8333C8.93701 12.9333 9.17773 13.0528 9.39355 13.1917C9.60938 13.3306 9.76986 13.4861 9.875 13.6583V6.13333ZM13.0625 11.4667V9.33333H10.9375V11.4667H13.0625ZM14.125 13.6583C14.2246 13.4861 14.3823 13.3306 14.5981 13.1917C14.814 13.0528 15.0547 12.9361 15.3203 12.8417C15.5859 12.7472 15.8488 12.6722 16.1089 12.6167C16.369 12.5611 16.5931 12.5333 16.7812 12.5333C17.0967 12.5333 17.4066 12.5722 17.7109 12.65C18.0153 12.7278 18.3086 12.8444 18.5908 13L16.1919 5.78333C16.12 5.57222 15.9899 5.4 15.8018 5.26667C15.6136 5.13333 15.4089 5.06667 15.1875 5.06667C15.0381 5.06667 14.8997 5.09444 14.7725 5.15C14.6452 5.20556 14.5345 5.28056 14.4404 5.375C14.3464 5.46944 14.2689 5.58333 14.208 5.71667C14.1471 5.85 14.1195 5.98889 14.125 6.13333V13.6583ZM16.7812 18.9333C17.1465 18.9333 17.4896 18.8639 17.8105 18.725C18.1315 18.5861 18.411 18.3944 18.6489 18.15C18.8869 17.9056 19.0778 17.6222 19.2217 17.3C19.3656 16.9778 19.4375 16.6333 19.4375 16.2667C19.4375 15.9 19.3683 15.5556 19.23 15.2333C19.0916 14.9111 18.9007 14.6306 18.6572 14.3917C18.4137 14.1528 18.1315 13.9611 17.8105 13.8167C17.4896 13.6722 17.1465 13.6 16.7812 13.6C16.416 13.6 16.0729 13.6694 15.752 13.8083C15.431 13.9472 15.1515 14.1389 14.9136 14.3833C14.6756 14.6278 14.4847 14.9111 14.3408 15.2333C14.1969 15.5556 14.125 15.9 14.125 16.2667C14.125 16.6333 14.1942 16.9778 14.3325 17.3C14.4709 17.6222 14.6618 17.9028 14.9053 18.1417C15.1488 18.3806 15.431 18.5722 15.752 18.7167C16.0729 18.8611 16.416 18.9333 16.7812 18.9333Z" stroke="#314D71" stroke-width="0.6" mask="url(#path-1-outside-1_1901_21493)" />
													</g>
												</g>
											</svg>
										</a>
									</div>
								</div>
							<?php endif; ?>
							<?php $i++; ?>
						<?php endwhile; ?>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php
			endif;
			wp_reset_postdata();
			?>
			<div class="docs-text"><?php esc_html_e('Архивных документов не найдено', 'necoline'); ?></div>
		<?php
		}
		wp_reset_postdata();
		?>
	</div>
	<?php
	$outputFilterDoc = ob_get_clean();

	wp_reset_postdata();

	wp_send_json_success(array('outputFilterDoc' => $outputFilterDoc,));
	wp_die();
}

function filter_posts_callback()
{
	// Получение данных из запроса.
	$direction = isset($_POST['direction']) ? $_POST['direction'] : '';
	$service = isset($_POST['service']) ? $_POST['service'] : '';
	$port = isset($_POST['port']) ? $_POST['port'] : '';

	// Начальные параметры запроса.
	$args = array(
		'post_type' => 'schedule-1',
		'posts_per_page' => -1,
		'meta_query' => array(
			'relation' => 'AND',
		),
	);

	// Если передано направление, добавляем условие в meta_query.
	if (!empty($direction)) {
		array_push($args['meta_query'], array(
			'key' => 'schedule_1_direction',
			'value' => $direction,
			'compare' => 'IN',
		));
	}

	// Если передан service, добавляем условия в meta_query.
	if (!empty($service)) {
		array_push($args['meta_query'], array(
			'key' => 'schedule_1_service',
			'value' => $service,
			'compare' => 'IN',
		));
	}

	// Если передан port, добавляем условия в meta_query.
	if (!empty($port)) {
		array_push($args['meta_query'], array(
			'key'     => 'ports_id',
			'value'   => $port,
			'compare' => 'LIKE',
		));
	}

	// Если ни один из параметров не передан, выводим все посты без фильтрации.
	if (empty($direction) && empty($service) && empty($port)) {
		$args['meta_query'] = array(); // Очищаем meta_query, чтобы не применялась никакая фильтрация.
	}

	// Выполнение запроса.
	$query = new WP_Query($args);

	// Начинаем буферизацию вывода.
	ob_start();

	// Цикл постов.
	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
			$shipName = get_field('schedule_1_ship', $port->ID);
			$shipID = $shipName->ID; // Получаем ID корабля
			$isActive = get_field('fickle-is-active', $shipID);
			$current_date = date('d.m');
			$current_year = date('Y');
			$current_time = strtotime($current_date . '.' . $current_year);

			$skip_port = true;
			$skipDate = false;

			$portsName = get_field('ports_repeat', $post_id); // Получаем значение поля для текущего поста.

			if (!empty($portsName) && is_array($portsName)) {
				foreach ($portsName as $portName) {
					$port_infos = $portName['ports_group']['port_info'];

					if (!empty($port_infos) && is_array($port_infos)) {
						$skip_group = true;
						foreach ($port_infos as $port_info) {
							$etd_date = strtotime($port_info['date_etd'] . '.' . $current_year);
							if ($etd_date < $current_time) {
								$skipDate = true;
							}
						}

						foreach ($port_infos as $port_info) {
							// Проверяем, содержит ли строка дату валидный формат
							if (strpos($port_info['date_etd'], '.') !== false) {
								// Преобразуем строку в дату
								$etd_date = strtotime($port_info['date_etd'] . '.' . $current_year);
								// Продолжаем только если дата была успешно преобразована
								if ($etd_date !== false) {
									// Проверяем условие, если дата отправления больше или равна текущей дате
									if ($etd_date >= $current_time) {
										// Устанавливаем флаг пропуска в false
										$skip_group = false;
									}
								}
							}
						}

						if (!$skip_group) {
							$skip_port = false;
						}
					}
				}
			}

			if ($skip_port || $isActive) {
				continue;
			}
	?>

			<section class="vessel-information">
				<div class="vessel-information__title title title--h2"><?php echo get_field('schedule_1_ship', get_the_ID())->post_title; ?>
					<a href="<?php the_permalink($shipName->ID) ?>" class="title"><?php esc_html_e('Подробнее о судне', 'necoline'); ?></a>
				</div>
				<div class="vessel-information__table-and-track">
					<div class="vessel-information__table-wrapper">
						<table class="vessel-information__table table">
							<thead class="table__thead title">
								<tr>
									<?php $portsName = get_field('ports_repeat', $port->ID);
									$portsCount = count($portsName);
									$i = 0;
									?>
									<th>Voyage</th>
									<?php foreach ($portsName as $portName) : ?>
										<?php if ($i === 0) : ?>
											<th colspan="2"><?php echo $portName['ports_group']['port_name']->post_title; ?></th>
											<th>Voyage</th>
										<?php else : ?>
											<th colspan="3"><?php echo $portName['ports_group']['port_name']->post_title; ?></th>
										<?php endif; ?>
										<?php $i++; ?>
									<?php endforeach; ?>
								</tr>
							</thead>

							<tbody class="table__tbody">
								<tr class="title">
									<td></td>
									<?php $i = 1; ?>
									<?php foreach ($portsName as $portName) : ?>
										<?php if ($i === 1) : ?>

											<td colspan="2">Etd</td>
											<td></td>
										<?php elseif ($i < $portsCount) : ?>
											<td>Cut Off</td>
											<td>Eta</td>
											<td>Etd</td>
										<?php else : ?>
											<td colspan="2">Cut Off</td>
											<td colspan="2">Eta</td>
									<?php endif;
										$i++;
									endforeach;
									?>
								</tr>
								<?php $ports_info = $portName['ports_group']['port_info']; ?>
								<?php $idx = 0; ?>
								<?php foreach ($ports_info as $port_info) : ?>
									<tr>
										<td><?php echo $port_info['number-1']; ?></td>

										<?php $i = 1 ?>
										<?php foreach ($portsName as $portName) : ?>
											<?php $ports_info = $portName['ports_group']['port_info'][$idx]; ?>
											<?php if ($i === 1) : ?>

												<td colspan="2"><?php echo $ports_info['date_etd']; ?></td>

												<td><?php echo $port_info['number-2']; ?></td>
											<?php elseif ($i < $portsCount) : ?>
												<td><?php echo $ports_info['date_cut_off']; ?></td>
												<td><?php echo $ports_info['date_eta']; ?></td>
												<td><?php echo $ports_info['date_etd']; ?></td>
											<?php else : ?>
												<td colspan="2"><?php echo $ports_info['date_cut_off']; ?></td>
												<td colspan="2"><?php echo $ports_info['date_eta']; ?></td>
											<?php endif; ?>
											<?php $i++ ?>
										<?php endforeach; ?>
									</tr>
									<?php $idx++; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<!-- <div class="vessel-information__track">
							<div class="vessel-information__track-card card card--primary">
								<picture>
									<img class="vessel-information__track-image" src="<?php the_field('ship_img_left', get_the_ID()) ?>" alt="" data-pagespeed-url-hash="3682093504" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" data-pagespeed-lsc-url="<?php the_field('ship_img_left', get_the_ID()) ?>">
								</picture>
								<a href="<?php the_permalink(get_the_ID()) ?>" class="vessel-information__track-link title"><?php esc_html_e('Подробнее о судне', 'necoline'); ?></a>
							</div>
						</div> -->
				</div>
			</section>
		<?php
		endwhile;
	endif;
	// Завершаем буферизацию вывода и возвращаем его содержимое.
	$output = ob_get_clean();
	echo $output;

	// Сбрасываем запрос.
	wp_reset_postdata();

	// Останавливаем выполнение скрипта.
	die();
}
add_action('wp_ajax_filter_posts', 'filter_posts_callback');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts_callback');

//Сохраняем скрытое поле ACF
function my_custom_acf_save_post($post_id)
{
	// Проверяем, является ли это обновлением записи
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// Проверяем разрешения пользователя
	if (!current_user_can('edit_post', $post_id)) return;

	// Проверяем тип записи
	$post_type = get_post_type($post_id);
	if ($post_type !== 'schedule-1') return;

	// Поля, из которых мы будем брать данные
	$ports = get_field('ports_repeat', $post_id);

	foreach ($ports as $port) :
		$portsFName .= ($port['ports_group']['port_name']->ID) . ',';
	endforeach;

	// Записываем в скрытое поле
	update_field('ports_id', $portsFName, $post_id);
}

// Запускаем функцию при сохранении записи
add_action('acf/save_post', 'my_custom_acf_save_post', 20);

//Hidden field ports_id
add_action('admin_head', 'hide_acf_field');

function hide_acf_field()
{
	echo '<style>.acf-field-6579a9d98dc31 { display: none; }</style>';
}

// Contact Form 7 remove auto added p tags
add_filter('wpcf7_autop_or_not', '__return_false');

//Фильтр расписание поездов

//Автокомплит функция
add_action('wp_ajax_search_stations_autocomplete', 'search_stations_autocomplete_callback');
add_action('wp_ajax_nopriv_search_stations_autocomplete', 'search_stations_autocomplete_callback');

function search_stations_autocomplete_callback()
{
	$term = sanitize_text_field($_POST['term']);

	$results = array();
	$page_id = 154;

	if (have_rows('shedule_rows', $page_id)) {
		$unique_labels = array(); // Массив для хранения уникальных меток

		while (have_rows('shedule_rows', $page_id)) {
			the_row();
			$station_data = get_sub_field('data');
			$station_end = get_sub_field('station_end');
			$label = get_the_title($station_end);
			$station_operation_id = get_sub_field('station_operation');
			$station_operation = get_the_title($station_operation_id);
			$distance = get_sub_field('distance');

			// Проверяем, является ли метка уникальной
			if (!in_array($label, $unique_labels)) {
				$unique_labels[] = $label;

				$result = array();
				$result['label'] = mb_strtolower($label, 'UTF-8'); // Используем заголовок поста как метку в автозаполнении
				$result['data'] = $station_data; // По желанию сохраняем ссылку для использования в событии select
				$result['id'] = $station_end->ID;
				$result['station_operation'] = $station_operation;
				$result['distance'] = $distance;
				$result['row'] = get_row_index() - 1;
				$results[] = $result;
			}
		}
	}
	// Фильтруем результаты на основе поискового термина
	$results = array_filter($results, function ($result) use ($term) {
		return mb_stripos($result['label'], $term, 0, 'UTF-8') !== false;
	});

	wp_reset_query();

	// Выводим результаты в формате JSON
	wp_send_json($results);
}



// Функция фильтрации поездов
add_action('wp_ajax_filter_stations', 'filter_stations');
add_action('wp_ajax_nopriv_filter_stations', 'filter_stations');

function filter_stations()
{
	$row_index = intval($_POST['row_index']);

	// if (!empty($_POST['station_start'])) {

	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'shedule_rows_' . $row_index . '_station_start',
				'value' => '2110', // тут был $_POST['station_start']
				'compare' => '=',
			)
		)
	);

	if (!empty($_POST['station_end'])) {
		$args['meta_query'][] = array(
			'key' => 'shedule_rows_' . $row_index . '_station_end',
			'value' => $_POST['station_end'],
			'compare' => '=',
		);
	}

	if (!empty($_POST['num'])) {
		$args['meta_query'][] = array(
			'key' => 'shedule_rows_' . $row_index . '_num',
			'value' => $_POST['num'],
			'compare' => '=',
		);
	}

	// Выполняем запрос
	$query = new WP_Query($args);

	// Начинаем буферизацию вывода.
	ob_start();

	// Проверяем, есть ли данные
	if ($query->have_posts()) {
		?>
		<table class="table" data-current-page="1">
			<thead class="table__thead title">
				<tr>
					<th width="110"><?= $current_language == 'ru' ? 'Номер' : 'Number' ?></th>
					<th width="200"><?= $current_language == 'ru' ? 'Дата начала рейса' : 'Flight start date' ?></th>
					<th width="320"><?= $current_language == 'ru' ? 'Станция отправления' : 'Departure station' ?></th>
					<th width="258"><?= $current_language == 'ru' ? 'Станция назначения' : 'Destination station' ?></th>
					<th width="250"><?= $current_language == 'ru' ? 'Станция операции' : 'Operation Station' ?> <br /></th>
					<th width="222"><?= $current_language == 'ru' ? 'Расстояние оставшееся' : 'Distance remaining' ?></th>
				</tr>
			</thead>
			<tbody class="table__tbody">
				<?php
				while ($query->have_posts()) {
					$query->the_post();
					if (have_rows('shedule_rows')) {
						while (have_rows('shedule_rows')) {
							the_row();
							$station_start = get_sub_field('station_start');
							$station_start_id = $station_start->ID;
							$station_end = get_sub_field('station_end');
							$station_end_id = $station_end->ID;
							$station_num = get_sub_field('num');
							$station_operation = get_sub_field('station_operation');

							// Проверяем, соответствуют ли поля-повторители условиям фильтрации
							if (
								$station_start_id == '2110' && // тут был $_POST['station_start'] заместо '2110'
								(empty($_POST['station_end']) || $station_end_id == $_POST['station_end']) &&
								(empty($_POST['num']) || $station_num == $_POST['num'])
							) {
				?>
								<tr>
									<td><?php the_sub_field('num'); ?></td>
									<td><?php the_sub_field('data') ?></td>
									<td><?php echo $station_start->post_title; ?></td>
									<td><?php echo $station_end->post_title; ?></td>
									<td><?php echo $station_operation->post_title; ?></td>
									<td><?php the_sub_field('distance'); ?></td>
								</tr>
				<?php
							}
						}
					}
				}
				?>
			</tbody>
		</table>
		<?php
	} else {
		echo 'Рейсы не найдены';
	}
	wp_reset_postdata();
	// } 
	// else {
	// 	echo 'Заполните все обязательные поля';
	// }

	$response = ob_get_clean();
	echo $response;

	die();
}

//Обновление пагинации в Категориях
function load_posts()
{
	$category = $_POST['category'];
	$paged = $_POST['page'];
	$category_obj = get_category_by_slug($category);
	$category_link = get_term_link($category_obj);
	$query = new WP_Query(array(
		'category_name' => $category,
		'paged' => $paged
	));
	ob_start();
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post(); ?>
			<li class="new">
				<img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
				<div class="new__text-container">
					<p class="new__date text"><?php the_time('d.m.Y'); ?></p>
					<h3 class="new__title title title--h5"><?php the_title(); ?></h3>
					<p class="new__description"><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>" class="new__link text">Читать полностью</a>
				</div>
			</li>
	<?php
		}
		wp_reset_postdata();
	}
	$response['posts'] = ob_get_clean();

	$args = array(
		'base'               => $category_link . 'page/%#%/',
		'format'             => '?paged=%#%',
		'total'              => $query->max_num_pages,
		'current'            => $paged,
		'prev_text'          => '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="16" viewBox="0 0 11 16" fill="none">
		<g clip-path="url(#clip0_1022_199799)">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M9 16L8 16L2 8L8 -8.74228e-08L9 0L3 8L9 16Z" fill="currentColor"></path>
		</g>
		<defs>
		<clipPath id="clip0_1022_199799">
		<rect width="11" height="16" fill="white" transform="translate(11 16) rotate(-180)"></rect>
		</clipPath>
		</defs>
		</svg>',
		'next_text'          => '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="16" viewBox="0 0 11 16" fill="none">
		<g clip-path="url(#clip0_1022_199800)">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M2 16L3 16L9 8L3 1.74846e-07L2 0L8 8L2 16Z" fill="currentColor"></path>
		</g>
		<defs>
		<clipPath id="clip0_1022_199800">
		<rect width="11" height="16" fill="white" transform="matrix(1 1.74846e-07 1.74846e-07 -1 0 16)"></rect>
		</clipPath>
		</defs>
		</svg>',
		'type'      => 'array',
	);

	ob_start();
	$pagination = paginate_links($args);
	foreach ($pagination as $page) {
		if (strpos($page, 'prev') !== false || strpos($page, 'next') !== false) {
			echo '<button class="pagination__link">' . $page . '</button>';
		} else {
			$active_class = (strpos($page, 'current') !== false) ? 'active' : '';
			echo '<button class="pagination__link ' . $active_class . '">' . $page . '</button>';
		}
	}
	$response['pagination'] = ob_get_clean();

	wp_send_json_success($response);
}
add_action('wp_ajax_load_posts', 'load_posts');
add_action('wp_ajax_nopriv_load_posts', 'load_posts');

// News page, add custom meta box for bg text

// Добавляем кастомное мета поле для описания записи
function custom_post_description_meta_box()
{
	add_meta_box(
		'custom_post_description_meta_box',
		__('Заголовок фона новости', 'textdomain'), // Заголовок мета бокса
		'custom_post_description_meta_box_callback',
		'post', // Тип записи, для которой создаем мета поле (в данном случае для постов)
		'side', // side - справа в колонке редактирования, normal - посередине, в основном редакторе записи
		'default'
	);
}
add_action('add_meta_boxes', 'custom_post_description_meta_box');

// Callback функция для отображения содержимого мета бокса
function custom_post_description_meta_box_callback($post)
{
	// Получаем текущее значение мета поля
	$custom_description = get_post_meta($post->ID, 'custom_description_meta_key', true);
	// Выводим поле для ввода текста
	?>
	<p>
		<label for="custom_description"><?php _e('Содержимое:', 'textdomain'); ?></label>
		<br>
		<textarea id="custom_description" name="custom_description" style="width: 100%;" rows="5"><?php echo esc_textarea($custom_description); ?></textarea>
	</p>
<?php
}

// Сохраняем значение кастомного мета поля при сохранении записи
function save_custom_post_description_meta($post_id)
{
	// Проверяем права пользователя
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	// Проверяем, установлено ли значение
	if (isset($_POST['custom_description'])) {
		// Сохраняем значение мета поля
		update_post_meta($post_id, 'custom_description_meta_key', sanitize_text_field($_POST['custom_description']));
	} else {
		// Если значение не установлено, удаляем мета поле
		delete_post_meta($post_id, 'custom_description_meta_key');
	}
}
add_action('save_post', 'save_custom_post_description_meta');


/***
 * Disables Gutenberg (the new block editor in WordPress).
 *
 * @version 2.0
 */

did_action('plugins_loaded')
	? Kama_Disable_Gutenberg::init()
	: add_action('plugins_loaded', [Kama_Disable_Gutenberg::class, 'init']);

final class Kama_Disable_Gutenberg
{

	public static function init()
	{
		add_filter('use_block_editor_for_post_type', '__return_false', 100);

		// disable <style id='global-styles-inline-css'>body{--wp--preset--color--black: #000000; ...
		// see wp_enqueue_global_styles()
		remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
		remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

		remove_theme_support('core-block-patterns'); // WP 5.5

		// disable basic css styles for blocks
		// IMPORTANT! when widgets on blocks or something else will be released, this line will need to be commented out.
		remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');

		// don't do noneeded operations
		remove_filter('the_content', 'do_blocks', 9);
		remove_filter('widget_block_content', 'do_blocks', 9);

		add_action('admin_init', [__CLASS__, 'on_admin_init']);

		self::remove_gutenberg_hooks();
	}

	public static function on_admin_init()
	{
		// Move the Privacy Policy help notice back under the title field.
		remove_action('admin_notices', [WP_Privacy_Policy_Content::class, 'notice']);
		add_action('edit_form_after_title', [WP_Privacy_Policy_Content::class, 'notice']);
	}

	/**
	 * Copy from Classic Editor plugin v1.6.3.
	 * @see https://plugins.svn.wordpress.org/classic-editor/trunk/classic-editor.php
	 */
	private static function remove_gutenberg_hooks($remove = 'all')
	{
		remove_action('admin_menu', 'gutenberg_menu');
		remove_action('admin_init', 'gutenberg_redirect_demo');

		if ($remove !== 'all') {
			return;
		}

		// Gutenberg 5.3+
		remove_action('wp_enqueue_scripts', 'gutenberg_register_scripts_and_styles');
		remove_action('admin_enqueue_scripts', 'gutenberg_register_scripts_and_styles');
		remove_action('admin_notices', 'gutenberg_wordpress_version_notice');
		remove_action('rest_api_init', 'gutenberg_register_rest_widget_updater_routes');
		remove_action('admin_print_styles', 'gutenberg_block_editor_admin_print_styles');
		remove_action('admin_print_scripts', 'gutenberg_block_editor_admin_print_scripts');
		remove_action('admin_print_footer_scripts', 'gutenberg_block_editor_admin_print_footer_scripts');
		remove_action('admin_footer', 'gutenberg_block_editor_admin_footer');
		remove_action('admin_enqueue_scripts', 'gutenberg_widgets_init');
		remove_action('admin_notices', 'gutenberg_build_files_notice');

		remove_filter('load_script_translation_file', 'gutenberg_override_translation_file');
		remove_filter('block_editor_settings', 'gutenberg_extend_block_editor_styles');
		remove_filter('default_content', 'gutenberg_default_demo_content');
		remove_filter('default_title', 'gutenberg_default_demo_title');
		remove_filter('block_editor_settings', 'gutenberg_legacy_widget_settings');
		remove_filter('rest_request_after_callbacks', 'gutenberg_filter_oembed_result');

		// Previously used, compat for older Gutenberg versions.
		remove_filter('wp_refresh_nonces', 'gutenberg_add_rest_nonce_to_heartbeat_response_headers');
		remove_filter('get_edit_post_link', 'gutenberg_revisions_link_to_editor');
		remove_filter('wp_prepare_revision_for_js', 'gutenberg_revisions_restore');

		remove_action('rest_api_init', 'gutenberg_register_rest_routes');
		remove_action('rest_api_init', 'gutenberg_add_taxonomy_visibility_field');
		remove_filter('registered_post_type', 'gutenberg_register_post_prepare_functions');

		remove_action('do_meta_boxes', 'gutenberg_meta_box_save');
		remove_action('submitpost_box', 'gutenberg_intercept_meta_box_render');
		remove_action('submitpage_box', 'gutenberg_intercept_meta_box_render');
		remove_action('edit_page_form', 'gutenberg_intercept_meta_box_render');
		remove_action('edit_form_advanced', 'gutenberg_intercept_meta_box_render');
		remove_filter('redirect_post_location', 'gutenberg_meta_box_save_redirect');
		remove_filter('filter_gutenberg_meta_boxes', 'gutenberg_filter_meta_boxes');

		remove_filter('body_class', 'gutenberg_add_responsive_body_class');
		remove_filter('admin_url', 'gutenberg_modify_add_new_button_url'); // old
		remove_action('admin_enqueue_scripts', 'gutenberg_check_if_classic_needs_warning_about_blocks');
		remove_filter('register_post_type_args', 'gutenberg_filter_post_type_labels');

		// phpcs:disable Squiz.PHP.CommentedOutCode.Found
		// Keep
		// remove_filter( 'wp_kses_allowed_html', 'gutenberg_kses_allowedtags', 10, 2 ); // not needed in 5.0
		// remove_filter( 'bulk_actions-edit-wp_block', 'gutenberg_block_bulk_actions' );
		// remove_filter( 'wp_insert_post_data', 'gutenberg_remove_wpcom_markdown_support' );
		// remove_filter( 'the_content', 'do_blocks', 9 );
		// remove_action( 'init', 'gutenberg_register_post_types' );

		// Continue to manage wpautop for posts that were edited in Gutenberg.
		// remove_filter( 'wp_editor_settings', 'gutenberg_disable_editor_settings_wpautop' );
		// remove_filter( 'the_content', 'gutenberg_wpautop', 8 );
		// phpcs:enable Squiz.PHP.CommentedOutCode.Found

	}
}
