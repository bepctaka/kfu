$(document).ready(function() {
    $('#news_list').on('click', '#btnLoadMore', function(e) {
        $.get($(this).attr('data-upload-url'),{_limit:$(this).attr('load-count')},function (data) {
            $("#news_list").html(data);
        });
    });
});