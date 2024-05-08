jQuery(document).ready(function($) {
    $('.fltr-btn').on('click', function() {
        // Переключение активности кнопки
        //$(this).toggleClass('active');
        // Удаление класса активности со всех кнопок
        $('.fltr-btn').removeClass('toggle-buttons__button--active');
        // Добавление класса активности только к кликнутой кнопке
        $(this).addClass('toggle-buttons__button--active');

        // Сбор всех активных портов
        // var ports = $('.filter-button.active').map(function() {
        //     return $(this).data('port');
        // }).get();


        var direction = $(this).data('direction');
        var service = $(this).data('service');
        var port = $(this).data('port');
        // console.log('Direction:', direction);
        // console.log('Service:', service);
        console.log('Selected ports:', port);

        // Элемент контейнера для ответа
        var $responseContainer = $('#response-container > .container');

        $.ajax({
            url: object_ajax.ajaxurl, // В WordPress это глобальная JS переменная, содержащая URL до файла admin-ajax.php
            type: 'POST',
            data: {
                'action': 'filter_posts',
                'direction': direction || '', // Если direction не определено, отправляем пустую строку
                'service': service || '', // Тоже самое для service
                'port': port || '',
                // 'port': ports.join(','), // Преобразуем массив в строку, используя запятую в качестве разделителя
            },
            beforeSend: function() {
                // Добавление анимации загрузки перед отправкой запроса
                $responseContainer.html('<div class="loader"></div>');
            },
            success: function(response) {
                // Обрабатываем ответ сервера (response)
                $('#response-container > .container').html(response); // Предполагаем, что у вас есть контейнер с id="response-container" для отображения ответа
            }
        });
    });
});