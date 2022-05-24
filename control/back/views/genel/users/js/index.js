$(document).ready(function () {

    $("#add_user").submit(function () {

        if ($("#sifre").val().length !== 0) {
            if ($("#sifre").val() !== $("#sifre_tekrar").val()) {
                $("#sifre-uyari").fadeIn(400);
                return false;
            } else if ($("#sifre").val() <= 5) {
                $("#sifre-uyari2").fadeIn(400);
                return false;
            }
        }

    });

});