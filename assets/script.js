(function ($){
    $(document).ready(function () {
        $('#submit').on('click', function (event){
            event.preventDefault();
            const $form = $(event.target).parent();

            jQuery.ajax({
                url: 'http://localhost:8888/dev.php.com/Basic/ajaxhandler',
                type: 'POST',
                data: {
                    route: $form.attr('action'),
                    data: $form.serialize(),
                    action: $form.find('#action').val()
                },
                success: function (content) {
                    const response = JSON.parse(content);
                    $('#message').html(response.msg);
                }
            });
        });
    })
})(jQuery);
