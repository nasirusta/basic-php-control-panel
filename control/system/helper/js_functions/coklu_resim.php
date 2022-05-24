<?php
function coklu_resim($par){
if($par["durum"] == "ekle"){
	$kapak_yol = url_b($par["modul"]."/resim-kapak");
	$yukle_yol = url_b($par["modul"]."/coklu-resim-yukle");;
}else{
	$url_get   = explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
	$id_get    = end($url_get);
	$kapak_yol = url_b($par["modul"]."/resim-kapak/".$id_get);
	$yukle_yol = url_b($par["modul"]."/coklu-resim-yukle/".$id_get);
}
?>
<script type="text/javascript">
$(document).ready(function () {
	var modul = "<?=$par["modul"];?>";
	var tablo = "<?=$par["tablo"];?>";
	var alan  = "<?=$par["alan"];?>";

	<?php if($par["durum"] == "ekle"){ ?>
	var submitted = false;
	$("form").submit(function() {
		submitted = true;
	});

	window.onbeforeunload = function () {
		if (!submitted) {
			$.ajax({
				type: "POST",
				data: "modul=" + modul + "&tablo=" + tablo + "&alan=" + alan,
				url: '<?=url_b($par["modul"]."/coklu-resim-control");?>',
				success: function () {

				}
			});
			return "a";
		}
	}
	<?php } ?>

	var date = new Date();
	var date_time = date.getTime();
	$('#file_upload').uploadifive({
		'multi'    : true,
		'auto'     : true,
		'fileSizeLimit' : '8192KB',
		'fileExt'     : '*.jpg;*.jpeg;*.JPG;*.JPEG;*.png;*.PNG',
		'width' : 200,
		'height' : 35,
		'buttonText' : "Bilgisayardan Yükle",
		'formData'         : {'timestamp' : date_time,'token'     : 'saymer'+date_time+'saymer'},
		'uploadScript'     : '<?=url_b($par["modul"]."/add-image/".$par["modul"]);?>',
		'removeCompleted' : true,
		'onUploadComplete' : function(file, data) {
			if(data == '2'){
				alert('Lütfen Geçerli Fortmatta Yükleme Yapınız.');
			}else if(data == '3'){
				alert('İşlem Başarısız.(Dosya Boyutu İle Alakalı Olabilir.)');
			}else{
				$.ajax({
					type: "POST",
					data: "resim=" + data + "&modul=" + modul + "&tablo=" + tablo + "&alan=" + alan,
					url: '<?=$yukle_yol;?>',
					success: function (msg) {
						$('.fotolar').append(msg);
					}
				});
			}
		}
	});

	$(document).on( "click", ".sil", function(){
		var id	   = $(this).attr("id");
		var del_id = id;
		var url    = del_id.replace('.jpg', '').replace('.jpeg', '').replace('.JPG', '').replace('.png', '');

		$.ajax({
		type: 'POST',
		data: 'resim=' + del_id + '&tablo=' + tablo + '&modul=' + modul,
		success: function(){
			$('#img-'+url).fadeOut(750);
		},
		error: function(){
			alert("Hata!");
		},
		url: '<?=url_b($par["modul"]."/resim-sil");?>',
		cache:false
		});
	});

	$(document).on( "click", ".kapak-yap", function(){
		var id_get	 = $(this).attr("id");
		var kap_id   = id_get;
		var img_id   = kap_id.replace('.jpg', '').replace('.jpeg', '').replace('.JPG', '').replace('.png', '');
		var kapak_id = $(this).attr("id");
		$('.nas .main').removeClass('active-kap');
		$('#img-'+img_id+' .main').addClass('active-kap');

		$.ajax({
			type: 'POST',
			data: 'resim=' +kapak_id + '&tablo=' + tablo + "&alan=" + alan + '&modul=' + modul,
			success: function(a){
				alert("Seçilen Resim kapak Görseli Yapıldı.");
			},
			error: function(){
				alert("Hata!");
			},
			url: '<?=$kapak_yol;?>',
			cache:false
		});
	});
});
</script>
<?php } ?>