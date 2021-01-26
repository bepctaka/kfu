let $path = $(document).find('.search-form').data('path');
let $inputSearch = $(document).find('.search-input');
$inputSearch.keypress(function (e) {
    if (e.which === 13)  // the enter key code
    {
        $.ajax({
            type: "POST",
            url: $path,
            data: {string: $inputSearch.val()},
            success: function (response) {
                let containerAppend = $('.section-news');
                containerAppend.html('');
                containerAppend.html(response.view);
            },
            complete: function () {
                $inputSearch.val('')
            }
        });
    }
});
