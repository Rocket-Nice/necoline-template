<?php if( have_rows('plus_list','option') ): ?>
<ul class="benefits__list swiper-wrapper">
	<?php while ( have_rows('plus_list','option') ) : the_row(); ?>
	<li class="benefit card card--secondary swiper-slide">
		<h3 class="benefit__title title title--h4"><?php the_sub_field('title') ?></h3>
		<p class="benefit__text"><?php the_sub_field('descr') ?></p>
	</li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>