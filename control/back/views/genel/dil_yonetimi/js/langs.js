jQuery(document).ready(function ($) {

    $(".uduzen").sortable({
        revert: true,
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');

            $.ajax({
                type: "POST",
                dataType: "json",
                data: data,
				url: genel_link + '/control/dil-yonetimi/sirala',
                success: function (msg) {

                }
            });
        }
    });
    $(".uduzen").disableSelection();

    $(document).on("click", ".lang-del", function () {

        var id_lang = $(this).attr("id");

        $.ajax({
            type: 'POST',
            data: 'id=' + id_lang,
            success: function () {
                $('#lang-' + id_lang).fadeOut(300);
            },
            error: function () {
                alert("omadı");
            },
            url: genel_link + '/control/dil-yonetimi/sil',
            cache: false
        });

    });

});
