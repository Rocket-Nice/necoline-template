<?php
/*
Template Name: Услуги
Template Post Type: page
*/
include (locate_template('header.php'));
$current_language = pll_current_language();
?>

  <main class="main-content container">
    <div class="breadcrumbs text">
      <ul class="breadcrumbs__list">
        <li class="breadcrumbs__item">
          <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
        </li>
        <li class="breadcrumbs__item"><?php esc_html_e( 'Услуги', 'necoline' ); ?></li>
      </ul>
    </div>
    <section class="service-list">
	<?php	$services = get_pages( [
			'child_of' => $post->ID,
			'sort_column' => 'menu_order',
			'sort_order' => 'ASC'
		] );
	?>
      <ul class="service-list__list">
		<?php foreach( $services as $service ): ?>
        <li class="service-list__card card">
          <div class="service-list__card-image-wrapper">
            <img src="<?php echo get_the_post_thumbnail_url( $service->ID, 'full' ); ?>" alt="<?php echo $service->post_title; ?>" class="service-list__card-image">
          </div>
          <div class="service-list__card-content">
            <div class="service-list__card-title title title--h2"><?php echo $service->post_title; ?></div>
            <div class="service-list__card-description">
              <?php echo $service->post_content; ?>
            </div>
            <a href="<?php echo get_page_link( $service->ID ); ?>" class="service-list__card-read-all"><?php esc_html_e( 'Читать подробнее', 'necoline' ); ?></a>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </section>
    <section class="form-container card card--primary">
      <h2 class="form-container__title title title--h2"><?php esc_html_e( 'Свяжитесь с нами, чтобы рассчитать точную стоимость', 'necoline' ); ?></h2>
      <p class="form-container__text">* <?php esc_html_e( 'Работаем только с юридическими лицами', 'necoline' ); ?></p>
	  <?php get_template_part( 'template-parts/form' ) ?>
    </section>
  </main>

<?php
get_footer();