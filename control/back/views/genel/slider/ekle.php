<?php
breadcrumb("Slider Ekle", "Slider,");
$this->ekleme_alanlar("ekle", "Slider Ekle", "slider/insert", function($dil){
?>
<div class="form-group">
	<label class="col-md-2 control-label" for="buton">Video / Görsel</label>
	<div class="col-md-10">
		<select class="form-control" name="veri_tipi" id="veri_tipi_<?=$dil;?>">
			<option value="0">Seçiniz</option>
			<option value="1">Görsel - Yazı</option>
			<option value="2">Video</option>
		</select>
	</div>
</div>
<div class="veri-tipi" style="display:none;">
	<div class="form-group">
		<label class="col-md-2 control-label" for="baslik_<?=$dil;?>">Başlık</label>
		<div class="col-md-10">
			<input type="text" name="baslik_<?=$dil;?>" class="form-control" placeholder="Başlık <?=$dil;?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="alt_baslik_<?=$dil;?>">Alt Başlık</label>
		<div class="col-md-10">
			<textarea class="ckeditor" name="alt_baslik_<?=$dil;?>"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="link_<?=$dil;?>">Link</label>
		<div class="col-md-10">
			<input type="text" name="link_<?=$dil;?>" class="form-control" placeholder="Link <?=$dil;?>" />
		</div>
	</div>
</div>
<div class="veri-tipi-2" style="display:none;">
	<div class="form-group">
		<label class="col-md-2 control-label" for="video_<?=$dil;?>">Video</label>
		<div class="col-md-10">
			<textarea class="form-control" rows="6" name="video_<?=$dil;?>"></textarea>
		</div>
	</div>
</div>
<?php }, function(){ ?>
<div class="veri-tipi" style="display:none;">
	<div class="form-group">
		<label class="col-md-2 control-label">Görsel</label>
		<div class="col-md-10">
			<a href="javascript:void(0)" id="myBtn" class="btn btn-primary waves-effect waves-light">
				<span class="btn-label"><i class="fa fa-camera"></i></span>Görselleri Gör
			</a>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-md-10 kapak-gorsel">
			<input name="resim" type="hidden" value="" />
		</div>
	</div>
</div>
<?php
});
$this->add_image('../public/images/uploads/slider/');
?>