<?php
$breadcrumb["content/yazilar/".$data["kategori"]["id"]."/".$data["modul"]] = $data["kategori"]["baslik"]." Kategorisi Yazıları";
breadcrumb_back("Yazı Ekle", $breadcrumb);
$this->kategori = $data["kategori"]["id"];
$add = "content/ekle/".$data["kategori"]["id"]."/".$data["modul"];
$this->ekleme_alanlar("ekle", "Yazı Ekle", $add, function($dil){
?>
<div class="form-group">
	<label class="col-md-2 control-label" for="baslik_<?=$dil;?>">Başlık</label>
	<div class="col-md-10">
		<input type="text" name="baslik_<?=$dil;?>" class="form-control" placeholder="Başlık <?=$dil;?>" />
	</div>
</div>
<div class="form-group">
	<label class="col-md-2 control-label" for="icerik_<?=$dil;?>">İçerik</label>
	<div class="col-md-10">
		<textarea class="ckeditor" name="icerik_<?=$dil;?>"></textarea>
	</div>
</div>
<?php }, function(){ ?>
<input name="kategori" type="hidden" value="<?=$this->kategori;?>" />
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