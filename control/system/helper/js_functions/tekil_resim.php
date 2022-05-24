<?php
function tekil_resim($par){
$foto_path = str_replace("@", "/", $par["yol"]);
?>
<script type="text/javascript">
$(document).ready(function(){

    var modal  		 = document.getElementById('myModal');
    var btn    		 = document.getElementById("myBtn");
    var span   		 = document.getElementsByClassName("close")[0];
    var kapat  		 = document.getElementsByClassName("kapat")[0];
    var vazgec 		 = document.getElementsByClassName("vazgec")[0];
    var window_close = document.getElementsByClassName("pencere-kapat")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    }
    kapat.onclick = function () {
        modal.style.display = "none";
    }
    window_close.onclick = function () {
        modal.style.display = "none";
    }

	$(".butonc").hide();
    $("#buton").change(function(){
		var statut = $(this).val();
		if(statut == 1){
			$(".butonc").show();
		}else{
			$(".butonc").hide();
		}
    });

	$("#gorsel-yap").hide();
	$(".vazgec").hide();

	$(document).on('click', '.resimler img', function () {
		var id = $(this).attr('id');
		$(".goster").html('<span class="goster-id-al" id="'+id+'"></span>');
		$("img").removeClass("aktif-resim");
		$(this).addClass("aktif-resim");
		$("#gorsel-yap").show();
		$(".vazgec").show();
	});

	$(document).on('click', '#gorsel-yap', function () {
		var resim_al = $(".goster-id-al").attr('id');
		$(".kapak-gorsel").html('<input name="resim" type="hidden" value="<?=url_f("public/images/uploads/".$foto_path);?>/'+resim_al+'" />');
		$(".kapak-gorsel").append('<img src="<?=url_f("public/images/uploads/".$foto_path);?>/'+resim_al+'" class="img-responsive" />');
	});

	$(document).on('click', '.vazgec', function () {
		$(".kapak-gorsel input").attr('value', '');
		$(".kapak-gorsel img").remove();
		$(".goster-id-al").attr('id', '');
		$("#gorsel-yap").hide(500);
		$("img").removeClass("aktif-resim");
		$(this).hide(500);
	});

	$(document).on('click', '.resim-sil', function () {
		var id 	   = $(this).attr("id");
		var del_id = id;
		var url    = del_id.replace('.jpg', '').replace('.jpeg', '').replace('.JPG', '').replace('.png', '');

		$.ajax({
			type: 'POST',
			data: 'id='+del_id,
			success: function(){
				$(".kapak-gorsel input").attr('value', '');
				$(".kapak-gorsel img").remove();
				$(".goster-id-al").attr('id', '');
				$("#gorsel-yap").hide(500);
				$(".vazgec").hide(500);
				$('#'+url).fadeOut(750);
			},
			error: function(){
				alert("omadı");
			},
			url: '<?=url_b($par["modul"]."/delete-image/".$par["yol"]);?>',
			cache:false
		});

	});

});

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
	'uploadScript'     : '<?=url_b($par["modul"]."/add-image/".$par["yol"]);?>',
	'removeCompleted' : true,
	'onUploadComplete' : function(file, data) {
		if(data == '2'){
			alert('Lütfen Geçerli Fortmatta Yükleme Yapınız.');
		}else if(data == '3'){
			alert('İşlem Başarısız.(Dosya Boyutu İle Alakalı Olabilir.)');
		}else{
			url = data.replace('.jpg', '').replace('.jpeg', '').replace('.JPG', '').replace('.png', '');
			$('.resimler ul').append('<li id="'+url+'"><div><i class="glyphicon glyphicon-remove resim-sil" id="'+data+'"> </i><img src="<?=url_f("public/images/uploads/".$foto_path);?>/'+data+'" class="img-responsive normal-resim" id="'+data+'" /></div></li>');
		}
	}
});
</script>
<?php } ?>