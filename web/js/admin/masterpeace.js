$(function () {
    var createForm = function (action, data) {
        var $form = $('<form action="' + action + '" method="POST"></form>');
        for (input in data) {
            if (data.hasOwnProperty(input)) {
                $form.append('<input name="' + input + '" value="' + data[input] + '">');
            }
        }

        return $form;
    };

    $(document).on('click', 'a[data-delete-token]', function (e) {
        e.preventDefault();
        var $this = $(this);
        swal({
            title: translations.title,
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: translations.confirmButtonText,
            cancelButtonText: translations.cancelButtonText
        }).then(function () {
            swal(
                translations.deleted,
                translations.deletedText,
                'success'
            );
            setTimeout(function () {
                var $form = createForm($this.attr('href'), {
                    token: $this.attr('data-delete-token'),
                    _method: 'DELETE'
                }).hide();
                $('body').append($form);
                $form.submit();
            }, 1000);
        })
    });
});
