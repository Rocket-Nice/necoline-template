jQuery(document).ready(function($) {
    var isFilterApplied = false; 
    var previousContent = null; 

    //Автокомплит
    $('input[name="station_end"]').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: ajax_object.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    term: request.term,
                    action: 'search_stations_autocomplete',
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        appendTo: ".search-stations__form",
        select: function(event, ui) {
            event.preventDefault();
            // Если нужно перенаправить пользователя на выбранный пост
            // window.location.href = ui.item.link;
            $(this).val(ui.item.label);
            $(this).data('stationid', ui.item.id);
            
            $('input[name="row_index"]').val(ui.item.row);
            $('input[name="station_end_id"]').val(ui.item.id);
        }
    }).on('input', function() {
        // Это событие сработает каждый раз, когда значение input изменяется
        if (!this.value) {
            // Если значение input пустое, очищаем data-атрибут
            $(this).removeData('stationid');
            $('input[name="station_end_id"]').val('');
        }
    });
    
    //Ajax-фильтр расписания поездов
    $('.search-stations__form').submit(function(e) {
        e.preventDefault();

        var form = $(this);

        if (!isFilterApplied) {
            applyFilter();
        } else {
            clearFilter();
        }

        function applyFilter() {
            var station_start = $('select[name="station_start"]', form).val();
            var station_end = $('input[name="station_end_id"]', form).val();
            var num = $('input[name="num"]', form).val();
            var row_index = $('input[name="row_index"]', form).val();

            if (num) {
                row_index = findRowIndexByNum(num);
            } else {
                row_index = parseInt(row_index);
            }
            function findRowIndexByNum(num) {
                var rowIndex = 0;
                $('.td__num').each(function(index) {
                    if ($(this).html() === num) {
                        rowIndex = index;
                        return false; // Прекратить цикл, если найдено совпадение
                    }
                });
                return rowIndex;
            }
            
            console.log(ajax_object.ajaxurl);
            $.ajax({
                url : ajax_object.ajaxurl,
                type : 'POST',
                data : {
                    action : 'filter_stations',
                    station_start : station_start,
                    station_end : station_end,
                    num : num,
                    row_index : row_index
                },
                beforeSend: function() {
                    previousContent = $('.table-wrapper').html();
                    $('.table-wrapper').html('<div class="loader"></div>');
                },
                success: function (response) {
                    console.log(response);
                    $('.table-wrapper').html(response);
                    isFilterApplied = true;
                    $('.filter-button').text($('.search-stations__form').hasClass('ru') ? 'Сбросить фильтр' : 'Reset filter');
                }
            });
        }
        function clearFilter() {
            var form = $('.search-stations__form');
            $('input[name="station_end"]', form).val('');
            $('input[name="station_end_id"]', form).val('');
            $('input[name="num"]', form).val('');
            $('input[name="row_index"]', form).val('0');
            $('.table-wrapper').html(previousContent);
            isFilterApplied = false;
            $('.filter-button').text($('.search-stations__form').hasClass('ru') ? 'Найти' : 'Search');
        }
    });


});