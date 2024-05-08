<?php	$services = get_pages( [
			'parent' => $post->post_parent,
			'exclude' => $post->ID,
// 			'hierarchical' => true
		] );
$current_language = pll_current_language();
?>
<section class="service-list" id="other-services">
	<div class="container">
		<div class="service-list__title title title--h4"><?= $current_language == 'ru' ? 'другие услуги' : 'other services' ?></div>
		<ul class="service-list__list">
			<?php foreach( $services as $service ): ?>
			<li class="service-list__card card">
				<div class="service-list__card-image-wrapper">
					<img src="<?php echo get_the_post_thumbnail_url( $service->ID, 'full' ); ?>" alt="<?php echo $service->post_title; ?>" class="service-list__card-image">
				</div>
				<div class="service-list__card-content">
					<div class="service-list__card-title title title--h2"><?php echo $service->post_title; ?></div>
					<div class="service-list__card-description"><?php echo $service->post_content; ?></div>
					<a href="<?php echo get_page_link( $service->ID ); ?>" class="service-list__card-read-all">Читать подробнее</a>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>