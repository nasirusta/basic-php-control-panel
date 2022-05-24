$(document).ready(function () {
	var pageURL = $(location).attr("href");

    $.extend(true, $.fn.dataTable.defaults, {
        "order": [[1, "desc"]],
        "pageLength": 5,
        "lengthChange": false,
        "searching": false,
        "info": false
    });

    $('.DATAtable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json"
        }
    });
    $('.dataTables_length').addClass('bs-select');

	// Dizin Oluştur Modal -->
    var modal = document.getElementById('myModal');
    var dizin_olustur = document.getElementById("dizin-olustur");
    var kapat = document.getElementsByClassName("kapat")[0];

    dizin_olustur.onclick = function () {
        modal.style.display = "block";
    }
    kapat.onclick = function () {
        modal.style.display = "none";
    }
	// Dizin Oluştur Modal !-->

	// Dosya Yükle Modal -->
	$("#durum").hide();
	$("#files-upload-buton").hide();
	$(document).on('click', '#yukle', function () {
		$("#dosya-ekle").css("display", "block");
    });
	$(document).on('click', '.yukle-kapat', function () {
		$("#dosya-ekle").css("display", "none");
		$("#durum").hide();
		$("#files-upload-buton").hide();
		$('#upbtn').val("");
		window.location.href = pageURL;
    });
	$(document).on('click', '#upbtn', function () {
		$("#files-upload-buton").show();
    });
	$(document).on('click', '#files-upload-buton', function () {
		var imgVal = $('#upbtn').val();
        if(imgVal=='') {
            alert("Lütfen bir dosya seçiniz!");
        }else{
			$("#durum").show();
		}
    });
	// Dosya Yükle Modal !-->

	// Taşı Modal -->
	$(document).on('click', '#tasi', function () {
		if ($(':checkbox').is(':checked')) {
			$("#dosya-tasi").css("display", "block");
			$(":checkbox:checked").map(function() {
				var val_get = $(this).val();
				$(".tasima-liste").append('<input name="tasinacak[]" type="hidden" value="'+val_get+'" />');
			}).get();
		}else{
			alert("Lütfen Bir Dizin Seçiniz!");
		}
    });
	$(document).on('click', '.tasi-kapat', function () {
		$("#dosya-tasi").css("display", "none");
		window.location.href = pageURL;
    });

	$(document).on('click', '.hasFiles >div', function () {
		$(this).next('ul').toggle(300);
		$('i .glyphicon').removeClass('glyphicon-triangle-bottom');
		$('.glyphicon-triangle-bottom', this).toggleClass('glyphicon-triangle-left');
    });

	$(document).on('click', '#dosya-gonder', function () {
		var radioValue = $("input[name='dizin']:checked").val()
		var values 	   = $("input[name='tasinacak[]']").map(function(){return $(this).val();}).get();

        $.ajax({
            type: 'POST',
            data: 'dizin=' + radioValue + '&secilen=' + values,
            success: function (e) {
				alert(e);
            },
            error: function () {
                alert("Hata!");
            },
            url: genel_link + '/control/dosya-yonetimi/tasima',
            cache: false
        });
    });
	// Taşı Modal !-->

	// Yeniden Adlandır Modal -->
	$(document).on('click', '#yeniden-adlandir', function () {
		if ($(':checkbox').is(':checked')) {
			$("#dosya-yeniden-adlandir").css("display", "block");
			$(":checkbox:checked").map(function() {
				var val_get2 = $(this).val();
				var array    = val_get2.split('/');
				var lastEl   = array[array.length-1];
				$(".rename").append('<input name="rename[]" class="form-control" type="text" value="'+lastEl+'" required />');
				$(".rename").append('<input name="rename_full[]" type="hidden" value="'+val_get2+'" />');
			}).get();
		}else{
			alert("Lütfen Bir Dizin veya Dosya Seçiniz!");
		}
    });
	$(document).on('click', '#rename-Kaydet', function () {
		var rename_full = $("input[name='rename_full[]']").map(function(){return $(this).val();}).get();
		var rename	    = $("input[name='rename[]']").map(function(){return $(this).val();}).get();
        $.ajax({
            type: 'POST',
            data: 'rename_full=' + rename_full + '&rename=' + rename,
            success: function (data) {
				window.location.href = pageURL;
            },
            error: function () {
                alert("Hata!");
            },
            url: genel_link + '/control/dosya-yonetimi/yeniden-adlandir',
            cache: false
        });
    });
	$(document).on('click', '.yeniden_adlandir-kapat', function () {
		$("#dosya-yeniden-adlandir").css("display", "none");
    });
	// Yeniden Adlandır Modal !-->

	// Zip -->
	$(document).on('click', '#zip', function () {
		if ($(':checkbox').is(':checked')) {
			var get_zip = $(":checkbox:checked").map(function(){return $(this).val();}).get();
			$.ajax({
				type: 'POST',
				data: 'get_zip=' + get_zip,
				success: function (data2) {
					window.location.href = pageURL;
				},
				error: function () {
					alert("Hata!");
				},
				url: genel_link + '/control/dosya-yonetimi/ziple',
				cache: false
			});
		}else{
			alert("Lütfen Bir Dizin Seçiniz!");
		}
    });
	// Zip !-->

	// Sil -->
	$(document).on('click', '#sil', function () {
		if ($(':checkbox').is(':checked')) {
			var get_sil = $(":checkbox:checked").map(function(){return $(this).val();}).get();
			$.ajax({
				type: 'POST',
				data: 'get_sil=' + get_sil,
				success: function (sil) {
					window.location.href = pageURL;
				},
				error: function () {
					alert("Hata!");
				},
				url: genel_link + '/control/dosya-yonetimi/sil',
				cache: false
			});
		}else{
			alert("Lütfen Bir Dizin Seçiniz!");
		}
    });
	// Sil !-->

	// Dizin Oluşturma -->
	$(document).on('click', '#Kaydet', function () {
        var dir_value = $("#dir").val();
        var up_root   = $("#up_root").val();
        $.ajax({
            type: 'POST',
            data: 'dir=' + dir_value + '&up_root=' + up_root,
            success: function (veri) {
				if(veri == 1){
					window.location.href = pageURL;
					modal.style.display = "none";
				}else{
					alert("Bu isimde bir klasör zaten var!");
				}
            },
            error: function () {
                alert("Hata!");
            },
            url: genel_link + '/control/dosya-yonetimi/makedir',
            cache: false
        });
    });
	// Dizin Oluşturma !-->

	// Dosya Yükleme -->
	(function() {
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		$('form').ajaxForm({
			beforeSend: function() {
				status.empty();
				var percentVal = '0%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			success: function() {
				var percentVal = '100%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			complete: function(xhr) {
				status.html(xhr.responseText);
			}
		});
	})();
	// Dosya Yükleme !-->
});