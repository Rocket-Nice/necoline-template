<?php
$current_language = pll_current_language();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta name="yandex-verification" content="9a28982de8d4f0f5" />
	<meta name="yandex-verification" content="ee7be080b7c903dc" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <header class="main-header container">
    <a href="<?= $current_language == 'ru' ? '/' : '/en/home/' ?>" class="main-header__logo-link">
      <img src="<?php theme_image('logo.svg'); ?>" alt="NECO LINE." class="main-header__logo">
    </a>

    <nav class="main-header__nav">
      <?php 
      wp_nav_menu( [ 
        'theme_location' => 'main',
        'menu_class'      => '',
        'container'  => 'false',
        'items_wrap'  => '<ul class="main-header__list">%3$s</ul>',
      ] ); 
      ?>
    </nav>
	
    <div class="main-header__contacts">
      <a href="tel:<?php the_field('contacts_phone', 'option') ?>" class="main-header__phone title title--button"><?php the_field('contacts_phone', 'option') ?></a>
      <a href="mailto:<?php the_field('contacts_email', 'option') ?>" class="main-header__email title title--h6"><?php the_field('contacts_email', 'option') ?></a>
    </div>
    <div class="header-controllers">
      <a href="http://185.221.214.181/login" class="header-controllers__button">
        <svg class="header-controllers__svg" width="32" height="32" viewBox="0 0 32 32" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M4.33301 22.668C4.33301 19.9065 6.57158 17.668 9.33301 17.668H22.6663C25.4278 17.668 27.6663 19.9065 27.6663 22.668V24.668C27.6663 26.3248 26.3232 27.668 24.6663 27.668H7.33301C5.67616 27.668 4.33301 26.3248 4.33301 24.668V22.668ZM9.33301 19.668C7.67615 19.668 6.33301 21.0111 6.33301 22.668V24.668C6.33301 25.2203 6.78072 25.668 7.33301 25.668H24.6663C25.2186 25.668 25.6663 25.2203 25.6663 24.668V22.668C25.6663 21.0111 24.3232 19.668 22.6663 19.668H9.33301Z"
            fill="#314D71" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M16 6.33594C14.3431 6.33594 13 7.67908 13 9.33594C13 10.9928 14.3431 12.3359 16 12.3359C17.6569 12.3359 19 10.9928 19 9.33594C19 7.67908 17.6569 6.33594 16 6.33594ZM11 9.33594C11 6.57451 13.2386 4.33594 16 4.33594C18.7614 4.33594 21 6.57451 21 9.33594C21 12.0974 18.7614 14.3359 16 14.3359C13.2386 14.3359 11 12.0974 11 9.33594Z"
            fill="#314D71" />
        </svg>
      </a>
    </div>
	  <ul class="lang__list <?= $current_language ?>">
		<?php pll_the_languages( array( 'show_flags' => 1, 'show_names' => 0, 'hide_current' => 1 ) ); ?>
	</ul>
    <button class="main-header__menu-button">
    </button>
    <div class="mobile-menu">
      <div class="mobile-menu__container">
        <div class="mobile-menu__top-container">
          <!-- <button class="mobile-menu__controllers-button">
                                  <img src="img/icons/eng-flag.svg" alt="Languages select."
                                      class="mobile-menu__controllers-img mobile-menu__controllers-lang">
                              </button> -->
          <button class="mobile-menu__close-button"></button>
        </div>
        <nav class="mobile-menu__nav">
          <?php 
          wp_nav_menu( [ 
            'theme_location' => 'mobile',
            'menu_class'      => '',
            'container'  => 'false',
            'items_wrap'  => '<ul class="mobile-menu__list">%3$s</ul>',
          ] ); 
          ?>
        </nav>
      </div>

      <div class="mobile-menu__bottom-container">
        <div class="mobile-menu__contacts">
          <a href="tel:<?php the_field('contacts_phone', 'option') ?>"
            class="mobile-menu__phone mobile-menu__contact-link title title--button"><?php the_field('contacts_phone', 'option') ?></a>
          <a href="mailto:<?php the_field('contacts_email', 'option') ?>"
            class="mobile-menu__email mobile-menu__contact-link title title--h6"><?php the_field('contacts_email', 'option') ?></a>
        </div>
        <button class="mobile-menu__button title title--button"><?= $current_language == 'ru' ? 'отследить груз' : 'track the cargo' ?></button>
      </div>
    </div>
  </header>