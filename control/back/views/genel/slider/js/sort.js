jQuery(document).ready(function($){
    $(".uduzen").sortable({
        revert: true,
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
                type: "POST",
                dataType: "json",
                data: data,
				url: genel_link + '/control/slider/sirala',
                success: function(msg){

                }
            });
        }
    });
    $(".uduzen").disableSelection();

	$("#veri_tipi_tr,#veri_tipi_en").change(function(){
		var valuex = this.value;
		if(valuex == 1){
			$(".veri-tipi").show();
		}else if(valuex == 2){
			$(".veri-tipi").hide();
			$(".veri-tipi-2").show();
		}else{
			$(".veri-tipi").hide();
			$(".veri-tipi-2").hide();
		}
	});
});