(function ($, undefined) {


    $(document).on('click', 'button.btn-generate', function () {
        var generator = $('.generator');
        var form = $(this).closest('form');
        $.ajax({
            type: 'POST',
            url: '/generator',
            data: form.serialize(),
            success: function (response) {
                if (response.status == 1) {
                    $('.help').addClass('hidden')
                    generator.html(response.view)
                } else {
                    Lobibox.notify('error', {
                        msg: response.msg
                    });
                }
            },
            error: function () {
            }

        });
    });

    $(document).on('click', 'button.btn-clear', function () {
        var generator = $('.generator');
        $('.help').removeClass('hidden')
        generator.html('');
    });


})(jQuery);