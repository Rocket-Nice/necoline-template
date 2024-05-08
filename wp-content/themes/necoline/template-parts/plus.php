<?php
$current_language = pll_current_language();
?>

<div class="advantages__title title title--h2"><?= $current_language == 'ru' ? 'Обращаясь в NECO LINE вы получаете' : 'By contacting NECO LINE you receive' ?></div>
<?php if( have_rows('plus_list','option') ): ?>
<div class="advantages__list">
	<?php while ( have_rows('plus_list','option') ) : the_row(); ?>
	<div class="advantages__card card card--primary">
		<div class="advantages__card-title title"><?php the_sub_field('title') ?></div>
		<div class="advantages__card-body"><?php the_sub_field('descr') ?></div>
	</div>
	<?php endwhile; ?>
</div>
<?php endif;  ?>