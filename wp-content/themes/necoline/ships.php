<?php
/*
Template Name: Судно
Template Post Type: ships
*/
get_header();
$current_language = pll_current_language();
?>

  <main class="main-content">
    <div class="breadcrumbs text">
      <div class="container">
        <ul class="breadcrumbs__list">
          <li class="breadcrumbs__item">
            <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?= $current_language == 'ru' ? '/activities/' : '/en/actives/'?>" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Активы' : 'Actives' ?></a>
          </li>
          <li class="breadcrumbs__item"><?php the_title() ?></li>
        </ul>
      </div>
    </div>
    <section class="head">
      <div class="container">
        <h1 class="head__title title title--h1"><?php the_title(); ?></h1>
        <div class="head__description"><?php the_field('ship_descr'); ?></div>
        <div class="head__card card">
          <picture class="head__picture">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="head__img" />
          </picture>
        </div>
      </div>
    </section>
    <section class="information">
      <div class="container">
        <div class="information__card-list">
          <div class="information__card card">
            <div class="information__card-title title"><?= $current_language == 'ru' ? 'Основные характеристики судна:' : 'Main characteristics of the vessel:' ?></div>
            <div class="information__card-description">
              <?php the_field('ship_specs') ?>
            </div>
          </div>
          <div class="information__card card">
            <div class="information__card-title title"><?= $current_language == 'ru' ? 'Условия перевозки' : 'Conditions of transportation' ?></div>
            <div class="information__card-description">
              <?php the_field('ship_conditions') ?>
            </div>
          </div>
        </div>
        <?php if ($services = get_field('ship_service')) : 
              $countServices = count ($services);
        ?>
        <div class="direction-following-card card">
          <div class="direction-following-card__title title"><?= $current_language == 'ru' ? 'Направления следования' : 'Directions' ?></div>
          <div class="direction-following-card__route-count"><?php echo $countServices; ?> <?= $current_language == 'ru' ? 'маршрут' : 'route' ?></div>
          <div class="direction-following-card__list">
            <?php foreach ($services as $post) : setup_postdata($post); ?>
            <div class="direction-following-card__row">
              <div class="direction-following-card__lines title"><?php the_title(); ?></div>
              <?php $ports = get_field('services_ports_1'); $i = 0; ?>
              <div class="direction-following-card__text title"><?php foreach ( $ports as $port ) : echo $i > 0 ? ( ' - ' . $port->post_title ) : $port->post_title; $i++; endforeach; ?></div>
              <div class="direction-following-card__ports">
                <a href="<?= get_page_link(152) ?>" class="direction-following-card__button button button--dark title title--button">
                  <span><?= $current_language == 'ru' ? 'расписание' : 'schedule' ?></span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z"
                      fill="currentColor" />
                  </svg>
                </a>
                <a href="<?php the_permalink(); ?>" class="direction-following-card__button direction-following-card__button--light button title title--button">
                  <span><?= $current_language == 'ru' ? 'подробнее' : 'more details' ?></span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z"
                      fill="currentColor" />
                  </svg>
                </a>
              </div>
            </div>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <section class="form-container card card--primary">
      <h2 class="form-container__title title title--h2"><?= $current_language == 'ru' ? 'Свяжитесь с нами, чтобы рассчитать точную стоимость' : 'Сontact us to calculate the exact cost' ?></h2>
      <p class="form-container__text"><?= $current_language == 'ru' ? 'Работаем только с юридическими лицами' : 'We work only with legal entities' ?></p>
	  <?php get_template_part( 'template-parts/form' ) ?>
    </section>
  </main>

<?php
get_footer();