<?php
/*
Template Name: Активы
Template Post Type: page
*/
include (locate_template('header.php'));
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
        <div class="head__card card card--primary">
          <h1 class="head__title title title--h1"><?php the_field('activities_title'); ?></h1>
          <p class="head__text title title--h3"><?php the_field('activities_subtitle'); ?></p>
          <picture>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="head__img" />
          </picture>
        </div>
      </div>
    </section>
    <section class="section-tabs">
      <div class="container">
        <div class="section-tabs__head">
          <nav class="page-menu">
            <ul class="page-menu__list">
              <li class="page-menu__item">
                <button class="page-menu__button title title--h5 active"><?php esc_html_e( 'Флот', 'necoline' ); ?></button>
              </li>
              <li class="page-menu__item">
                <button class="page-menu__button page-menu__button--containers title title--h5"><?php esc_html_e( 'Контейнерный парк', 'necoline' ); ?></button>
              </li>
            </ul>
          </nav>
          <div class="section-tabs__head-text title title--h3"><?php the_field('activities_ships'); ?></div>
        </div>
        <div class="tab active" data-text="<?= the_field('activities_ships'); ?>">
        <?php	$ships = get_posts( [
              'post_type' => 'ships',
              'post_status'    => 'publish',
              'posts_per_page' => - 1,
            ] );
        ?>
        <?php foreach( $ships as $post ): setup_postdata( $post );
        $isActive = get_field('fickle-is-active');
       if (!$isActive):
        ?>
          <div class="card-vessel card card--primary">
            <picture class="card-vessel__picture">
              <img src="<?php the_post_thumbnail_url(); ?>" alt="Грузовой корабль" class="card-vessel__img" />
            </picture>

            <div class="card-vessel__text-wrapper">
              <div class="card-vessel__up-title"><?= $current_language == 'ru' ? 'Судно' : 'Ship' ?></div>
              <div class="card-vessel__title title title--h2"><?php the_title(); ?></div>
            </div>
            <a href="<?php echo the_permalink( ); ?>" class="card-vessel__link button button--title title">
              <span><?= $current_language == 'ru' ? 'читать подробнее о судне' : 'Read more about the ship' ?></span>
              <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z"
                  fill="currentColor" />
              </svg>
            </a>
          </div>
        <?php endif; endforeach; 
            wp_reset_postdata();
		    ?>
        </div>
        <div class="tab" data-text="<?= the_field('activities_containers'); ?>">
        <?php	$containers = get_posts( [
              'post_type' => 'containers',
              'post_status'    => 'publish',
              'posts_per_page' => - 1,
              'orderby' => 'menu_order'
            ] );
          foreach( $containers as $post ): setup_postdata( $post );
        ?>
          <div class="card-container card">
            <picture class="card-container__pictire">
              <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
            </picture>
            <div class="card-container__text-wrapper">
              <div class="card-container__head">
                <div class="card-container__type title"><?php the_title(); ?></div>
              </div>
              <?php if( have_rows('features') ): ?>
              <ul class="card-container__chars-list">
                <?php while ( have_rows('features') ) : the_row(); ?>
                <li class="card-container__chars-item">
                  <div><?php the_sub_field('title'); ?></div>
                </li>
                <?php endwhile; ?>
              </ul>
              <?php  endif; ?>
              <div class="card-container__text">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        <?php endforeach; 
              wp_reset_postdata();
        ?>
        </div>
      </div>
    </section>
  </main>
<?php
get_footer();