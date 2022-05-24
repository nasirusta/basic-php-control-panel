jQuery(document).ready(function($){
    $(".uduzen").sortable({
        revert: true,
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
                type: "POST",
                dataType: "json",
                data: data,
				url: genel_link + '/control/iletisim-yonetimi/sirala',
                success: function(msg){

                }
            });
        }
    });
    $(".uduzen").disableSelection();

});