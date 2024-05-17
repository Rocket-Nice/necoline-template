<?php
get_header();
$categories = get_the_category();
$category = $categories[0];
$cat_title = $category->name;
$cat_link = get_category_link($category->term_id);
$prev_post = get_previous_post();
$next_post = get_next_post();
$current_language = pll_current_language();
?>

<main class="main-content container">
    <div class="breadcrumbs text">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?php echo $cat_link; ?>" class="breadcrumbs__link text"><?php echo $cat_title; ?></a>
            </li>
            <li class="breadcrumbs__item"><?php the_title(); ?></li>
        </ul>
    </div>
    <section class="new">
        <div class="new__container">
            <h1 class="new__title title title--h2"><?php the_title() ?></h1>
            <p class="new__date text"><?php the_time('d.m.Y'); ?></p>
            <!-- <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="new__main-img"> -->
            <?php the_content(); ?>
        </div>
        <nav class="new__nav">
            <?php if ($prev_post) : ?>
                <a href="<?php echo get_permalink($prev_post); ?>" class="new__button new__button--prev">предыдущая новость</a>
            <?php endif; ?>
            <?php if ($next_post) : ?>
                <a href="<?php echo get_permalink($next_post); ?>" class="new__button new__button--next">следующая новость</a>
            <?php endif; ?>
        </nav>
    </section>
</main>

<script>
    document.querySelectorAll('.new img').forEach(img => {
        img.closest('p').style.height = "auto";
        img.setAttribute('alt', '<?php the_title(); ?>');
    });
</script>

<?php
get_footer();
