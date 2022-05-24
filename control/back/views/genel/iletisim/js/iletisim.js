$(document).ready(function () {
	var say = $(".bilgiler tbody tr:last-child th:first-child").text();
	var pageURL = $(location).attr("href");
	$(document).on('click', '#bilgi-ekle', function () {
		say++;
		var baslik = '<input name="title" type="text" class="form-control" placeholder="Başlık" required="">';
		var icerik = '<input name="icerik" type="text" class="form-control" placeholder="İçerik" required="">';
		var sil = '<a href="javascript:void(0)" class="on-editing cancel-row"><i class="fa fa-times"></i></a>';
		var kaydet = '<a href="javascript:void(0)" class="on-editing save-row"><i class="fa fa-save"></i></a>';
		var iconlar = kaydet+sil;
		$.ajax({
			type: 'POST',
			data: 'git=a',
			success: function (data) {
				var input = '<tr><th scope="row" class="say">'+say+'</th><td>'+baslik+'</td><td>'+icerik+'</td><td>'+data+'</td><td>'+iconlar+'</td></tr>';
				$('.bilgiler .table-responsive tbody').append(input);
				$(".bilgiler button").attr("id", "");
			},
			error: function () {
				alert("Hata!");
			},
			url: genel_link + '/control/iletisim-yonetimi/get-tur',
			cache: false
		});
	});

	$(document).on('click', '.save-row', function () {
		var title = $("input[name='title']").val();
		var icerik = $("input[name='icerik']").val();
		var type = $(".type").val();
		if(title == '' || icerik == ''){
			alert("Lütfen Boş Alan Bırakmayımız!");
		}else{
			$.ajax({
				type: 'POST',
				data: 'title=' + title + '&icerik=' + icerik + '&type=' + type,
				success: function (data2) {
					$(".bilgiler button").attr("id", "bilgi-ekle");
					if(data2 == 1){
						window.location.href = pageURL;
					}else{
						alert("Bir Hata Oluştu!");
					}
				},
				error: function () {
					alert("Hata!");
				},
				url: genel_link + '/control/iletisim-yonetimi/kaydet',
				cache: false
			});
		}
	});

	$(document).on('click', '.cancel-row', function () {
		$(".bilgiler button").attr("id", "bilgi-ekle");
		$(".bilgiler tbody tr:last-child").remove();
	});

	$(document).on('click', '.edit-row', function () {
		var al_id = $(this).attr("id");
		var get_title = $(".bilgiler #tr-"+al_id+" td:nth-child(2)").text();
		var get_icerik = $(".bilgiler #tr-"+al_id+" td:nth-child(3)").text();
		var baslik_edit = '<input name="title" type="text" class="form-control" value="'+get_title+'" required="">';
		var icerik_edit = '<input name="icerik" type="text" class="form-control" value="'+get_icerik+'" required="">';
		$.ajax({
			type: 'POST',
			data: 'git=a',
			success: function (data3) {
				$(".bilgiler #tr-"+al_id+" td:nth-child(2)").html(baslik_edit);
				$(".bilgiler #tr-"+al_id+" td:nth-child(3)").html(icerik_edit);
				$(".bilgiler #tr-"+al_id+" td:nth-child(4)").html(data3);
				$(".bilgiler tbody tr").attr("id", "");
				$(".bilgiler button").attr("id", "");
			},
			error: function () {
				alert("Hata!");
			},
			url: genel_link + '/control/iletisim-yonetimi/get-tur',
			cache: false
		});

		$(".remove-row").remove();
		$(this).remove();
		$(".bilgiler #tr-"+al_id+" td:nth-child(5)").html('<a href="javascript:void(0)" class="save-row2" id="'+al_id+'"><i class="fa fa-save"></i></a>');
	});

	$(document).on('click', '.save-row2', function () {
		var get_id = $(this).attr("id");
		var title2 = $("input[name='title']").val();
		var icerik2 = $("input[name='icerik']").val();
		var type2 = $(".type").val();
		var get_rec_id = $("#rec-"+get_id).val();
		if(title2 == '' || icerik2 == ''){
			alert("Lütfen Boş Alan Bırakmayımız!");
		}else{
			$.ajax({
				type: 'POST',
				data: 'title=' + title2 + '&icerik=' + icerik2 + '&type=' + type2 + '&rec_id=' + get_rec_id,
				success: function (data4) {
					if(data4 == 1){
						window.location.href = pageURL;
					}else{
						alert("Bir Hata Oluştu!");
					}
				},
				error: function () {
					alert("Hata!");
				},
				url: genel_link + '/control/iletisim-yonetimi/update',
				cache: false
			});
		}
	});

	$(document).on('click', '.remove-row', function () {
		var get_id2 = $(this).attr("id");
		var get_rec_id2 = $("#rec-"+get_id2).val();
		$("#tr-"+get_id2).remove();
		$.ajax({
			type: 'POST',
			data: 'rec_id=' + get_rec_id2,
			success: function (data4) {
				if(data4 == 1){
					window.location.href = pageURL;
				}else{
					alert("Bir Hata Oluştu!");
				}
			},
			error: function () {
				alert("Hata!");
			},
			url: genel_link + '/control/iletisim-yonetimi/sil',
			cache: false
		});
	});

	//--------------------- İLETİŞİM BİLGİLERİ ---------------------

	var say_2 = $(".iletisim-formu tbody tr:last-child th:first-child").text();
	$(document).on('click', '#alan-ekle', function () {
		say_2++;
		var baslik_2 = '<input name="alan_title" type="text" class="form-control" placeholder="Başlık" required="">';
		var disabled = '<input type="text" class="form-control" disabled="" value="">';
		var zorunlu = '<input name="zorunlu" type="checkbox" value="0" />';
		var sil_2 = '<a href="javascript:void(0)" class="cancel-row-form"><i class="fa fa-times"></i></a>';
		var kaydet_2 = '<a href="javascript:void(0)" class="save-row-form"><i class="fa fa-save"></i></a>';
		var iconlar_2 = kaydet_2+sil_2;
		var input_2 = '<tr><th scope="row" class="say">'+say_2+'</th><td>'+baslik_2+'</td><td>'+disabled+'</td><td>'+zorunlu+'</td><td>'+iconlar_2+'</td></tr>';
		$('.iletisim-formu .table-responsive tbody').append(input_2);
		$(".iletisim-formu button").attr("id", "");
	});

	$(document).on('click', '.cancel-row-form', function () {
		$(".iletisim-formu button").attr("id", "alan-ekle");
		$(".iletisim-formu tbody tr:last-child").remove();
	});

	$(document).on('click', '.save-row-form', function () {
		var alan_title = $("input[name='alan_title']").val();
		if ($(':checkbox').is(':checked')) {
			var alan_zorunlu = 1;
		}else{
			var alan_zorunlu = 0;
		}

		if(alan_title == ''){
			alert("Lütfen Boş Alan Bırakmayımız!");
		}else{
			$.ajax({
				type: 'POST',
				data: 'alan_title=' + alan_title + '&alan_zorunlu=' + alan_zorunlu,
				success: function (data_alan) {
					$(".iletisim-formu button").attr("id", "alan-ekle");
					if(data_alan == 1){
						window.location.href = pageURL;
					}else{
						alert("Bir Hata Oluştu!");
					}
				},
				error: function () {
					alert("Hata!");
				},
				url: genel_link + '/control/iletisim-yonetimi/alan-ekle',
				cache: false
			});
		}
	});

	$(document).on('click', '.edit-row-form', function () {
		var al_id_2 = $(this).attr("id");
		var get_title_2 = $(".iletisim-formu #tr-"+al_id_2+" td:nth-child(2)").text();
		var get_alan = $(".iletisim-formu #tr-"+al_id_2+" td:nth-child(4)").text();
		var baslik_edit_2 = '<input name="alan_title" type="text" class="form-control" value="'+get_title_2+'" required="">';

		if(get_alan == "Evet"){
			var zorunlu_edit = '<input name="zorunlu" type="checkbox" value="0" checked="checked" />';
		}else{
			var zorunlu_edit = '<input name="zorunlu" type="checkbox" value="0" />';
		}

		$(".iletisim-formu #tr-"+al_id_2+" td:nth-child(2)").html(baslik_edit_2);
		$(".iletisim-formu #tr-"+al_id_2+" td:nth-child(4)").html(zorunlu_edit);
		$(".iletisim-formu #tr-"+al_id_2+" td:nth-child(5)").html('<a href="javascript:void(0)" class="save-row2-form" id="'+al_id_2+'"><i class="fa fa-save"></i></a>');		
		$(".iletisim-formu button").attr("id", "");
		$(".iletisim-formu tr").attr("id", "");
		$(".remove-row-form").remove();
		$(this).remove();
	});

	$(document).on('click', '.save-row2-form', function () {
		var get_idk = $(this).attr("id");
		var get_rec_idk = $("#alan-rec-"+get_idk).val();

		var alan_titlek = $("input[name='alan_title']").val();
		if ($(':checkbox').is(':checked')) {
			var alan_zorunluk = 1;
		}else{
			var alan_zorunluk = 0;
		}

		if(alan_titlek == ''){
			alert("Lütfen Boş Alan Bırakmayımız!");
		}else{
			$.ajax({
				type: 'POST',
				data: 'alan_title=' + alan_titlek + '&alan_zorunlu=' + alan_zorunluk + '&rec_id=' + get_rec_idk,
				success: function (data_alank) {
					$(".iletisim-formu button").attr("id", "alan-ekle");
					if(data_alank == 1){
						window.location.href = pageURL;
					}else{
						alert("Bir Hata Oluştu!");
					}
				},
				error: function () {
					alert("Hata!");
				},
				url: genel_link + '/control/iletisim-yonetimi/alan-update',
				cache: false
			});
		}
	});

	$(document).on('click', '.remove-row-form', function () {
		var get_id_sil = $(this).attr("id");
		var get_rec_id_sil = $("#alan-rec-"+get_id_sil).val();
		$("#tr-"+get_id_sil).remove();
		$.ajax({
			type: 'POST',
			data: 'rec_id=' + get_rec_id_sil,
			success: function (data_sil) {
				if(data_sil == 1){
					window.location.href = pageURL;
				}else{
					alert("Bir Hata Oluştu!");
				}
			},
			error: function () {
				alert("Hata!");
			},
			url: genel_link + '/control/iletisim-yonetimi/alan-sil',
			cache: false
		});
	});

	//--------------------- İLETİŞİM FORM ALANLARI ---------------------









});










































