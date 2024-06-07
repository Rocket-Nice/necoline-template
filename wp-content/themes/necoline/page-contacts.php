<?php
/*
Template Name: Контакты
Template Post Type: page
*/
include(locate_template('header.php'));
$current_language = pll_current_language();
?>

<main class="main-content">
  <div class="breadcrumbs text">
    <div class="container">
      <ul class="breadcrumbs__list">
        <li class="breadcrumbs__item">
          <a href="/" class="breadcrumbs__link text"><?= $current_language == 'ru' ? 'Главная' : 'Home' ?></a>
        </li>
        <li class="breadcrumbs__item"><?= $current_language == 'ru' ? 'Контакты' : 'Contacts' ?></li>
      </ul>
    </div>
  </div>
  <section class="head">
    <div class="container">
      <h1 class="head__title title title--h1"><?php esc_html_e('Контакты', 'necoline'); ?></h1>
      <div class="head__contacts">
        <div class="head__contacts-left">
          <!-- this  -->
          <?php
          $leftRow = get_field('contacts_repeat_left', '309');
          if ($leftRow) :
            foreach ($leftRow as $item) :
          ?>
              <div class="head__contacts-row">
                <div class="head__contacts-name"><?= $current_language == 'ru' ? $item['contacts_repeat_left_title_ru'] : $item['contacts_repeat_left_title_eng'] ?>:</div>
                <div class="head__contacts-value"><?= $current_language == 'ru' ? $item['contacts_repeat_left_subtitle_ru'] : $item['contacts_repeat_left_subtitle_eng'] ?></div>
              </div>
          <?php endforeach;
          endif; ?>
          <!-- this end -->
        </div>
        <div class="head__contacts-right">
          <!-- this  -->
          <?php
          $rightRow = get_field('contacts_repeat_right', '309');
          if ($rightRow) :
            foreach ($rightRow as $item) :
          ?>
              <div class="head__contacts-row">
                <div class="head__contacts-name"><?= $current_language == 'ru' ? $item['contacts_repeat_right_title_ru'] : $item['contacts_repeat_right_title_eng'] ?>:</div>
                <div class="head__contacts-value"><?= $current_language == 'ru' ? $item['contacts_repeat_right_subtitle_ru'] : $item['contacts_repeat_right_subtitle_eng'] ?></div>
              </div>
          <?php endforeach;
          endif; ?>
          <!-- this end -->
        </div>
      </div>
    </div>
  </section>
  <section class="map">
    <div class="container">
      <div class="map__inner">
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A89f10e461d6c3719449d444fd23934932d7bd41193fc85637b8ff0d9955aa59f&source=constructor" width="100%" height="100%" frameborder="0"></iframe>
      </div>
    </div>
  </section>
  <section class="form form-container">
    <div class="container">
      <div class="form__head">
        <div class="form__title title title--h4"><?= $current_language == 'ru' ? 'Свяжитесь с нами, чтобы рассчитать точную стоимость' : 'Contact us to calculate the exact cost' ?></div>
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
                    <button class="field-num__button" type="button">–</button>
                    <input type="number" class="field-num__input input" value="1" />
                    <button class="field-num__button" type="button">+</button>
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
            <button class="form__button-submit button button--dark title title--button" type="submit"><?= $current_language == 'ru' ? 'Отправить' : 'Send' ?></button>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>

<?php
get_footer();
