jQuery('#arealty').on("submit", function (event) {
    event.preventDefault();
    var form = jQuery('#arealty');

    // Сбрасываем значения полей
    jQuery('#arealty input, #arealty textarea').on('blur', function () {
        jQuery.each(request.data, function (key, val) {
            jQuery(key).addClass('text-muted');
            jQuery(key).removeClass('text-danger');
        });
        jQuery('.notification').remove();
        jQuery('#form_submit').val('Отправить');
    });
    let form_val = {
        name_realty: form.find("#name_realty").val(),
        city_rly: form.find("#city_rly").find(":selected").val(),
        address_realty: form.find("#address_realty").val(),
        ss_realty: form.find("#ss_realty").val(),
        price_realty: form.find("#price_realty").val(),
        s_realty: form.find("#s_realty").val(),
        level_realty: form.find("#level_realty").val(),
        text_realty: form.find("#text_realty").val(),
    }

    // Отправка значений полей
    //var options = {
    jQuery.ajax({
        url: ajax_form_object.url,
        data: {
            action: 'ajax_form_action',
            nonce: ajax_form_object.nonce,
            value: form_val
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            // При отправке формы меняем надпись на кнопке
            jQuery('#form_submit').val('Отправляем...');
        },
        success: function (request, xhr, status, error) {

			if (request.success === true) {
                // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
                jQuery('#mess').before('<div class="mt-3 mb-3 text-center text-success notification notification_accept">' + request.data + '</div>').slideDown();
                jQuery('#form_submit').val('Отправить');

            } else {
                // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
                console.log('req data: ', request.data);
                jQuery.each(request.data, function (key, val) {
                    jQuery(key).addClass('text-danger');
                    jQuery(key).removeClass('text-muted');
                    jQuery(key).text(val);
                });
                jQuery('#form_submit').val('Не отправлено');
            }
            // При успешной отправке сбрасываем значения полей
            jQuery('#arealty')[0].reset();
        },
        error: function (request, status, error) {
            jQuery('#form_submit').val('Что-то пошло не так...');
			console.log('err!!!!!!', status, error);
        }
    });
});