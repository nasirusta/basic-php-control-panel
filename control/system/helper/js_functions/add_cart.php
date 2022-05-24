<?php function add_cart($par){ ?>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sepete Eklendi</h4>
            </div>
            <div class="modal-body">
				<div class="alert alert-success">
					<h5><strong>Ürün Başarıyla Sepete Eklendi.</strong></h5>
				</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$.Cart = {
		remove: function(id){
			var uye_id2 = <?=$par["uye"];?>;
			var session_id2 = '<?=Session::session_id();?>';
			$.ajax({
				type: 'POST',
				data: 'urun_id=' + id + '&uye_id=' + uye_id2 + '&session_id=' + session_id2,
				success: function(return_delete){
					if(return_delete == 1){
						$(".modal-title").text("Sepetten Çıkarıldı");
						$(".modal-body").html('<div class="alert alert-success"><h5><strong>Ürün Başarıyla Sepetten Çıkarıldı.</strong></h5></div>');
					}else{
						$(".modal-title").text("Hata");
						$(".modal-body").html('<div class="alert alert-danger"><h5><strong>Bir hata oluştu</strong></h5></div>');
					}
					$("#myModal").modal('show');
					setTimeout(function(){
						location.reload();
					},1200);
				},
				error: function(){
					alert("Hata!");
				},
				url: '<?=url_f($par["control"]."/delete-cart");?>'
			});
		},

		add: function(id){
			var uye_id = <?=$par["uye"];?>;
			var session_id = '<?=Session::session_id();?>';
			$.ajax({
				type: 'POST',
				data: 'urun_id=' + id + '&uye_id=' + uye_id + '&session_id=' + session_id,
				success: function(return_data){
					if(return_data == 1){
						$(".modal-title").text("Sepete Eklendi");
						$(".modal-body").html('<div class="alert alert-success"><h5><strong>Ürün Başarıyla Sepete Eklendi.</strong></h5></div>');

					}else if(return_data == 0){
						$(".modal-title").text("Ürün Mevcut");
						$(".modal-body").html('<div class="alert alert-danger"><h5><strong>Seçtiğiniz ürün sepetinizde mevcut!</strong></h5></div>');
					}else{
						$(".modal-title").text("Hata");
						$(".modal-body").html('<div class="alert alert-danger"><h5><strong>Bir hata oluştu</strong></h5></div>');
					}
					$("#myModal").modal('show');
					setTimeout(function(){
						location.reload();
					},1600);
				},
				error: function(){
					alert("Hata!");
				},
				url: '<?=url_f($par["control"]."/add-cart");?>'
			});

		}

	}
});
</script>
<?php } ?>