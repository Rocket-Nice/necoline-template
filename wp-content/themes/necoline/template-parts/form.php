<?php 
$current_language = pll_current_language();
if($current_language == 'ru'):
	echo do_shortcode('[contact-form-7 id="9ac7b94" html_class="form-container__form"]'); 
else:
	echo do_shortcode('[contact-form-7 id="39a28b8" html_class="form-container__form"]'); 
endif;
?>