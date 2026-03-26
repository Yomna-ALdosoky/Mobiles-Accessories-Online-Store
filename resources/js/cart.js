console.log('cart file loaded');

(function ($) {
    $('.item-quantity').on('change', function (e) {

        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
        });

    });
})(jQuery);
