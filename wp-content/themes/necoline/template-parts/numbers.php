<?php if( have_rows('numbers','option') ): ?>
<ul class="principles__statistics">
	<?php while ( have_rows('numbers','option') ) : the_row(); ?>
	<li class="statistic card">
		<p class="statistic__text title title--h1"><?php the_sub_field('num', 'option') ?></p>
		<h4 class="statistic__title"><?php the_sub_field('title', 'option') ?></h4>
	</li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>