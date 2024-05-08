<?php
include(locate_template('header.php'));
$current_language = pll_current_language();
?>

<main class="main-content">
  <section class="error-page">
    <div class="container">
      <div class="error-page__inner">
        <div class="error-page__text-content">
          <div class="error-page__error title">404</div>
          <div class="error-page__title title title--h2"><?= $current_language == 'ru' ? 'Этой страницы не существует' : 'This page does not exist' ?></div>
          <p class="error-page__description title"><?= $current_language == 'ru' ? 'Возможно вы искали информацию о морских, мультимодальных перевозках
            или внутрипортовом экспедировании.' : 'Perhaps you were looking for information about maritime, multimodal transportation
            or intra-port forwarding.' ?></p>
        </div>
        <img src="<?php theme_image('404.svg'); ?>" alt="" class="error-page__image" />
      </div>
      <div class="error-page__links">
        <a href="<?= $current_language == 'ru' ? '/services-page/shipping-page/' : '/en/services-page-2/sea-transportation/' ?>" class="error-page__link button title title--h2">
          <span><?= $current_language == 'ru' ? 'Морские перевозки' : 'Shipping' ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H4.28572L10 8L4.28572 16H0L5.71428 8L0 0Z"
              fill="currentColor" />
          </svg>
        </a>
        <a href="<?= $current_language == 'ru' ? '/services-page/multimodal-transportation/' : '/en/services-page-2/multimodal-transportation/' ?>" class="error-page__link button title title--h2">
          <span><?= $current_language == 'ru' ? 'Мультимодальные перевозки' : 'Multimodal transportation' ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H4.28572L10 8L4.28572 16H0L5.71428 8L0 0Z"
              fill="currentColor" />
          </svg>
        </a>
        <a href="<?= $current_language == 'ru' ? '/services-page/in-development/' : '/en/services-page-2/ekspedirovanie/' ?>" class="error-page__link button title title--h2">
          <span><?= $current_language == 'ru' ? 'Внутрипортовое экспедирование' : 'Intraport forwarding' ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H4.28572L10 8L4.28572 16H0L5.71428 8L0 0Z"
              fill="currentColor" />
          </svg>
        </a>
      </div>
      <a href="<?= $current_language == 'ru' ? '/' : '/en/home/' ?>" class="error-page__main-page-link title"><?= $current_language == 'ru' ? 'Перейти на Главную' : 'Go to Home page' ?></a>
    </div>
  </section>
</main>
<?php
get_footer();