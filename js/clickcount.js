/** js/clickcount.js */

jQuery(document).ready(function ($) {
    $('body').on('click', 'a', function (event) {
        event.preventDefault();
        var link = $(this).attr('href');
        $.post(AjaxParams.adminAjaxUrl,
            {
                action: 'kfp-click-link',
                link: link,
                nonce: AjaxParams.nonce
            },
            function (response) {
                document.location.href = response;
            });
        return false;
    });
});