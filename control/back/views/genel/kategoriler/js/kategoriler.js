jQuery(document).ready(function ($) {

    $('.dd').on('change', function () {
        var obj = $('.dd').nestable('serialize');
        var tmp = JSON.stringify(obj);

        $.ajax({
            type: "POST",
            url: "kategoriler/sirala",
            data: "tmp=" + tmp,
            success: function (msg) {}
        });
    });


});
