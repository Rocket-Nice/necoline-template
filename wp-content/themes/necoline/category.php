<?php get_header();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$news_posts = new WP_Query(array(
    'category_name' => 'news',
    'paged' => $paged,
    'post_status' => 'publish',
    'post_type' => 'post'
));
$arts_posts = new WP_Query([
    'category_name' => 'articles',
    'paged' => $paged,
    'post_status' => 'publish',
    'post_type' => 'post'
]);

$current_language = pll_current_language();
?>

<main class="main-content container">
    <div class="breadcrumbs text">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
            </li>
            <li class="breadcrumbs__item"><?= $current_language == 'ru' ? 'Новости' : 'News' ?></li>
        </ul>
    </div>
    <nav class="page-menu">
        <ul class="page-menu__list">
            <li class="page-menu__item">
                <button class="page-menu__button title title--h5 active"><?= $current_language == 'ru' ? 'НОВОСТИ' : 'NEWS' ?></button>
            </li>
            <li class="page-menu__item">
                <button class="page-menu__button title title--h5"><?= $current_language == 'ru' ? 'СТАТЬИ' : 'ARTICLES' ?></button>
            </li>
        </ul>
    </nav>
    <?php if ($news_posts->have_posts()) : ?>
        <section class="tab active">
            <div class="gallery">
                <ul class="news__list gallery__item">
                    <?php $counter = 0; ?>
                    <?php while ($news_posts->have_posts()) : $news_posts->the_post();
                        // Получаем значение мета поля для текущей записи
                        $custom_description = get_post_meta(get_the_ID(), 'custom_description_meta_key', true);
                    ?>
                        <?php if ($counter === 0) : ?>
                            <li class="new">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                <?php } else { ?>
                                    <div class="news__custom-bg-block">
                                        <div class="custom-bg-block__icon-and-title">
                                            <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                            <span>NECO LINE</span>
                                        </div>
                                        <span><?= $custom_description; ?></span>
                                    </div>
                                <?php } ?>

                                <div class="new__text-container">
                                    <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                    <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                    <p class="new__description"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                </div>
                            </li>
                        <?php elseif ($counter === 1) : ?>
                            <div class="news-item-container">
                                <li class="new">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                    <?php } else { ?>
                                        <div class="news__custom-bg-block">
                                            <div class="custom-bg-block__icon-and-title">
                                                <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                                <span>NECO LINE</span>
                                            </div>
                                            <span><?= $custom_description; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="new__text-container">
                                        <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                        <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                        <p class="new__description"><?php the_excerpt(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                    </div>
                                </li>
                            <?php elseif ($counter === 2) : ?>
                                <li class="new">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                    <?php } else { ?>
                                        <div class="news__custom-bg-block">
                                            <div class="custom-bg-block__icon-and-title">
                                                <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                                <span>NECO LINE</span>
                                            </div>
                                            <span><?= $custom_description; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="new__text-container">
                                        <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                        <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                        <p class="new__description"><?php the_excerpt(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                    </div>
                                </li>
                            </div><!-- close .news-item-container -->
                        <?php else : ?>
                            <li class="new">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                <?php } else { ?>
                                    <div class="news__custom-bg-block">
                                        <div class="custom-bg-block__icon-and-title">
                                            <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                            <span>NECO LINE</span>
                                        </div>
                                        <span><?= $custom_description; ?></span>
                                    </div>
                                <?php } ?>
                                <div class="new__text-container">
                                    <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                    <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                    <p class="new__description"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php $counter++; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
            <div class="pagination">
                <div class="pagination__list"></div>
            </div>
        </section>
    <?php endif; ?>

    <section class="tab">
        <?php if ($arts_posts->have_posts()) : ?>
            <div class="gallery">
                <ul class="news__list gallery__item">
                    <?php $counter = 0; ?>
                    <?php while ($arts_posts->have_posts()) : $arts_posts->the_post();
                        // Получаем значение мета поля для текущей записи
                        $custom_description = get_post_meta(get_the_ID(), 'custom_description_meta_key', true);
                    ?>
                        <?php if ($counter === 0) : ?>
                            <li class="new">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                <?php } else { ?>
                                    <div class="news__custom-bg-block">
                                        <div class="custom-bg-block__icon-and-title">
                                            <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                            <span>NECO LINE</span>
                                        </div>
                                        <span><?= $custom_description; ?></span>
                                    </div>
                                <?php } ?>

                                <div class="new__text-container">
                                    <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                    <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                    <p class="new__description"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                </div>
                            </li>
                        <?php elseif ($counter === 1) : ?>
                            <div class="news-item-container">
                                <li class="new">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                    <?php } else { ?>
                                        <div class="news__custom-bg-block">
                                            <div class="custom-bg-block__icon-and-title">
                                                <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                                <span>NECO LINE</span>
                                            </div>
                                            <span><?= $custom_description; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="new__text-container">
                                        <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                        <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                        <p class="new__description"><?php the_excerpt(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                    </div>
                                </li>
                            <?php elseif ($counter === 2) : ?>
                                <li class="new">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                    <?php } else { ?>
                                        <div class="news__custom-bg-block">
                                            <div class="custom-bg-block__icon-and-title">
                                                <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                                <span>NECO LINE</span>
                                            </div>
                                            <span><?= $custom_description; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="new__text-container">
                                        <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                        <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                        <p class="new__description"><?php the_excerpt(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                    </div>
                                </li>
                            </div><!-- close .news-item-container -->
                        <?php else : ?>
                            <li class="new">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img alt="<?php the_title(); ?>" class="new__img" src="<?php the_post_thumbnail_url(); ?>">
                                <?php } else { ?>
                                    <div class="news__custom-bg-block">
                                        <div class="custom-bg-block__icon-and-title">
                                            <img src="<?php theme_image('bird-logo.svg'); ?>" alt="<?php the_title(); ?>">
                                            <span>NECO LINE</span>
                                        </div>
                                        <span><?= $custom_description; ?></span>
                                    </div>
                                <?php } ?>
                                <div class="new__text-container">
                                    <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
                                    <h3 class="new__title title title--h5"><?php the_title(); ?></h3>
                                    <p class="new__description"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="new__link text"><?= $current_language == 'ru' ? 'Читать полностью' : 'Read completely' ?></a>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php $counter++; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
            <div class="pagination">
                <div class="pagination__list"></div>
            </div>
        <?php endif; ?>
    </section>


    <section class="form form-news">
        <div class="container">
            <div class="form__head">
                <div class="form__title title title--h5"><?= $current_language == 'ru' ? 'Свяжитесь с нами, чтобы рассчитать точную стоимость' : 'Contact us to calculate the exact cost' ?></div>
                <div class="form__subtitle"><?= $current_language == 'ru' ? 'Работаем только с юридическими лицами' : 'We work only with legal entities' ?></div>
            </div>
            <?php
            if ($current_language == 'ru') :
                echo do_shortcode('[contact-form-7 id="795df61" html_class="form__card card card--primary"]');
            else :
                echo do_shortcode('[contact-form-7 id="fef0ea4" html_class="form__card card card--primary"]');
            endif;
            ?>
        </div>
    </section>
</main>

<?php
get_footer();
