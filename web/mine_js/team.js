$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: $('.get_coaches').data('path'),
        success: function(result){
            $('.dynamic-content').html('')
            $('.dynamic-content').html(result.view)
        }
    });
    $('.command-sections a').on('click',function (e) {
        e.preventDefault();
        $('.command-sections .command-sections__section').removeClass('u-active');
        $('.command-sections a').css('color', 'black');
        $(this).closest('.command-sections__section').addClass('u-active');
        $(this).css('color', 'white');

        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function(result){
                $('.dynamic-content').html('')
                $('.dynamic-content').html(result.view)
            }
        });

    });

});
$(document).on('click', '.position-filter__section a', function (e) {
    e.preventDefault();
    let dynamicContent = $('.dynamic-content');
    let path = $(this).attr('href');
    $.ajax({
        type: "GET",
        url: path,
        success: function(result){
            dynamicContent.html('');
            dynamicContent.html(result.view);
            $('.position-filter__section').removeClass('u-active');
            $('.position-filter__section a').css('color', 'black');
            let activeTab = $( "a[href$=\""+path+"\"]");
            activeTab.closest('.position-filter__section').addClass('u-active');
            activeTab.css('color', 'white');
        }
    });
});