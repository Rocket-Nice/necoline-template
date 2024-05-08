jQuery(document).ready(function ($) {
    function handlePaginationClick() {
        $('.pagination__list').on('click', '.pagination__link', function (e) {
            e.preventDefault();
            var $button = $(this); // Сохраняем ссылку на текущую кнопку пагинации
            var page = $(this).find('a.page-numbers').attr('href').split('page/')[1];
            page = page.replace('/', ''); // Удаляем слэш в конце значения
            var cat = $('.page-menu__button.active').data('cat');
            var data = {
                action: 'load_posts',
                category: cat,
                page: page
            };
            $.ajax({
                url: ajax_object.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function () {
                    // Показать прелоадер или другой индикатор загрузки
                },
                success: function (response) {
                    if (response.success) {
                        $('.tab.active .news__list').html(response.data.posts);
                        // Обновить пагинацию
                        $('.pagination__list').html(response.data.pagination);
                    } else {
                        // Обработать ошибку
                    }
                }
            });
        });
        $('.page-menu__list').on('click', '.page-menu__button', function () {
            var index = $(this).parent().index();
            $('.tab').removeClass('active').eq(index).addClass('active');
            // Сбросить пагинацию на первую страницу
            $('.pagination__link').removeClass('active');
            $('.pagination__link:first').addClass('active');

            // Обновить содержимое таба с новыми записями
            var cat = $(this).data('cat');
            var data = {
                action: 'load_posts',
                category: cat,
                page: 1 // Первая страница
            };
            $.ajax({
                url: ajax_object.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function () {
                    // Показать прелоадер или другой индикатор загрузки
                },
                success: function (response) {
                    if (response.success) {
                        // Обновить содержимое таба с новыми записями
                        $('.tab.active .news__list').html(response.data.posts);
                        // Обновить пагинацию
                        $('.pagination__list').html(response.data.pagination);
                    } else {
                        // Обработать ошибку
                    }
                }
            });

            // Добавить класс 'active' к текущему элементу .page-menu__button
            $('.page-menu__button').removeClass('active');
            $(this).addClass('active');
        });
    }

    // Инициализировать обработчик события клика на пагинации
    handlePaginationClick();
});