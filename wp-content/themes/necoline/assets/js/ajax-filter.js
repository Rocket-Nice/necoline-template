jQuery(document).ready(function($) {
    $('.fltr-btn').on('click', function() {
        // Проверка, активна ли уже кнопка
        if ($(this).hasClass('toggle-buttons__button--active')) {
            // Если активна, сбрасываем фильтр
            resetFilter();
        } else {
            // Удаление класса активности со всех кнопок
            $('.fltr-btn').removeClass('toggle-buttons__button--active');
            // Добавление класса активности только к кликнутой кнопке
            $(this).addClass('toggle-buttons__button--active');

            var direction = $(this).data('direction');
            var service = $(this).data('service');
            var port = $(this).data('port');

            // Элемент контейнера для ответа
            var $responseContainer = $('#response-container > .container');
            
            $.ajax({
                url: myScriptParams.ajaxurl,
                type: 'POST',
                data: {
                    'action': 'filter_posts',
                    'direction': direction || '',
                    'service': service || '',
                    'port': port || '',
                },
                beforeSend: function() {
                    $responseContainer.html('<div class="loader"></div>');
                },
                success: function (response) {
                    $responseContainer.html(response);
                }
            });
        }
    });

    // Функция сброса фильтра
    function resetFilter() {
        // Удаление класса активности со всех кнопок
        $('.fltr-btn').removeClass('toggle-buttons__button--active');

        // Отправка запроса с пустыми параметрами для сброса фильтра
        var $responseContainer = $('#response-container > .container');
        $.ajax({
            url: myScriptParams.ajaxurl,
            type: 'POST',
            data: {
                'action': 'filter_posts',
            },
            beforeSend: function() {
                $responseContainer.html('<div class="loader"></div>');
            },
            success: function(response) {
                $responseContainer.html(response);
            }
        });
    }
});
