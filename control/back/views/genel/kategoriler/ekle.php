<?php
breadcrumb("Kategori Ekle", "Kategoriler,");
$this->ekleme_alanlar("ekle", "Slider Ekle", "kategoriler/run", function($dil){
?>
<div class="form-group">
	<label class="col-md-2 control-label" for="baslik_<?=$dil;?>">Başlık</label>
	<div class="col-md-10">
		<input type="text" name="baslik_<?=$dil;?>" class="form-control" placeholder="Başlık <?=$dil;?>" />
	</div>
</div>
<?php }, function(){ ?>
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
<?php
});
$this->add_image('../public/images/uploads/kategoriler/');
?>