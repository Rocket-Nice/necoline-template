<?php
/*
Template Name: Расписание судов
Template Post Type: page
*/
include (locate_template('header.php'));
$ports = get_posts([
	'post_type'   => 'schedule-1',
	'posts_per_page'   => -1,
]);
$current_language = pll_current_language();
?>


<main class="main-content">
    <div class="breadcrumbs text">
      <div class="container">
        <ul class="breadcrumbs__list">
          <li class="breadcrumbs__item">
            <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
          </li>
          <li class="breadcrumbs__item"><?php the_title() ?></li>
        </ul>
      </div>
    </div>
    <section class="head">
      <div class="container">
        <img src="<?php theme_image('schedule-bg.svg'); ?>" alt="" class="head__background" />
        <h1 class="head__title title title--h1"><?php get_field('title') ? the_field('title') : the_title(); ?></h1>
		<?php if ( get_field('subtitle') ) : ?><div class="head__subtitle title title--h3"><?php the_field('subtitle'); ?></div><?php endif; ?>
		<?php if ( get_field('descr') ) : ?><div class="head__text head__text--ships"><?php the_field('descr'); ?></div><?php endif; ?>
        <div class="head__card card card--primary">
          <div class="head__card-title title title--h4"><?php esc_html_e( 'Интерактивный фильтр', 'necoline' ); ?></div>
          <div class="head__row">
            <div class="head__column">
              <div class="head__card-small-title title title--h4"><?php esc_html_e( 'Выберите линию следования', 'necoline' ); ?></div>
              <div class="head__toggle-buttons toggle-buttons">
              
              <?php 
$unique_term_ids = array();

foreach ($ports as $port) { 
    $term_id = get_field('schedule_1_direction', $port->ID);
    if (!in_array($term_id, $unique_term_ids)) {
        $unique_term_ids[] = $term_id;

        $term = get_term_by('id', $term_id, 'directions');
        if ($term) {
            $term_name = $term->name;

            $parts = preg_split('/\s-\s/', $term_name);
            $first_part = $parts[0]; 
            $second_part = $parts[1]; 
            ?>
            <button class="toggle-buttons__button button fltr-btn" type="button" data-direction="<?php echo $term_id; ?>">
                <span class="toggle-buttons__button-text"><?php echo $first_part; ?></span>
                <span class="toggle-buttons__button-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="20" viewBox="0 0 42 20" fill="none">
                        <path d="M0.646447 9.64645C0.451184 9.84171 0.451184 10.1583 0.646447 10.3536L3.82843 13.5355C4.02369 13.7308 4.34027 13.7308 4.53553 13.5355C4.7308 13.3403 4.7308 13.0237 4.53553 12.8284L1.70711 10L4.53553 7.17157C4.7308 6.97631 4.7308 6.65973 4.53553 6.46447C4.34027 6.2692 4.02369 6.2692 3.82843 6.46447L0.646447 9.64645ZM41.3536 10.3536C41.5488 10.1583 41.5488 9.84171 41.3536 9.64645L38.1716 6.46447C37.9763 6.2692 37.6597 6.2692 37.4645 6.46447C37.2692 6.65973 37.2692 6.97631 37.4645 7.17157L40.2929 10L37.4645 12.8284C37.2692 13.0237 37.2692 13.3403 37.4645 13.5355C37.6597 13.7308 37.9763 13.7308 38.1716 13.5355L41.3536 10.3536ZM1 10.5H41V9.5H1V10.5Z" fill="currentColor"></path>
                    </svg>
                </span>
                <span class="toggle-buttons__button-text"><?php echo $second_part; ?></span>
            </button>
            <?php
        }
    }
}
?>
              </div>
              <?php 
$unique_service_ids = array();

foreach ($ports as $port) { 
    $service_id = get_field('schedule_1_service', $port->ID);
    if (!in_array($service_id, $unique_service_ids)) { 
        $unique_service_ids[] = $service_id; 
        $service_title = get_post_field('post_title', $service_id);
        ?>
        <button class="head__button button title title--button fltr-btn" type="button" data-service="<?php echo $service_id; ?>">
            <?php echo $service_title; ?>
        </button>
        <?php
    }
}
?>
            </div>
            <div class="head__column">
              <div class="head__card-small-title title title--h4"><?php esc_html_e( 'Выберите интересующие вас порты', 'necoline' ); ?></div>
				<?php foreach ($ports as $port) :  
				$portsName = get_field('ports_repeat', $port->ID);

				foreach ($portsName as $portName) :
				$portsID .= $portName['ports_group']['port_name'] -> ID . ',';
				endforeach;

				endforeach;
				$portsID = rtrim($portsID, ',');
                $portsID = explode(',', $portsID);
                $portsID = array_unique($portsID);
                $portsID = implode(',', $portsID);

				?>
				  <?php $portsName = get_posts([
						'post_type'   => 'ports_posts',
						'posts_per_page'   => -1,
						'include' => $portsID
						]);
				  ?>
				  <div class="head__buttons head__buttons--js">
					<?php foreach ($portsName as $post) : setup_postdata($post); ?>
					<button class="head__button button title title--button fltr-btn" type="button" data-port="<?php echo $post->ID; ?>"><?php the_title(); ?></button>
					<?php endforeach; 
						  wp_reset_postdata();
					?>
				  </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	<div id="response-container">
		<div class="container">
			<?php get_template_part( 'template-parts/ships-row' ) ?>
		</div>
	</div>
    <!--
    <section class="search-container">
      <div class="container">
        <div class="search-container__card card card--primary">
          <form action="#" class="search-container__form">
            <div class="search-container__title title title--h4">Поиск контейнера по пути следования</div>
            <div class="search-container__row">
              <div class="search-container__column">
                <select class="input">
                  <option value="Азия — Дальний Восток">Азия — Дальний Восток</option>
                  <option value="Азия — Дальний Восток">Азия — Дальний Восток</option>
                  <option value="Азия — Дальний Восток">Азия — Дальний Восток</option>
                </select>
              </div>
              <div class="search-container__column">
                <input type="text" class="input" placeholder="Введите номер контейнера" />
              </div>
              <div class="search-container__column search-container__column--button">
                <button class="button button--dark title title--button" type="submit">расписание</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
-->
    <div class="container">
      <section class="form-container card card--primary">
        <h2 class="form-container__title title title--h2"><?php esc_html_e( 'Свяжитесь с нами, чтобы рассчитать точную стоимость', 'necoline' ); ?></h2>
        <p class="form-container__text">* <?php esc_html_e( 'Работаем только с юридическими лицами', 'necoline' ); ?></p>
		<?php get_template_part( 'template-parts/form' ) ?>
      </section>
    </div>
  </main>


<?php
get_footer();