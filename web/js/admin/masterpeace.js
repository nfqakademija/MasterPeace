$(function () {
    $("a.confirmDelete").click(function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: translations.title,
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: translations.confirmButtonText,
            cancelButtonText: translations.cancelButtonText,
            closeOnConfirm: true
        }).then(function () {
            swal(
                translations.deleted,
                translations.deletedText,
                'success'
            );
            setTimeout(function() {
                window.location.href = href;
            }, 1000);
        })
    });
});
