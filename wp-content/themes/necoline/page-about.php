<?php
/*
Template Name: О компании
Template Post Type: page
*/
include (locate_template('header.php'));
$current_language = pll_current_language();
?>

<main class="main-content container">
        <section class="first-screen card card--primary">
            <h1 class="first-screen__title title title--h1"><?php the_field('about_title') ?></h1>
            <p class="first-screen__text title title--h3"><?php the_field('about_subtitle') ?></p>
            <picture>
                <img src="<?php the_field('about_img') ?>" alt="Грузовой корабль" class="first-screen__img">
            </picture>
        </section>

        <nav class="page-menu">
            <ul class="page-menu__list">
                <li class="page-menu__item">
                    <button class="page-menu__button title title--h5 active"><?= $current_language == 'ru' ? 'О компании' : 'About the company' ?></button>
                </li>

                <li class="page-menu__item">
                    <button class="page-menu__button title title--h5"><?= $current_language == 'ru' ? 'Команда' : 'Team' ?></button>
                </li>
            </ul>
        </nav>

        <div class="tab active">
            <section class="principles">
                <picture>
                    <img src="<?php the_field('about_img_2') ?>" alt="О компании" class="principles__img">
                </picture>

                <div class="principles__container">
                    <h3 class="principles__title title title--h2"><?php the_field('about_title_2') ?></h3>
                    <p class="principles__text">
                        <?php the_field('about_text') ?>
                    </p>
					<?php get_template_part( 'template-parts/numbers' ) ?>
                </div>
            </section>

            <?php $args = array(
			  'child_of' => $current_language == 'ru' ? 110 : 1001, 
			  'parent' => -1,
			  'post_status' => 'publish',
			  ); 
			$services = get_pages( $args );
			?>
			<?php if ( $services ) : ?>
            <section class="services">
                <h2 class="services__title title title--h5"><?= $current_language == 'ru' ? 'Услуги' : 'Services' ?></h2>
                <div class="services__list">
                    <?php foreach( $services as $post ) : setup_postdata( $post ); ?>
					<a href="<?php the_permalink(); ?>" class="service card card--primary">
                        <h3 class="service__title title title--h2"><?php the_title(); ?></h3>
                        <svg class="service__icon" xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H4.28572L10 8L4.28572 16H0L5.71428 8L0 0Z" fill="white" />
                        </svg>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="Корабль" class="service__img">
                    </a>
                    <?php endforeach; 
						  wp_reset_postdata();
					?>
                </div>
            </section>
			<?php endif; ?>

<!--             <section class="clients">
                <h2 class="clients__title title title--h5"><?= $current_language == 'ru' ? 'НАШИ ПАРТНЕРЫ' : 'OUR PARTNERS' ?></h2>
                <div class="clients__slider">
                    <ul class="clients__list">
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/pg.svg') ?>" alt="Client logo." width="179" class="client__img">
                        </li>
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/vp.svg') ?>" alt="Client logo." width="320" class="client__img">
                        </li>
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/KTS.svg') ?>" alt="Client logo." width="470" class="client__img">
                        </li>
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/eline.svg') ?>" alt="Client logo." width="174" class="client__img">
                        </li>
                    </ul>
                    <ul class="clients__list">
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/pg.svg') ?>" alt="Client logo." width="179" class="client__img">
                        </li>
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/vp.svg') ?>" alt="Client logo." width="320" class="client__img">
                        </li>
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/KTS.svg') ?>" alt="Client logo." width="470" class="client__img">
                        </li>
                        <li class="client">
                            <img src="<?php theme_image('companies-logos/eline.svg') ?>" alt="Client logo." width="174" class="client__img">
                        </li>
                    </ul>
                </div>

            </section> -->

            <section class="benefits">
                <h2 class="benefits__title title title--h5"><?= $current_language == 'ru' ? 'Обращаясь в НЭКО ЛАЙН вы получаете' : 'By contacting NECO LINE you receive' ?></h2>
                <div class="swiper benefits-container">
                    <?php get_template_part( 'template-parts/plus-about' ) ?>
                </div>

            </section>
			<?php if( get_field('about_arts_hide') !== true ) : ?>
            <section class="articles">
                <div class="articles__container">
                    <h2 class="articles__title title title--h5"><?= $current_language == 'ru' ? 'Статьи в сми и благодарственные письма' : 'Articles in the media and letters of gratitude' ?></h2>
                    <?php if( have_rows('about_arts') ): ?>
                    <div class="articles__side-container">
                        <?php while ( have_rows('about_arts') ) : the_row(); ?>
                        <a href="<?php the_sub_field('link') ?>"
                            class="article">
                            <div class="article__img-container">
                                <img src="<?php the_sub_field('icon') ?>" alt="icon" class="article__img">
                            </div>

                            <h3 class="article__title"><?php the_sub_field('title') ?></h3>
                        </a>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if( have_rows('serts') ): ?>
				<div class="thanks-letters__container swiper">
                    <ul class="thanks-letters swiper-wrapper">
                        <?php while ( have_rows('serts') ) : the_row(); ?>
						<li class="thanks-letter swiper-slide flip-container">
                            <div class="flip-card">
                                <div class="flip-card-front">
                                    <img src="<?php the_sub_field('sert_logo') ?>" alt="" class="thanks-letter__logo">
                                    <h3 class="thanks-letter__title title title--h6"><?php the_sub_field('sert_title') ?></h3>
                                </div>
                                <div class="flip-card-back">
                                    <picture>
                                        <img src="<?php the_sub_field('sert_img') ?>" alt="<?php the_sub_field('sert_title') ?>" class="thanks-letter__letter">
                                    </picture>
                                </div>
                            </div>
                        </li>
						<?php endwhile; ?>
                    </ul>
                </div>
				<?php endif; ?>
            </section>
			<?php endif; ?>
        </div>

        <div class="tab">
			<section class="feedback-team">
                <div class="feedback-team__inner">
                    <div class="feedback-team__image-wrapper">
                        <img src="<?php the_field('about_img_3') ?>" alt="Руководитель" class="feedback-team__image" />
                    </div>
                    <div class="feedback-team__content">
                        <div class="feedback-team__text-wrapper">
                            <div class="feedback-team__text">
                                <?php the_field('about_text_2') ?>
                            </div>
                            <div class="feedback-team__author">
                                <div class="feedback-team__author-name"><?php the_field('about_sign') ?></div>
                            </div>
                        </div>
						<?php if(get_field('contact_button_visible')): ?>
                        <div class="feedback-team__action">
                            <button data-src="#director-form" class="feedback-team__button c-modal__button button button--dark title title--button" type="button">
                                <p><?= $current_language == 'ru' ? 'Написать генеральному директору' : 'Write to the CEO' ?></p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z" fill="white" />
                                </svg>
                            </button>
                        </div>
						<?php endif; ?>
                    </div>
                </div>
            </section>
			<?php	$departments = get_terms( [
						'taxonomy' => 'departments'
					] );
			?>
            <section class="employees ">
                <ul class="employees__list">
                    <?php $i = 0; 
                          $active = '';
                    foreach( $departments as $department ) : setup_postdata($post);
                    if ( $i == 0 ) {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                    ?>
					<?php $departments_show = get_field( 'departments_show', 'departments_'.$department->term_id );
					if( $departments_show !== true ) : ?>
                    <li class="employees__list-item">
                        <button class="employees__trigger card card--primary title <?php echo $active; ?>" type="button"
                            data-hc-control="employees-id-<?php echo $i ?>">
                            <p><?php echo $department->name; ?></p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="10" viewBox="0 0 16 10"
                                fill="none">
                                <g clip-path="url(#clip0_1176_55720)">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16 0L16 4.28572L8 10L-1.87335e-07 4.28571L0 -6.99382e-07L8 5.71428L16 0Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1176_55720">
                                        <rect width="10" height="16" fill="white"
                                            transform="translate(16) rotate(90)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                        <div class="employees__content active" data-hc-content="employees-id-<?php echo $i ?>">
                            <div class="employees__content-inner">
                                <div class="employees__card-list">
                                    <?php  
                                        $teams = new WP_Query([
                                            'posts_per_page' => -1,
                                            'post_type' => 'team',
                                            'departments' => $department->slug
                                        ]);
                                        if ( $teams->have_posts() ) :
                                        while ( $teams->have_posts() ) : $teams->the_post();
                                    ?>
                                    <div class="employees__card">
                                        <div class="employees__card-image-wrapper">
                                            <picture>
                                                <?php if ( get_the_post_thumbnail_url() ) :  ?>
                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="employees__card-image" />
                                                <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri() . '/assets/img/no_photo.jpg' ?>" alt="<?php the_title(); ?>" class="employees__card-image" />
                                                <?php endif; ?>
                                            </picture>
                                        </div>
                                        <div class="employees__card-title title"><?php the_title(); ?></div>
                                        <div class="employees__card-position"><?php the_field('team_post') ?></div>
										<a href="mailto:<?php the_field('team_email') ?>"><?php the_field('team_email') ?></a>
										<?php if ( get_field('team_phone') ) : ?><div><a href="tel:<?php the_field('team_phone') ?>"><?php the_field('team_phone') ?></a></div><?php endif; ?>
										<div><?= $current_language == 'ru' ? 'доб.номер' : 'ext.number' ?>: <?php the_field('team_number') ?></div>
										<?php if ( get_field('team_info') ) : ?><div><?php the_field('team_info') ?></div><?php endif; ?>
                                    </div>
                                    <?php endwhile; 
                                          wp_reset_postdata();
                                          endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
					<?php endif; ?>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </ul>
            </section>
            <section class="open-vacancies">
                <div class="open-vacancies__up-title title"><?= $current_language == 'ru' ? 'открытые вакансии' : 'open vacancies' ?></div>
                <div class="open-vacancies__inner">
                    <div class="open-vacancies__text-content">
                        <div class="open-vacancies__main-title title title--h2"><?php the_field('about_title_3') ?></div>
                        <div class="open-vacancies__decription">
                        <?php the_field('about_vacancy_text') ?>
                        </div>
                    </div>
                    <div class="open-vacancies__list-wrapper">
                        <?php if( have_rows('about_vacancy_list') ): ?>
                        <div class="open-vacancies__list">
                            <?php while ( have_rows('about_vacancy_list') ) : the_row(); ?>
                            <a href="<?php the_sub_field('link') ?>"
                                class="open-vacancies__list-item vacancy">
                                <div class="vacancy__date"><?php the_sub_field('date') ?></div>
                                <div class="vacancy__head">
                                    <div class="vacancy__title title title--h4"><?php the_sub_field('title') ?></div>
                                    <div class="vacancy__cost title title--h4"><?php the_sub_field('money') ?></div>
                                </div>
                                <div class="vacancy__description">
                                    <?php the_sub_field('descr') ?>
                                </div>
                            </a>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
		
    </main>
<div id="director-form" class="c-modal form form-container director-form card card--primary">
        <div class="director-form__container">
            <div class="form__head">
                <div class="form__title title title--h2"><?= $current_language == 'ru' ? 'Задайте вопрос' : 'Ask a question' ?><br /><?= $current_language == 'ru' ? 'генеральному директору' : 'to CEO' ?> </div>
            </div>
            <form action="#" class="form__card ">
                <div class="form__row">
                    <div class="form__column">
                        <fieldset class="form__fieldset">
                            <label class="form__label"><?= $current_language == 'ru' ? 'Эти поля обязательны к заполнению' : 'These fields are required.' ?></label>
                            <div class="form__grid">
                                <div class="form-container__input-container">
                    <input type="text" class="form-container__input input" name="company_name"
                      placeholder="<?= $current_language == 'ru' ? 'Название организации *' : 'Name of organization' ?>" required>
                    <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                  </div>

                  <div class="form-container__input-container">
                    <input type="text" class="form-container__input input" name="full_name" placeholder="<?= $current_language == 'ru' ? 'ФИО *' : 'Full name' ?>"
                      required>
                    <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                  </div>

                  <div class="form-container__input-container">
                    <input type="text" class="form-container__input form-container__input--email input"
                      name="company_email" placeholder="<?= $current_language == 'ru' ? 'Email организации *' : "Email of organization *" ?>" required>
                    <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                    <p class="error-text hide format"><?= $current_language == 'ru' ? 'Email должен быть указан в формате
                      example@gmail.com' : 'Email must be in the format
                      example@gmail.com' ?>
                    </p>
                  </div>

                  <div class="form-container__input-container">
                    <input type="text" class="form-container__input form-container__input--phone input" name="phone"
                      placeholder="<?= $current_language == 'ru' ? 'Телефон *' : 'Phone *' ?>" required>
                    <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                    <p class="error-text hide format"><?= $current_language == 'ru' ? 'Телефон должен быть указан в формате +7
                      (000)-000-00-00' : 'The phone number must be specified in the format +7
                      (000)-000-00-00' ?>
                    </p>
                  </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form__column form__column--flex">
                        <textarea class="input" placeholder="<?= $current_language == 'ru' ? 'Напишите дополнительную информацию о грузе' : 'Write additional information about the cargo' ?>"></textarea>
                        <button
                            class="form__button-submit button form-container__button button--dark title title--button"
                            type="submit"><?= $current_language == 'ru' ? 'отправить' : 'Send' ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
get_footer();