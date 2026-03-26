(function ($) {

    (function ($) {
        $('.item-quantity').on('change', function (e) {

            let id = $(this).data('id');
            let quantity = $(this).val();

            $.ajax({
                url: "/cart/" + id,
                method: 'put',
                data: {
                    quantity: quantity,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    // تحديث سعر المنتج
                    $('.item-subtotal-' + id).text(response.subtotal);

                    // تحديث إجمالي الكارت
                    $('#cart-total').text(response.total);
                }
            });

        });

    })(jQuery);

    // $('.item-quantity').on('change', function (e) {

    //     $.ajax({
    //         url: "/cart/" + $(this).data('id'),
    //         method: 'put',
    //         data: {
    //             quantity: $(this).val(),
    //             _token: $('meta[name="csrf-token"]').attr('content')

    //         },
    //     });

    // });

    $('.remove-item').on('click', function (e) {

        let id = $(this).data('id');
        $.ajax({
            url: "/cart/" + id,
            method: 'delete',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')

            },
            success: response => {
                console.log(response);
                $(`#${id}`).remove();
            }
        });

    });

    $('.add-to-cart').on('click', function (e) {

        $.ajax({
            url: "/cart/",
            method: 'post',
            data: {
                product_id: $(this).data('id'),
                quantity: $(this).data('quantity'),
                _token: $('meta[name="csrf-token"]').attr('content')

            },
            success: response => {
                console.log(response);
                alert('Product added');
            }
        });

    });
})(jQuery);
