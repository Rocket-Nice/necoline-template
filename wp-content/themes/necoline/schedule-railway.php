<?php
/*
Template Name: Расписание поездов
Template Post Type: page
*/
include(locate_template('header.php'));
$stations = get_posts([
  'post_type'   => 'stations',
  'posts_per_page'   => -1,
  'station_type' => 'stancziya-otpravleniya'
]);
$current_language = pll_current_language();
?>

<main class="main-content">
  <div class="breadcrumbs text">
    <div class="container">
      <ul class="breadcrumbs__list">
        <li class="breadcrumbs__item">
          <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
        </li>
        <li class="breadcrumbs__item"><?= $current_language == 'ru' ? 'Расписание ЖД' : 'Train schedule' ?></li>
      </ul>
    </div>
  </div>
  <section class="head">
    <div class="container">
      <h1 class="head__title title title--h1"><?= $current_language == 'ru' ? 'Расписание движения поездов' : 'Train schedule' ?></h1>
      <?php if (get_field('shedule_title')) : ?><div class="head__subtitle title title--h3"><?php the_field('shedule_title'); ?></div><?php endif; ?>
      <?php if (get_field('shedule_descr')) : ?><div class="head__text"><?php the_field('shedule_descr'); ?></div><?php endif; ?>
    </div>
  </section>
  <section class="search-stations">
    <div class="container">
      <div class="search-stations__card card card--primary">
        <form action="#" class="search-stations__form <?= $current_language ?>">
          <div class="search-stations__title title title--h4"><?= $current_language == 'ru' ? 'Поиск по станциям' : 'Search by station' ?></div>
          <div class="search-stations__row">
            <!-- <div class="search-stations__column">
              <select class="input station_start" name="station_start">
                <?php foreach ($stations as $station) : ?>
                  <option value="<?= $station->ID ?>"><?= $station->post_title ?></option>
                <?php endforeach; ?>
              </select>
            </div> -->
            <div class="search-stations__column">
              <input name="station_end" type="text" class="input" placeholder="<?= $current_language == 'ru' ? 'Станция назначения' : 'Destination station' ?>" />
              <input type="hidden" name="row_index" value="">
              <input type="hidden" name="station_end_id" value="">
            </div>
            <div class="search-stations__column">
              <input name="num" type="text" class="input" placeholder="<?= $current_language == 'ru' ? 'Номер рейса' : 'Flight number' ?>" />
            </div>
            <div class="search-stations__column search-stations__column--button">
              <button class="button button--dark title title--button filter-button" type="submit">
                <span><?= $current_language == 'ru' ? 'Найти' : 'Search' ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00195312 0H2.14481L5.00195 5L2.14481 10H0.00195312L2.8591 5L0.00195312 0Z" fill="currentColor" />
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <section class="section-table">
    <div class="container">
      <div class="table-wrapper">
        <table class="table" data-current-page="1">
          <thead class="table__thead title">
            <tr>
              <th width="110"><?= $current_language == 'ru' ? 'Номер' : 'Number' ?></th>
              <th width="200"><?= $current_language == 'ru' ? 'Дата начала рейса' : 'Flight start date' ?></th>
              <th width="320"><?= $current_language == 'ru' ? 'Станция отправления' : 'Departure station' ?></th>
              <th width="258"><?= $current_language == 'ru' ? 'Станция назначения' : 'Destination station' ?></th>
              <th width="250"><?= $current_language == 'ru' ? 'Станция операции' : 'Operation Station' ?> <br /></th>
              <th width="222"><?= $current_language == 'ru' ? 'Расстояние оставшееся' : 'Distance remaining' ?></th>
            </tr>
          </thead>
          <?php
          if (have_rows('shedule_rows')) :
            $all_rows = get_field('shedule_rows');
            $total_rows = count($all_rows);
            $tbody_count = 4;
            $rows_per_tbody = ceil($total_rows / $tbody_count);


            // Выводим tbody контейнеры
            for ($i = 0; $i < $tbody_count; $i++) {
              echo '<tbody class="table__tbody">';

              // Выводим строки в текущий tbody
              for ($j = 0; $j < $rows_per_tbody; $j++) {
                $index = $i * $rows_per_tbody + $j;

                if ($index >= $total_rows) {
                  break;
                }

                $row = $all_rows[$index];

                echo '<tr>';
                echo '<td class="td__num">' . $row['num'] . '</td>';
                echo '<td>' . $row['data'] . '</td>';
                echo '<td>' . $row['station_start']->post_title . '</td>';
                echo '<td>' . $row['station_end']->post_title . '</td>';
                echo '<td>' . $row['station_operation']->post_title . '</td>';
                echo '<td>' . $row['distance'] . '</td>';
                echo '</tr>';
              }

              echo '</tbody>';
            }
          endif;
          ?>
        </table>
      </div>
      <div class="pagination">
        <ul class="pagination__list">
          <li class="pagination__item">
            <button class="pagination__link pagination__link--left">
              <svg xmlns="http://www.w3.org/2000/svg" width="11" height="16" viewBox="0 0 11 16" fill="none">
                <g clip-path="url(#clip0_1022_199799)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M9 16L8 16L2 8L8 -8.74228e-08L9 0L3 8L9 16Z" fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_1022_199799">
                    <rect width="11" height="16" fill="white" transform="translate(11 16) rotate(-180)" />
                  </clipPath>
                </defs>
              </svg>
            </button>
          </li>
          <div class="pagination__number-item">
          </div>

          <li class="pagination__item">
            <button class="pagination__link pagination__link--right">
              <svg xmlns="http://www.w3.org/2000/svg" width="11" height="16" viewBox="0 0 11 16" fill="none">
                <g clip-path="url(#clip0_1022_199800)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16L3 16L9 8L3 1.74846e-07L2 0L8 8L2 16Z" fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_1022_199800">
                    <rect width="11" height="16" fill="white" transform="matrix(1 1.74846e-07 1.74846e-07 -1 0 16)" />
                  </clipPath>
                </defs>
              </svg>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!--
    <section class="search-container">
      <div class="container">
        <div class="search-container__card card card--primary">
          <form action="#" class="search-container__form">
            <div class="search-container__title title title--h4">Поиск контейнера по пути следования</div>
            <div class="search-container__row">
              <div class="search-container__column">
                <select class="input">
                  <option value="Азия — Дальний Восток">Азия — Дальний Восток</option>
                  <option value="Азия — Дальний Восток">Азия — Дальний Восток</option>
                  <option value="Азия — Дальний Восток">Азия — Дальний Восток</option>
                </select>
              </div>
              <div class="search-container__column">
                <input type="text" class="input" placeholder="Введите номер контейнера" />
              </div>
              <div class="search-container__column search-container__column--button">
                <button class="button button--dark title title--button" type="submit">
                  <span>Найти</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="5" height="10" viewBox="0 0 5 10" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M0.00195312 0H2.14481L5.00195 5L2.14481 10H0.00195312L2.8591 5L0.00195312 0Z"
                      fill="currentColor" />
                  </svg>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
-->
  <section class="form form-container">
    <div class="container">
      <div class="form__head">
        <div class="form__title title title--h4"><?= $current_language == 'ru' ? 'Свяжитесь с нами, чтобы рассчитать точную стоимость' : 'contact us to calculate the exact cost' ?></div>
        <div class="form__subtitle"><?= $current_language == 'ru' ? 'Работаем только с юридическими лицами' : 'We work only with legal entities' ?></div>
      </div>
      <form action="#" class="form__card card card--primary">
        <div class="form__row">
          <div class="form__column">
            <fieldset class="form__fieldset">
              <label class="form__label"><?= $current_language == 'ru' ? 'Эти поля обязательны к заполнению' : 'These fields are required' ?></label>
              <div class="form__grid">
                <div class="form-container__input-container">
                  <input type="text" class="form-container__input input" name="company_name" placeholder="<?= $current_language == 'ru' ? 'Название организации *' : 'Name of organization' ?>" required>
                  <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                </div>

                <div class="form-container__input-container">
                  <input type="text" class="form-container__input input" name="full_name" placeholder="<?= $current_language == 'ru' ? 'ФИО *' : 'Full name' ?>" required>
                  <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                </div>

                <div class="form-container__input-container">
                  <input type="text" class="form-container__input form-container__input--email input" name="company_email" placeholder="<?= $current_language == 'ru' ? 'Email организации *' : "Email of organization *" ?>" required>
                  <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                  <p class="error-text hide format"><?= $current_language == 'ru' ? 'Email должен быть указан в формате
                      example@gmail.com' : 'Email must be in the format
                      example@gmail.com' ?>
                  </p>
                </div>

                <div class="form-container__input-container">
                  <input type="text" class="form-container__input form-container__input--phone input" name="phone" placeholder="<?= $current_language == 'ru' ? 'Телефон *' : 'Phone *' ?>" required>
                  <p class="error-text hide empty"><?= $current_language == 'ru' ? 'Данное поле должно быть заполненым' : 'This field must be filled in' ?></p>
                  <p class="error-text hide format"><?= $current_language == 'ru' ? 'Телефон должен быть указан в формате +7
                      (000)-000-00-00' : 'The phone number must be specified in the format +7
                      (000)-000-00-00' ?>
                  </p>
                </div>
              </div>
            </fieldset>
            <fieldset class="form__fieldset">
              <label class="form__label"><?= $current_language == 'ru' ? 'А эти поля не обязятельны к заполнению, но помогут быстрее ответить на ваш запрос' : 'These fields are not required, but will help us respond to your request faster.' ?></label>
              <div class="form__grid form__grid--only-desktop">
                <select class="input" name="cargo-type" id="">
                  <option value="" selected disabled>
                    <?= $current_language == 'ru' ? 'Укажите типа груза' : 'Specify the type of cargo' ?>
                  </option>
                  <option value="Генеральные">
                    <?= $current_language == 'ru' ? 'Генеральные' : 'General' ?>
                  </option>
                  <option value="Скоропортящиеся">
                    <?= $current_language == 'ru' ? 'Скоропортящиеся' : 'Perishable' ?>
                  </option>
                  <option value="Навалочные/Насыпные">
                    <?= $current_language == 'ru' ? 'Навалочные/Насыпные' : 'Bulk/Bulk' ?>
                  </option>
                  <option value="Опасные">
                    <?= $current_language == 'ru' ? 'Опасные' : 'Dangerous' ?>
                  </option>
                  <option value="Проектные">
                    <?= $current_language == 'ru' ? 'Проектные' : 'Projects' ?>
                  </option>
                </select>
                <div class="field-num">
                  <label class="form__label"><?= $current_language == 'ru' ? 'Количество контейнеров' : 'Number of containers' ?></label>
                  <div class="field-num__wrapper">
                    <button class="field-num__button container-counter__button--minus" type="button">–</button>
                    <input type="number" class="field-num__input input container-counter__input" value="1" />
                    <button class="field-num__button container-counter__button--plus" type="button">+</button>
                  </div>
                </div>
                <select class="input form__input-wide" name="direction-line">
                  <option value="Линия направления" selected disabled><?= $current_language == 'ru' ? 'Сервисы (направления)' : 'Services (directions)' ?></option>
                  <option value="CSEAVS (Азия - ДВ)"><?= $current_language == 'ru' ? 'CSEAVS (Азия - ДВ)' : 'CSEAVS (Asia - Far East)' ?>
                  </option>
                  <option value="ECVDS (Азия - ДВ)"><?= $current_language == 'ru' ? 'ECVDS (Азия - ДВ)' : 'ECVDS (Asia - Far East)' ?>
                  </option>
                  <option value="Russian Express (Азия - Балтика)"><?= $current_language == 'ru' ? 'Russian Express (Азия - Балтика)' : 'Russian Express (Asia - Baltic)' ?>
                  </option>
                </select>
              </div>
            </fieldset>
          </div>
          <div class="form__column form__column--flex">
            <label class="form__label form__label--wide"><?= $current_language == 'ru' ? 'Если есть какая‑то важная информация о грёзе, условиях
                или ваши пожелания о процессе перевозке, напишите их здесь' : ' If there is any important information about your dream, conditions, or your wishes about the transportation process, write them here' ?></label>
            <textarea class="input" placeholder="<?= $current_language == 'ru' ? 'Напишите дополнительную информацию о грузе' : 'Write additional information about the cargo' ?>"></textarea>
            <button class="form__button-submit form-container__button button button--dark title title--button" type="submit"><?= $current_language == 'ru' ? 'Отправить' : 'Send' ?></button>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>

<?php
get_footer();
