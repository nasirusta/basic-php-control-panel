<?php
breadcrumb("Kategori Düzenle / ".$this->data_array["ceviri"][0]["baslik"], "Kategoriler,");
$this->ekleme_alanlar("edit", "Kategori Düzenle", "kategoriler/updatesave/".$this->data_array["ceviri"][0]["id"], function($dil, $x){
?>
<div class="form-group">
	<label class="col-md-2 control-label" for="baslik_<?=$dil;?>">Başlık</label>
	<div class="col-md-10">
		<input type="text" name="baslik_<?=$dil;?>" class="form-control" value="<?=$x["baslik"];?>" />
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
	<input name="resim" type="hidden" value="<?=$this->data_array["ceviri"][0]["resim"];?>" />
	<img src="<?=$this->data_array["ceviri"][0]["resim"];?>" class="img-responsive" />
	</div>
</div>
<?php
});
$this->add_image('../public/images/uploads/kategoriler/'.$this->data_array["ceviri"][0]["id"].'/');
?>