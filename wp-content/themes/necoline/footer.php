<?php
$current_language = pll_current_language();
?>

<footer class="main-footer">
    <div class="main-footer__top-container">
      <img src="<?php theme_image('secondary-logo.svg'); ?>" class="main-footer__logo" alt="NECO LINE logo">

      <div class="main-footer__top-inner-container">
        <div class="main-footer__text-container">
          <h3 class="main-footer__text title title--button"><?= $current_language == 'ru' ? 'Подпишитесь на нашу рассылку' : '
Subscribe to our newsletter' ?></h3>
          <p class="main-footer__text text"><?= $current_language == 'ru' ? 'Получайте спецальные предложения и новости от нас первыми' : '
Be the first to receive special offers and news from us' ?></p>
        </div>
			<?php
		  if($current_language == 'ru'):
				echo do_shortcode('[contact-form-7 id="3d29b96" title="Email рассылка"]'); 
			else:
				echo do_shortcode('[contact-form-7 id="d9f4626" title="Email subscribe"]'); 
			endif;
			  ?>
      </div>
      <div class="main-footer__middle-left-container main-footer__middle-left-container--mobile">
        <div class="main-footer__contacts">
          <a href="tel:78124673780" class="main-footer__phone title title--h6">+7 812 467-37-80</a>
          <a href="mailto:sales@necoline.net" class="main-footer__email title title--h6">sales@necoline.net</a>
        </div>
        <button class="main-footer__button button button--primary title title--button"><?= $current_language == 'ru' ? 'Задать вопрос' : 'Ask a Question' ?></button>
      </div>
    </div>

    <div class="main-footer__container container">
      <div class="main-footer__middle-container">
        <div class="main-footer__middle-left-container">
          <div class="main-footer__contacts">
            <a href="tel:78124673780" class="main-footer__phone title title--h6">+7 812 467-37-80</a>
            <a href="mailto:sales@necoline.net" class="main-footer__email title title--h6">sales@necoline.net</a>
          </div>
          <button class="main-footer__button button button--primary title title--button"><?= $current_language == 'ru' ? 'Задать вопрос' : 'Ask a Question' ?></button>
        </div>
        <nav class="main-footer__nav">
          <ul class="main-footer__list">
            <li class="main-footer__item">
              <h4 class="main-footer__nav-title title title--button"><?php echo wp_get_nav_menu_name('footer_menu_1'); ?></h4>
              <?php 
                wp_nav_menu( [ 
                  'theme_location' => 'footer_menu_1',
                  'depth' => '0',
                  'menu_class'      => '',
                  'container'  => 'false',
                  'items_wrap'  => '<ul class="main-footer__links-list">%3$s</ul>',
                ] ); 
              ?>
            </li>
            <li class="main-footer__item">
              <h4 class="main-footer__nav-title title title--button"><?php echo wp_get_nav_menu_name('footer_menu_2'); ?></h4>
              <?php 
                wp_nav_menu( [ 
                  'theme_location' => 'footer_menu_2',
                  'depth' => '0',
                  'menu_class'      => '',
                  'container'  => 'false',
                  'items_wrap'  => '<ul class="main-footer__links-list">%3$s</ul>',
                ] ); 
              ?>
            </li>
            <li class="main-footer__item">
              <h4 class="main-footer__nav-title title title--button"><?php echo wp_get_nav_menu_name('footer_menu_3'); ?></h4>
              <?php 
                wp_nav_menu( [ 
                  'theme_location' => 'footer_menu_3',
                  'depth' => '0',
                  'menu_class'      => '',
                  'container'  => 'false',
                  'items_wrap'  => '<ul class="main-footer__links-list">%3$s</ul>',
                ] ); 
              ?>
            </li>
            <li class="main-footer__item">
              <h4 class="main-footer__nav-title title title--button"><?php echo wp_get_nav_menu_name('footer_menu_4'); ?></h4>
              <?php 
                wp_nav_menu( [ 
                  'theme_location' => 'footer_menu_4',
                  'depth' => '0',
                  'menu_class'      => '',
                  'container'  => 'false',
                  'items_wrap'  => '<ul class="main-footer__links-list">%3$s</ul>',
                ] ); 
              ?>
            </li>
          </ul>
        </nav>

      </div>
      <div class="main-footer__top-inner-container main-footer__top-inner-container--mobile">
        <div class="main-footer__text-container">
          <h3 class="main-footer__text main-footer__mobile-text title title--button"><?= $current_language == 'ru' ? 'Подпишитесь на нашу рассылку' : '
Subscribe to our newsletter' ?></h3>
          <p class="main-footer__text main-footer__mobile-little-text text"><?= $current_language == 'ru' ? 'Получайте спецальные предложения
            и новости от нас первыми' : 'Receive special offers
            and news from us first' ?></p>
        </div>

        <?php
		  if($current_language == 'ru'):
				echo do_shortcode('[contact-form-7 id="3d29b96" title="Email рассылка"]'); 
			else:
				echo do_shortcode('[contact-form-7 id="d9f4626" title="Email subscribe"]'); 
			endif;
			  ?>
      </div>
      <div class="main-footer__bottom-container">
        <div class="main-footer__text-bottom-container">
          <p class="main-footer__text">2024 © Neco Line Asia</p>
          <?php if ( get_field('conf_link','option') ) : ?><a href="<?php the_field('conf_link','option') ?>" class="main-footer__link" target="_blank"><?= $current_language == 'ru' ? 'Политика конфиденциальности' : 'Privacy Policy' ?></a><?php endif; ?>
        </div>

        <!-- TODO Сделать ссылки соц сетей -->
        <ul class="main-footer__socials">

          <li class="main-footer__social-item">
            <a href="https://t.me/necolineasia" class="main-footer__social-link">
              <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1157_61491)">
                  <path
                    d="M26 13C26 16.4478 24.6304 19.7544 22.1924 22.1924C19.7544 24.6304 16.4478 26 13 26C9.55219 26 6.24558 24.6304 3.80761 22.1924C1.36964 19.7544 0 16.4478 0 13C0 9.55219 1.36964 6.24558 3.80761 3.80761C6.24558 1.36964 9.55219 0 13 0C16.4478 0 19.7544 1.36964 22.1924 3.80761C24.6304 6.24558 26 9.55219 26 13ZM13.4664 9.59725C12.2021 10.1238 9.67362 11.2125 5.88413 12.8635C5.26988 13.1073 4.9465 13.3477 4.91725 13.5817C4.8685 13.9766 5.36413 14.1326 6.0385 14.3455L6.32288 14.4349C6.98588 14.651 7.87962 14.9029 8.34275 14.9126C8.76525 14.9224 9.23487 14.7501 9.75325 14.3926C13.2941 12.0023 15.1223 10.7949 15.236 10.7689C15.3173 10.7494 15.431 10.7266 15.5057 10.7949C15.5821 10.8615 15.574 10.9899 15.5659 11.024C15.5171 11.2336 13.572 13.0406 12.5661 13.9766C12.2525 14.2691 12.0299 14.4755 11.9844 14.5226C11.8842 14.625 11.7823 14.7258 11.6789 14.8249C11.0614 15.4196 10.5999 15.8649 11.7032 16.5929C12.2346 16.9439 12.6604 17.2315 13.0845 17.5208C13.546 17.836 14.0075 18.1496 14.6055 18.5429C14.7566 18.6404 14.9029 18.746 15.0443 18.8467C15.5821 19.2302 16.068 19.5748 16.6644 19.5195C17.0121 19.487 17.3713 19.162 17.5532 18.187C17.9839 15.8844 18.8305 10.8973 19.0255 8.84163C19.0374 8.67074 19.0303 8.49907 19.0044 8.32975C18.9891 8.19312 18.9229 8.06725 18.8191 7.97712C18.6713 7.87506 18.495 7.82218 18.3154 7.826C17.8279 7.83413 17.0755 8.09575 13.4664 9.59725Z"
                    fill="white" />
                </g>
                <defs>
                  <clipPath id="clip0_1157_61491">
                    <rect width="26" height="26" fill="white" />
                  </clipPath>
                </defs>
              </svg>

            </a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
    <?php wp_footer(); ?>
  </body>
</html>