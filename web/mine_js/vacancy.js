let closePopup = function () {
    $('.popup-jobs__content').removeClass('is-active__jobs__content');
    $('.popup-jobs').css('visibility', 'hidden');
};
$(document).on('click', '.close', function () {
    closePopup()
});
$(document).submit('#creatSummary', function (e) {
    e.preventDefault();
    let form = $('#creatSummary');
    $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: form.serialize(),
        statusCode: {
            201: function () {
                closePopup()
            },
            400: function (response) {
                let errors = JSON.parse(response.responseText).errors;
                if (errors.hasOwnProperty('email')) {
                    $("input[name='email']").val('');
                }
                $.each(errors, function (name, value) {
                    $("input[name=" + name + "]").attr('placeholder', value[0]);
                    $("input[name=" + name + "]").addClass('error-field');
                });
                if (errors.hasOwnProperty('message')) {
                    $("textarea[name='message']").addClass('error-field');
                    $("textarea[name='message']").attr('placeholder', 'Введите сообщение');
                }
            },
        },
    });
});
$(document).ready(function () {
    $('.vacancy_link').click(function (e) {
        e.preventDefault();
        let popup = $('.popup-jobs');
        $.ajax({
            type: "GET",
            url: $('.creatSummary').data('path'),
            data: {slug: $(this).data('slug')},
            success: function (result) {
                popup.html('');
                popup.html(result.view);
                setTimeout(function () {
                    popup.css('visibility', 'visible');
                    $('.popup-jobs__content').addClass('is-active__jobs__content');
                }, 10);

                let inputPhone = $(document).find('#inputPhone');
                Inputmask({
                    mask: '+\\9\\96(999)999-999',
                    showMaskOnHover: false,
                }).mask(inputPhone)
            }
        });
    })
});