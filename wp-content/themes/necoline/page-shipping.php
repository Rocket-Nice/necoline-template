<?php
/*
Template Name: Морские перевозки
Template Post Type: page
*/
include(locate_template('header.php'));
$directions = get_terms([
  'taxonomy' => 'directions'
]);
$current_language = pll_current_language();
?>

<main class="main-content">
  <div class="container">
    <div class="breadcrumbs text">
      <ul class="breadcrumbs__list">
        <li class="breadcrumbs__item">
          <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
        </li>
        <li class="breadcrumbs__item">
          <a href="<?= get_page_link(110) ?>" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Услуги' : 'Services' ?></a>
        </li>
        <li class="breadcrumbs__item"><?php the_title() ?></li>
      </ul>
    </div>
    <div class="service-wrapper">
      <aside class="service-wrapper__aside service-aside">
        <nav class="service-wrapper__nav service-aside__nav" data-sticky="1000" data-sticky-top="115" data-sticky-bottom="390">
          <ul class="service-aside__nav-list" data-scroll-spy-menu data-sticky-item>
            <li class="service-aside__nav-item">
              <a href="#directions" class="service-aside__nav-link title" data-scroll-link><?= $current_language == 'ru' ? 'Направления' : 'Directions' ?></a>
            </li>
            <li class="service-aside__nav-item">
              <a href="#our-assets" class="service-aside__nav-link title" data-scroll-link><?= $current_language == 'ru' ? 'Наши активы' : 'Our Actives' ?></a>
            </li>
            <li class="service-aside__nav-item">
              <a href="#advantages" class="service-aside__nav-link title" data-scroll-link><?= $current_language == 'ru' ? 'Преимущества' : 'Advantages' ?></a>
            </li>
            <li class="service-aside__nav-item">
              <a href="#other-services" class="service-aside__nav-link title" data-scroll-link><?= $current_language == 'ru' ? 'Другие услуги' : 'Other services' ?></a>
            </li>
            <li class="service-aside__nav-item">
              <a href="#cost-calculation" class="service-aside__nav-link title" data-scroll-link><?= $current_language == 'ru' ? 'Расчёт стоимости' : 'Cost calculation' ?></a>
            </li>
          </ul>
        </nav>
      </aside>
      <div class="service-wrapper__sections">
        <section class="service-head">
          <h1 class="service-head__title title title--h1"><?= get_field('title') ?></h1>
          <div class="service-head__subtitle title title--h3"><?= get_field('subtitle') ?></div>
          <div class="service-head__description">
            <div class="service-head__description-title title title--h2"><?= get_field('descr_title') ?></div>
            <div class="service-head__description-text">
              <?= get_field('descr') ?>
            </div>
          </div>
        </section>
        <section class="directions" id="directions">
          <div class="directions__toggle-buttons toggle-buttons">
            <button data-direction="aziya-baltika<?= $current_language == 'ru' ? '' : '-eng' ?>" class="toggle-buttons__button toggle-buttons__button--active button title title--button" type="button">
              <span class="toggle-buttons__button-text"><?= $current_language == 'ru' ? 'Азия' : 'Asia' ?></span>
              <span class="toggle-buttons__button-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="122" height="21" viewBox="0 0 122 21" fill="none">
                  <path d="M0.646447 10.1464C0.451184 10.3417 0.451184 10.6583 0.646447 10.8536L3.82843 14.0355C4.02369 14.2308 4.34027 14.2308 4.53553 14.0355C4.7308 13.8403 4.7308 13.5237 4.53553 13.3284L1.70711 10.5L4.53553 7.67157C4.7308 7.47631 4.7308 7.15973 4.53553 6.96447C4.34027 6.7692 4.02369 6.7692 3.82843 6.96447L0.646447 10.1464ZM121.354 10.8536C121.549 10.6583 121.549 10.3417 121.354 10.1464L118.172 6.96447C117.976 6.7692 117.66 6.7692 117.464 6.96447C117.269 7.15973 117.269 7.47631 117.464 7.67157L120.293 10.5L117.464 13.3284C117.269 13.5237 117.269 13.8403 117.464 14.0355C117.66 14.2308 117.976 14.2308 118.172 14.0355L121.354 10.8536ZM1 11H121V10H1V11Z" fill="currentColor" />
                </svg>
              </span>
              <span class="toggle-buttons__button-text"><?= $current_language == 'ru' ? 'Балтика' : 'Baltic' ?></span>
            </button>
            <button data-direction="aziya-dalnij-vostok<?= $current_language == 'ru' ? '' : '-eng' ?>" class="toggle-buttons__button button title title--button" type="button">
              <span class="toggle-buttons__button-text"><?= $current_language == 'ru' ? 'Азия' : 'Asia' ?></span>
              <span class="toggle-buttons__button-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="122" height="21" viewBox="0 0 122 21" fill="none">
                  <path d="M0.646447 10.1464C0.451184 10.3417 0.451184 10.6583 0.646447 10.8536L3.82843 14.0355C4.02369 14.2308 4.34027 14.2308 4.53553 14.0355C4.7308 13.8403 4.7308 13.5237 4.53553 13.3284L1.70711 10.5L4.53553 7.67157C4.7308 7.47631 4.7308 7.15973 4.53553 6.96447C4.34027 6.7692 4.02369 6.7692 3.82843 6.96447L0.646447 10.1464ZM121.354 10.8536C121.549 10.6583 121.549 10.3417 121.354 10.1464L118.172 6.96447C117.976 6.7692 117.66 6.7692 117.464 6.96447C117.269 7.15973 117.269 7.47631 117.464 7.67157L120.293 10.5L117.464 13.3284C117.269 13.5237 117.269 13.8403 117.464 14.0355C117.66 14.2308 117.976 14.2308 118.172 14.0355L121.354 10.8536ZM1 11H121V10H1V11Z" fill="currentColor" />
                </svg>
              </span>
              <span class="toggle-buttons__button-text"><?= $current_language == 'ru' ? 'Дальний Восток' : 'Far East' ?></span>
            </button>
          </div>
          <?php foreach ($directions as $post) : setup_postdata($post); ?>
            <?php single_term_title();
            echo get_the_title(); ?>
          <?php endforeach; ?>
          <div class="directions__available-services available-services">
            <div class="available-services__title title title--h2"><?= $current_language == 'ru' ? 'Доступные сервисы' : 'Available services' ?></div>
            <div class="available-services__buttons">
              <?php
              $services_2 = new WP_Query([
                'posts_per_page' => -1,
                'post_type' => 'services',
                'directions' => 'aziya-dalnij-vostok'
              ]);
              if ($services_2->have_posts()) : while ($services_2->have_posts()) : $services_2->the_post();
              ?>
                  <button class="available-services__button button title title--button" data-direction="aziya-dalnij-vostok<?= $current_language == 'ru' ? '' : '-eng' ?>" data-service-direction="<?php echo str_replace(['-', ' ', '.', '—'], '', get_the_title()); ?>" type="button"><?php the_title() ?></button>
              <?php endwhile;
                wp_reset_postdata();
              endif;
              ?>
              <?php
              $services_1 = new WP_Query([
                'posts_per_page' => -1,
                'post_type' => 'services',
                'directions' => 'aziya-baltika'
              ]);
              if ($services_1->have_posts()) : while ($services_1->have_posts()) : $services_1->the_post();
              ?>
                  <button class="available-services__button button title title--button" type="button" data-direction="aziya-baltika<?= $current_language == 'ru' ? '' : '-eng' ?>" data-service-direction="<?php echo str_replace(['—', '-', ' ', '.'], '', get_the_title()); ?>""><?php the_title() ?></button>
                <?php endwhile;
                wp_reset_postdata();
              endif;
                ?>
              </div>
              <div class=" available-services__content">
                    <div class="available-services__title title title--h2"><?= $current_language == 'ru' ? 'Маршрут следования' : 'Itinerary' ?></div>
                    <div class="available-services__itinerary itinerary">
                      <?php $services = get_posts([
                        'post_type' => 'services',
                        'post_status'    => 'publish',
                        'posts_per_page' => -1,
                      ]);
                      foreach ($services as $post) : setup_postdata($post);
                        $service_map = get_field('services_img');
                      ?>
                        <picture>
                          <img class="itinerary__map hide" data-service-direction="<?php echo str_replace(['-', ' ', '.', '—'], '', $post->post_title); ?>" src="<?= esc_url($service_map["url"]) ?>" alt="<?= esc_attr($service_map["alt"]) ?>" />
                        </picture>
                      <?php endforeach;
                      wp_reset_postdata();
                      ?>
                    </div>
            </div>
          </div>
          <div class="directions__tabs tabs">
            <ul class="tabs__links" role="tablist">
              <li class="tabs__link-wrap tabs__link-wrap--active" role="presentation">
                <a href="#ports" class="tabs__link title title--h2" data-toggle="tab" role="tab"><?= $current_language == 'ru' ? 'Порты судозахода' : 'Ports of ship call' ?></a>
              </li>
              <li class="tabs__link-wrap" role="presentation">
                <a href="#feeder-service" class="tabs__link title title--h2" data-toggle="tab" role="tab"><?= $current_language == 'ru' ? 'Фидерный сервис' : 'Feeder service' ?></a>
              </li>
            </ul>
            <div class="tabs__content-wrapper">
              <div class="tabs__content-item tabs__content-item--active" role="tabpanel" id="ports">
                <?php foreach ($directions as $direction) :
                  $services = new WP_Query([
                    'posts_per_page' => -1,
                    'post_type' => 'services',
                    'directions' => $direction->slug
                  ]);
                  if ($services->have_posts()) : while ($services->have_posts()) : $services->the_post();
                ?>
                      <div class="route-card-list hide" data-direction="<?= $direction->slug ?>" data-service-direction="<?php echo str_replace(['-', ' ', '.', '—'], '', get_the_title()); ?>">
                        <?php if ($ports_1 = get_field('services_ports_1')) :
                          foreach ($ports_1 as $post) : setup_postdata($post);
                        ?>
                            <div class="route-card-list__item route-card card">
                              <div class="route-card__action">
                                <div class="route-card__head">
                                  <picture>
                                    <img class="route-card__logo" src="<?php the_field('port_flag'); ?>" alt="<?php the_title(); ?>" />
                                  </picture>
                                  <div class="route-card__title title title--h2"><?php the_title(); ?></div>
                                </div>
                                <?php if (get_field('port_hide') !== true) :  ?>
                                  <button class="route-card__button button title title--button c-modal__button" data-src="#modal-route-<?php echo $post->ID ?>">
                                    <p><?= $current_language == 'ru' ? 'Подробнее' : 'More details' ?></p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z" fill="currentColor"></path>
                                    </svg>
                                  </button>
                                <?php endif; ?>
                              </div>
                              <div class="route-card__information">
                                <div class="route-card__chars">
                                  <div class="route-card__chars-top">
                                    <div class="route-card__chars-list">
                                      <div class="route-card__chars-item">
                                        <div class="route-card__chars-name"><?= $current_language == 'ru' ? 'Страна:' : 'Country:' ?></div>
                                        <div class="route-card__chars-value"><?php the_field('port_country'); ?></div>
                                      </div>
                                      <div class="route-card__chars-item">
                                        <div class="route-card__chars-name"><?= $current_language == 'ru' ? 'Город:' : 'City:' ?></div>
                                        <div class="route-card__chars-value"><?php the_field('port_city'); ?></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php endforeach;
                          wp_reset_postdata();
                        endif; ?>
                      </div>
                <?php endwhile;
                    wp_reset_postdata();
                  endif;
                endforeach; ?>
              </div>

              <div class="tabs__content-item" role="tabpanel" id="feeder-service">
                <?php
                foreach ($directions as $direction) :
                  $services = new WP_Query([
                    'posts_per_page' => -1,
                    'post_type' => 'services',
                    'directions' => $direction->slug
                  ]);

                  if ($services->have_posts()) : while ($services->have_posts()) : $services->the_post();
                ?>
                      <div class="route-card-list hide" data-direction="<?= $direction->slug ?>" data-service-direction="<?php the_title() ?>">
                        <?php if ($ports_2 = get_field('services_ports_2')) :
                          foreach ($ports_2 as $post) : setup_postdata($post);
                        ?>
                            <div class="route-card-list__item route-card card">
                              <div class="route-card__action">
                                <div class="route-card__head">
                                  <picture>
                                    <img class="route-card__logo" src="<?php the_field('port_flag'); ?>" alt="<?php the_title(); ?>" />
                                  </picture>
                                  <div class="route-card__title title title--h2"><?php the_title(); ?></div>
                                </div>
                                <button class="route-card__button button title title--button c-modal__button" data-src="#modal-route-<?php echo $post->ID ?>">
                                  <p><?= $current_language == 'ru' ? 'отправить запрос' : 'send a request:' ?></p>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z" fill="currentColor"></path>
                                  </svg>
                                </button>
                              </div>
                              <div class="route-card__information">
                                <div class="route-card__chars">
                                  <div class="route-card__chars-top">
                                    <div class="route-card__chars-list">
                                      <div class="route-card__chars-item">
                                        <div class="route-card__chars-name"><?= $current_language == 'ru' ? 'Страна:' : 'Country:' ?></div>
                                        <div class="route-card__chars-value"><?php the_field('port_country'); ?></div>
                                      </div>
                                      <div class="route-card__chars-item">
                                        <div class="route-card__chars-name"><?= $current_language == 'ru' ? 'Город:' : 'City:' ?></div>
                                        <div class="route-card__chars-value"><?php the_field('port_city'); ?></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php endforeach;
                          wp_reset_postdata();
                        endif; ?>
                      </div>
                <?php endwhile;
                    wp_reset_postdata();
                  endif;
                endforeach; ?>
              </div>
            </div>
          </div>
          <a href="<?= $current_language == 'ru' ? '/schedule/raspisanie-dvizheniya-sudov/' : '/en/raspisanie-dvizheniya-sudov/' ?>" class="directions__schedule-button button title title--button button--primary" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
              <mask id="path-1-outside-1_1378_43933" maskUnits="userSpaceOnUse" x="-0.5" y="0" width="22" height="22" fill="black">
                <rect fill="white" x="-0.5" width="22" height="22" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.21206 1.04563C3.47057 1.22402 2.98609 1.84677 2.98609 2.62161V2.90796H2.77241C2.42234 2.90796 2.1011 2.98246 1.76012 3.14278C1.22837 3.39277 0.799884 3.87019 0.60389 4.43119L0.514053 4.68835L0.502717 10.7534C0.494638 15.0923 0.504205 16.8935 0.536401 17.082C0.668685 17.8568 1.28509 18.5351 2.10178 18.8046C2.36245 18.8906 2.37174 18.8909 6.05849 18.9033L9.75388 18.9157L10.1849 19.321C11.1246 20.2048 12.2055 20.7337 13.5174 20.9516C13.9065 21.0163 14.9787 21.0161 15.3664 20.9513C16.6941 20.7296 17.8214 20.1602 18.7539 19.2404C21.0635 16.9621 21.0844 13.3467 18.8016 11.0152C18.5974 10.8067 18.2852 10.5304 18.1078 10.4013L17.7853 10.1665L17.7702 7.44699C17.7554 4.77276 17.7537 4.72326 17.6672 4.47314C17.479 3.92885 17.0885 3.4582 16.5988 3.18547C16.3231 3.03188 15.8326 2.90796 15.5006 2.90796H15.2458L15.2451 2.70253C15.2441 2.4082 15.1491 2.01745 15.0275 1.80721C14.8853 1.56147 14.5681 1.28095 14.2898 1.15499C13.997 1.02238 13.5187 0.991433 13.1975 1.08433C12.7656 1.20919 12.4113 1.50814 12.2022 1.92416C12.1179 2.09183 12.0909 2.2149 12.0729 2.51228L12.0502 2.88839L9.12598 2.89845L6.20175 2.90847L6.20126 2.64411C6.20038 2.1609 6.04261 1.77109 5.72133 1.45829C5.32186 1.06946 4.75607 0.914739 4.21206 1.04563ZM4.21648 1.98313C4.13046 2.0338 4.01751 2.14376 3.96546 2.2275C3.87313 2.37599 3.8708 2.40241 3.87059 3.30904L3.87039 4.23836H4.59593H5.32142L5.3094 3.2865C5.2975 2.3461 5.29613 2.33291 5.19754 2.19294C4.98365 1.88934 4.53756 1.79394 4.21648 1.98313ZM13.2731 1.97957C13.1985 2.02848 13.0963 2.12795 13.046 2.20058C12.9572 2.32892 12.9546 2.35913 12.9546 3.28548V4.23836H13.6606H14.3667L14.354 3.28634L14.3414 2.33428L14.2262 2.18735C14.0557 1.96991 13.8979 1.8909 13.6339 1.89075C13.466 1.89063 13.3741 1.91325 13.2731 1.97957ZM2.38118 3.8221C2.1497 3.88287 1.96017 3.99721 1.7764 4.18699C1.43325 4.54134 1.37826 4.75679 1.37826 5.74677V6.46875H9.14057H16.9029L16.8848 5.65681C16.8688 4.93749 16.8567 4.81948 16.7778 4.6223C16.5862 4.14269 16.1033 3.81209 15.5433 3.7771L15.2537 3.75903L15.2397 4.31498L15.2257 4.87093L15.0944 4.98507L14.9631 5.09921H13.6755C12.3068 5.09921 12.2116 5.08744 12.1117 4.90572C12.0889 4.86432 12.0703 4.59159 12.0703 4.29964V3.76881H9.13603H6.20175V4.25539C6.20175 4.52299 6.1841 4.78712 6.16255 4.84229C6.14101 4.8975 6.06411 4.97819 5.99172 5.02166C5.86567 5.0973 5.80401 5.10019 4.54034 5.09014L3.22059 5.07965L3.10334 4.95185C2.98609 4.82409 2.98609 4.82405 2.98609 4.29643V3.76881L2.77506 3.77143C2.65898 3.77292 2.48175 3.79569 2.38118 3.8221ZM1.38755 12.1718L1.39836 17.0142L1.50705 17.2399C1.64962 17.5361 1.95587 17.8241 2.25203 17.9405L2.48364 18.0315L5.80984 18.0428C7.63926 18.049 9.13603 18.047 9.13603 18.0383C9.13603 18.0297 9.05656 17.8661 8.95945 17.6749C8.77049 17.3028 8.58189 16.7658 8.47308 16.2903C8.38321 15.8973 8.34671 14.7577 8.41022 14.3265C8.66393 12.6034 9.62791 11.1162 11.1056 10.1677C11.549 9.88315 11.7072 9.80172 12.1686 9.62067C12.9079 9.33053 13.5932 9.20363 14.4218 9.20355C15.2223 9.20347 15.8183 9.30408 16.5437 9.56178C16.7226 9.62537 16.8748 9.67737 16.882 9.67737C16.8891 9.67737 16.8902 9.15354 16.8844 8.51327L16.8737 7.34916L9.12522 7.33926L1.37673 7.3294L1.38755 12.1718ZM13.9718 10.073C11.4509 10.2872 9.43489 12.2729 9.26341 14.7106C9.08181 17.2923 10.8126 19.5228 13.4075 20.051C14.2425 20.2209 15.3349 20.1466 16.1395 19.865C17.7286 19.3088 18.9485 18.0549 19.4049 16.5085C19.5569 15.9935 19.6028 15.6644 19.6017 15.0968C19.6001 14.2588 19.4548 13.6381 19.0887 12.9056C18.1387 11.0045 16.1255 9.89008 13.9718 10.073ZM14.0007 12.1187C13.9269 12.1426 13.8287 12.2118 13.7824 12.2725C13.7007 12.3797 13.6979 12.4295 13.6869 13.9631C13.6745 15.6913 13.6804 15.7433 13.904 15.8861C14.0048 15.9505 14.1334 15.9589 15.1836 15.9701C15.8258 15.9769 16.431 15.971 16.5285 15.9569C16.7851 15.92 16.934 15.7644 16.934 15.5333C16.934 15.389 16.9118 15.3355 16.811 15.2374L16.688 15.1177L15.6353 15.1072L14.5825 15.0968L14.5625 13.7273C14.5514 12.974 14.5273 12.328 14.5088 12.2916C14.4297 12.1356 14.1953 12.0558 14.0007 12.1187Z" />
              </mask>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.21206 1.04563C3.47057 1.22402 2.98609 1.84677 2.98609 2.62161V2.90796H2.77241C2.42234 2.90796 2.1011 2.98246 1.76012 3.14278C1.22837 3.39277 0.799884 3.87019 0.60389 4.43119L0.514053 4.68835L0.502717 10.7534C0.494638 15.0923 0.504205 16.8935 0.536401 17.082C0.668685 17.8568 1.28509 18.5351 2.10178 18.8046C2.36245 18.8906 2.37174 18.8909 6.05849 18.9033L9.75388 18.9157L10.1849 19.321C11.1246 20.2048 12.2055 20.7337 13.5174 20.9516C13.9065 21.0163 14.9787 21.0161 15.3664 20.9513C16.6941 20.7296 17.8214 20.1602 18.7539 19.2404C21.0635 16.9621 21.0844 13.3467 18.8016 11.0152C18.5974 10.8067 18.2852 10.5304 18.1078 10.4013L17.7853 10.1665L17.7702 7.44699C17.7554 4.77276 17.7537 4.72326 17.6672 4.47314C17.479 3.92885 17.0885 3.4582 16.5988 3.18547C16.3231 3.03188 15.8326 2.90796 15.5006 2.90796H15.2458L15.2451 2.70253C15.2441 2.4082 15.1491 2.01745 15.0275 1.80721C14.8853 1.56147 14.5681 1.28095 14.2898 1.15499C13.997 1.02238 13.5187 0.991433 13.1975 1.08433C12.7656 1.20919 12.4113 1.50814 12.2022 1.92416C12.1179 2.09183 12.0909 2.2149 12.0729 2.51228L12.0502 2.88839L9.12598 2.89845L6.20175 2.90847L6.20126 2.64411C6.20038 2.1609 6.04261 1.77109 5.72133 1.45829C5.32186 1.06946 4.75607 0.914739 4.21206 1.04563ZM4.21648 1.98313C4.13046 2.0338 4.01751 2.14376 3.96546 2.2275C3.87313 2.37599 3.8708 2.40241 3.87059 3.30904L3.87039 4.23836H4.59593H5.32142L5.3094 3.2865C5.2975 2.3461 5.29613 2.33291 5.19754 2.19294C4.98365 1.88934 4.53756 1.79394 4.21648 1.98313ZM13.2731 1.97957C13.1985 2.02848 13.0963 2.12795 13.046 2.20058C12.9572 2.32892 12.9546 2.35913 12.9546 3.28548V4.23836H13.6606H14.3667L14.354 3.28634L14.3414 2.33428L14.2262 2.18735C14.0557 1.96991 13.8979 1.8909 13.6339 1.89075C13.466 1.89063 13.3741 1.91325 13.2731 1.97957ZM2.38118 3.8221C2.1497 3.88287 1.96017 3.99721 1.7764 4.18699C1.43325 4.54134 1.37826 4.75679 1.37826 5.74677V6.46875H9.14057H16.9029L16.8848 5.65681C16.8688 4.93749 16.8567 4.81948 16.7778 4.6223C16.5862 4.14269 16.1033 3.81209 15.5433 3.7771L15.2537 3.75903L15.2397 4.31498L15.2257 4.87093L15.0944 4.98507L14.9631 5.09921H13.6755C12.3068 5.09921 12.2116 5.08744 12.1117 4.90572C12.0889 4.86432 12.0703 4.59159 12.0703 4.29964V3.76881H9.13603H6.20175V4.25539C6.20175 4.52299 6.1841 4.78712 6.16255 4.84229C6.14101 4.8975 6.06411 4.97819 5.99172 5.02166C5.86567 5.0973 5.80401 5.10019 4.54034 5.09014L3.22059 5.07965L3.10334 4.95185C2.98609 4.82409 2.98609 4.82405 2.98609 4.29643V3.76881L2.77506 3.77143C2.65898 3.77292 2.48175 3.79569 2.38118 3.8221ZM1.38755 12.1718L1.39836 17.0142L1.50705 17.2399C1.64962 17.5361 1.95587 17.8241 2.25203 17.9405L2.48364 18.0315L5.80984 18.0428C7.63926 18.049 9.13603 18.047 9.13603 18.0383C9.13603 18.0297 9.05656 17.8661 8.95945 17.6749C8.77049 17.3028 8.58189 16.7658 8.47308 16.2903C8.38321 15.8973 8.34671 14.7577 8.41022 14.3265C8.66393 12.6034 9.62791 11.1162 11.1056 10.1677C11.549 9.88315 11.7072 9.80172 12.1686 9.62067C12.9079 9.33053 13.5932 9.20363 14.4218 9.20355C15.2223 9.20347 15.8183 9.30408 16.5437 9.56178C16.7226 9.62537 16.8748 9.67737 16.882 9.67737C16.8891 9.67737 16.8902 9.15354 16.8844 8.51327L16.8737 7.34916L9.12522 7.33926L1.37673 7.3294L1.38755 12.1718ZM13.9718 10.073C11.4509 10.2872 9.43489 12.2729 9.26341 14.7106C9.08181 17.2923 10.8126 19.5228 13.4075 20.051C14.2425 20.2209 15.3349 20.1466 16.1395 19.865C17.7286 19.3088 18.9485 18.0549 19.4049 16.5085C19.5569 15.9935 19.6028 15.6644 19.6017 15.0968C19.6001 14.2588 19.4548 13.6381 19.0887 12.9056C18.1387 11.0045 16.1255 9.89008 13.9718 10.073ZM14.0007 12.1187C13.9269 12.1426 13.8287 12.2118 13.7824 12.2725C13.7007 12.3797 13.6979 12.4295 13.6869 13.9631C13.6745 15.6913 13.6804 15.7433 13.904 15.8861C14.0048 15.9505 14.1334 15.9589 15.1836 15.9701C15.8258 15.9769 16.431 15.971 16.5285 15.9569C16.7851 15.92 16.934 15.7644 16.934 15.5333C16.934 15.389 16.9118 15.3355 16.811 15.2374L16.688 15.1177L15.6353 15.1072L14.5825 15.0968L14.5625 13.7273C14.5514 12.974 14.5273 12.328 14.5088 12.2916C14.4297 12.1356 14.1953 12.0558 14.0007 12.1187Z" fill="white" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.21206 1.04563C3.47057 1.22402 2.98609 1.84677 2.98609 2.62161V2.90796H2.77241C2.42234 2.90796 2.1011 2.98246 1.76012 3.14278C1.22837 3.39277 0.799884 3.87019 0.60389 4.43119L0.514053 4.68835L0.502717 10.7534C0.494638 15.0923 0.504205 16.8935 0.536401 17.082C0.668685 17.8568 1.28509 18.5351 2.10178 18.8046C2.36245 18.8906 2.37174 18.8909 6.05849 18.9033L9.75388 18.9157L10.1849 19.321C11.1246 20.2048 12.2055 20.7337 13.5174 20.9516C13.9065 21.0163 14.9787 21.0161 15.3664 20.9513C16.6941 20.7296 17.8214 20.1602 18.7539 19.2404C21.0635 16.9621 21.0844 13.3467 18.8016 11.0152C18.5974 10.8067 18.2852 10.5304 18.1078 10.4013L17.7853 10.1665L17.7702 7.44699C17.7554 4.77276 17.7537 4.72326 17.6672 4.47314C17.479 3.92885 17.0885 3.4582 16.5988 3.18547C16.3231 3.03188 15.8326 2.90796 15.5006 2.90796H15.2458L15.2451 2.70253C15.2441 2.4082 15.1491 2.01745 15.0275 1.80721C14.8853 1.56147 14.5681 1.28095 14.2898 1.15499C13.997 1.02238 13.5187 0.991433 13.1975 1.08433C12.7656 1.20919 12.4113 1.50814 12.2022 1.92416C12.1179 2.09183 12.0909 2.2149 12.0729 2.51228L12.0502 2.88839L9.12598 2.89845L6.20175 2.90847L6.20126 2.64411C6.20038 2.1609 6.04261 1.77109 5.72133 1.45829C5.32186 1.06946 4.75607 0.914739 4.21206 1.04563ZM4.21648 1.98313C4.13046 2.0338 4.01751 2.14376 3.96546 2.2275C3.87313 2.37599 3.8708 2.40241 3.87059 3.30904L3.87039 4.23836H4.59593H5.32142L5.3094 3.2865C5.2975 2.3461 5.29613 2.33291 5.19754 2.19294C4.98365 1.88934 4.53756 1.79394 4.21648 1.98313ZM13.2731 1.97957C13.1985 2.02848 13.0963 2.12795 13.046 2.20058C12.9572 2.32892 12.9546 2.35913 12.9546 3.28548V4.23836H13.6606H14.3667L14.354 3.28634L14.3414 2.33428L14.2262 2.18735C14.0557 1.96991 13.8979 1.8909 13.6339 1.89075C13.466 1.89063 13.3741 1.91325 13.2731 1.97957ZM2.38118 3.8221C2.1497 3.88287 1.96017 3.99721 1.7764 4.18699C1.43325 4.54134 1.37826 4.75679 1.37826 5.74677V6.46875H9.14057H16.9029L16.8848 5.65681C16.8688 4.93749 16.8567 4.81948 16.7778 4.6223C16.5862 4.14269 16.1033 3.81209 15.5433 3.7771L15.2537 3.75903L15.2397 4.31498L15.2257 4.87093L15.0944 4.98507L14.9631 5.09921H13.6755C12.3068 5.09921 12.2116 5.08744 12.1117 4.90572C12.0889 4.86432 12.0703 4.59159 12.0703 4.29964V3.76881H9.13603H6.20175V4.25539C6.20175 4.52299 6.1841 4.78712 6.16255 4.84229C6.14101 4.8975 6.06411 4.97819 5.99172 5.02166C5.86567 5.0973 5.80401 5.10019 4.54034 5.09014L3.22059 5.07965L3.10334 4.95185C2.98609 4.82409 2.98609 4.82405 2.98609 4.29643V3.76881L2.77506 3.77143C2.65898 3.77292 2.48175 3.79569 2.38118 3.8221ZM1.38755 12.1718L1.39836 17.0142L1.50705 17.2399C1.64962 17.5361 1.95587 17.8241 2.25203 17.9405L2.48364 18.0315L5.80984 18.0428C7.63926 18.049 9.13603 18.047 9.13603 18.0383C9.13603 18.0297 9.05656 17.8661 8.95945 17.6749C8.77049 17.3028 8.58189 16.7658 8.47308 16.2903C8.38321 15.8973 8.34671 14.7577 8.41022 14.3265C8.66393 12.6034 9.62791 11.1162 11.1056 10.1677C11.549 9.88315 11.7072 9.80172 12.1686 9.62067C12.9079 9.33053 13.5932 9.20363 14.4218 9.20355C15.2223 9.20347 15.8183 9.30408 16.5437 9.56178C16.7226 9.62537 16.8748 9.67737 16.882 9.67737C16.8891 9.67737 16.8902 9.15354 16.8844 8.51327L16.8737 7.34916L9.12522 7.33926L1.37673 7.3294L1.38755 12.1718ZM13.9718 10.073C11.4509 10.2872 9.43489 12.2729 9.26341 14.7106C9.08181 17.2923 10.8126 19.5228 13.4075 20.051C14.2425 20.2209 15.3349 20.1466 16.1395 19.865C17.7286 19.3088 18.9485 18.0549 19.4049 16.5085C19.5569 15.9935 19.6028 15.6644 19.6017 15.0968C19.6001 14.2588 19.4548 13.6381 19.0887 12.9056C18.1387 11.0045 16.1255 9.89008 13.9718 10.073ZM14.0007 12.1187C13.9269 12.1426 13.8287 12.2118 13.7824 12.2725C13.7007 12.3797 13.6979 12.4295 13.6869 13.9631C13.6745 15.6913 13.6804 15.7433 13.904 15.8861C14.0048 15.9505 14.1334 15.9589 15.1836 15.9701C15.8258 15.9769 16.431 15.971 16.5285 15.9569C16.7851 15.92 16.934 15.7644 16.934 15.5333C16.934 15.389 16.9118 15.3355 16.811 15.2374L16.688 15.1177L15.6353 15.1072L14.5825 15.0968L14.5625 13.7273C14.5514 12.974 14.5273 12.328 14.5088 12.2916C14.4297 12.1356 14.1953 12.0558 14.0007 12.1187Z" stroke="white" stroke-width="0.4" mask="url(#path-1-outside-1_1378_43933)" />
            </svg>
            <p><?= $current_language == 'ru' ? 'расписание движения судов' : 'ship schedule' ?></p>
          </a>
        </section>
        <section class="our-assets" id="our-assets">
          <div class="our-assets__title title title--h2"><?= $current_language == 'ru' ? 'Собственный флот' : 'Own fleet' ?></div>
          <div class="our-assets__description"><?= $current_language == 'ru' ? 'Наши перевозки обеспечиваются собственным флотом, что гарантирует высокий уровень контроля и надёжности в каждой доставке.' : '
Our transportation is provided by our own fleet, which guarantees a high level of control and reliability in every delivery.' ?></div>
          <?php $ships = get_posts([
            'post_type' => 'ships',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
          ]);
          ?>
          <div class="our-assets__slider swiper">
            <div class="swiper-wrapper">
              <?php foreach ($ships as $post) : setup_postdata($post);
              ?>
                <a href="<?php the_permalink() ?>" class="swiper-slide">
                  <div class="our-assets__card card card--primary">
                    <picture>
                      <img class="our-assets__card-image" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
                    </picture>
                    <div class="our-assets__card-text">
                      <div class="our-assets__card-name"><?= $current_language == 'ru' ? 'Судно' : 'Vessel' ?></div>
                      <div class="our-assets__card-title title"><?php the_title(); ?></div>
                    </div>
                  </div>
                </a>
              <?php
              endforeach;
              wp_reset_postdata(); ?>
            </div>
          </div>
          <a href="<?= $current_language == 'ru' ? '/activities/' : '/en/actives/' ?>" class="our-assets__button button title title--button">
            <p><?= $current_language == 'ru' ? 'читать подробнее про флот' : 'Read more about the fleet' ?></p>
            <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z" fill="currentColor" />
            </svg>
          </a>
        </section>
        <section class="advantages" id="advantages">
          <?php get_template_part('template-parts/plus') ?>
        </section>

        <?php get_template_part('template-parts/service-list-sea') ?>

        <section class="form-container card card--primary" id="cost-calculation">
          <h2 class="form-container__title title title--h2"><?php esc_html_e('Свяжитесь с нами, чтобы рассчитать точную стоимость', 'necoline'); ?></h2>
          <p class="form-container__text">* <?php esc_html_e('Работаем только с юридическими лицами', 'necoline'); ?></p>
          <?php get_template_part('template-parts/form') ?>
        </section>
      </div>
    </div>
  </div>
</main>

<?php
$ports = get_posts([
  'posts_per_page' => -1,
  'post_type' => 'ports_posts',
]);
foreach ($ports as $port) : setup_postdata($post); ?>
  <div class="c-modal" id="modal-route-<?php echo $port->ID ?>">
    <div class="c-modal__head">
      <picture>
        <img class="c-modal__head-image" src="<?php echo get_the_post_thumbnail_url($port->ID); ?>" alt="<?php //the_title(); 
                                                                                                          ?>" data-pagespeed-url-hash=2026520390 onload="pagespeed.CriticalImages.checkImageForCriticality(this);" data-pagespeed-lsc-url="<?php echo get_the_post_thumbnail_url($port->ID); ?>" />
      </picture>
      <div class="c-modal__head-content">
        <div class="c-modal__title title title--h2"><?php echo $port->post_title; ?></div>
        <div class="c-modal__contacts">
          <div class="c-modal__contacts-item">
            <div class="c-modal__contacts-name"><?= $current_language == 'ru' ? 'Адрес порта' : 'Port address' ?>:</div>
            <div class="c-modal__contacts-value"><?php the_field('port_adress', $port->ID); ?></div>
          </div>
          <div class="c-modal__contacts-item">
            <div class="c-modal__contacts-name"><?= $current_language == 'ru' ? 'Номер для связи' : 'Contact number' ?>:</div>
            <div class="c-modal__contacts-value"><a href="tel:<?php the_field('port_number', $port->ID); ?>"><?php the_field('port_number', $port->ID); ?></a></div>
          </div>
          <div class="c-modal__contacts-item">
            <div class="c-modal__contacts-name">Email:</div>
            <div class="c-modal__contacts-value"><a href="mailto:<?php the_field('port_email', $port->ID); ?>"><?php the_field('port_email', $port->ID); ?></a></div>
          </div>
          <div class="c-modal__contacts-item">
            <div class="c-modal__contacts-name"><?= $current_language == 'ru' ? 'Часовой пояс' : 'Timezone' ?>:</div>
            <div class="c-modal__contacts-value"><?php the_field('port_time', $port->ID); ?></div>
          </div>
        </div>
      </div>
    </div>
    <div class="c-modal__body">
      <div class="c-modal__row">
        <div class="c-modal__lines-travel">
          <div class="c-modal__body-title title"><?= $current_language == 'ru' ? 'Линии следования' : 'Lines of travel' ?></div>
          <div class="c-modal__lines-travel-list">
            <div class="c-modal__lines-travel-label title"><?php $port_direction = get_field('port_direction', $port->ID);
                                                            echo $port_direction->name; ?></div>
            <?php if ($port_services = get_field('port_services', $port->ID)) :
              foreach ($port_services as $post) : setup_postdata($post);
            ?>
                <div class="c-modal__lines-travel-label title"><?php the_title() ?></div>
            <?php endforeach;
              wp_reset_postdata();
            endif;
            ?>
          </div>
        </div>
        <div class="c-modal__lines-travel">
          <?php if (have_rows('port_agents', $port->ID)) : ?>
            <div class="c-modal__body-title title"><?= $current_language == 'ru' ? 'Агент' : 'Agent' ?></div>
            <?php while (have_rows('port_agents', $port->ID)) : the_row(); ?>
              <?php $port_agents = get_sub_field('port_agent', $port->ID); ?>
              <div class="c-modal__contacts">
                <?php if ($port_agents['port_ca_number']) : ?>
                  <div class="c-modal__contacts-item">
                    <div class="c-modal__contacts-name"><?= $current_language == 'ru' ? 'Номер для связи' : 'Contact number' ?>:</div>
                    <div class="c-modal__contacts-value"><a href="tel:<?php echo $port_agents['port_ca_number']; ?>"><?php echo $port_agents['port_ca_number']; ?></a></div>
                  </div>
                <?php endif; ?>
                <?php if ($port_agents['port_ca_email']) : ?>
                  <div class="c-modal__contacts-item">
                    <div class="c-modal__contacts-name">Email:</div>
                    <div class="c-modal__contacts-value"><a href="mailto:<?php echo $port_agents['port_ca_email']; ?>"><?php echo $port_agents['port_ca_email']; ?></a></div>
                  </div>
                <?php endif; ?>
                <?php if ($port_agents['port_ca_name']) : ?>
                  <div class="c-modal__contacts-item">
                    <div class="c-modal__contacts-name"><?= $current_language == 'ru' ? 'Имя' : 'Name' ?>:</div>
                    <div class="c-modal__contacts-value"><?php echo $port_agents['port_ca_name']; ?></div>
                  </div>
                <?php endif; ?>
                <?php if ($port_agents['port_ca_company']) : ?>
                  <div class="c-modal__contacts-item">
                    <div class="c-modal__contacts-name"><?= $current_language == 'ru' ? 'Компания' : 'Company' ?>:</div>
                    <div class="c-modal__contacts-value"><?php echo $port_agents['port_ca_company']; ?></div>
                  </div>
                <?php endif; ?>
                <?php if ($port_agents['port_ca_dops']) : ?>
                  <div class="c-modal__contacts-item">
                    <div class="c-modal__contacts-name"><?= $current_language == 'ru' ? 'Дополнительные контакты' : 'Additional contacts' ?>:</div>
                    <div class="c-modal__contacts-value"><?php echo $port_agents['port_ca_dops']; ?></div>
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>

      </div>
      <button class="c-modal__callback-button button button--dark title title--button c-modal__button" data-src="#request-form">
        <p><?= $current_language == 'ru' ? 'отправить запрос' : 'send a request' ?></p>
        <svg xmlns="http://www.w3.org/2000/svg" width=5 height=10 viewBox="0 0 5 10" fill=none>
          <path fill-rule=evenodd clip-rule=evenodd d="M0 0H2.14286L5 5L2.14286 10H0L2.85714 5L0 0Z" fill=currentColor />
        </svg>
      </button>
    </div>
    <button data-fancybox-close></button>
  </div>
  <?php $i++; ?>
<?php endforeach;
wp_reset_postdata();
?>


<div id=request-form class="c-modal form form-container director-form card card--primary">
  <div class=director-form__container>
    <div class=form__head>
      <div class="form__title title title--h2"><?= $current_language == 'ru' ? 'Отправьте запрос' : 'Send a request' ?></div>
      <p class=form-container__text><?= $current_language == 'ru' ? '* Работаем только с юридическими лицами' : '* We work only with legal entities' ?></p>
    </div>
    <?php
    if ($current_language == 'ru') :
      echo do_shortcode('[contact-form-7 id="a653988" html_class="form__card"]');
    else :
      echo do_shortcode('[contact-form-7 id="4e58213" html_class="form__card"]');
    endif;
    ?>
  </div>
</div>






<?php
get_footer();
