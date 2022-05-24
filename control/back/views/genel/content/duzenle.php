<?php
$breadcrumb["content/yazilar/".$data["kategori"]["id"]."/".$data["modul"]] = $data["kategori"]["baslik"];
breadcrumb_back($this->data_array["ceviri"][0]["baslik"]." Düzenle", $breadcrumb);
$update = "content/update/".$data["kategori"]["id"]."/".$data["modul"]."/".$data["id"];
$this->ekleme_alanlar("edit", "Yazı Düzenle", $update, function($dil, $x){
?>
<div class="form-group">
	<label class="col-md-2 control-label" for="baslik_<?=$dil;?>">Başlık</label>
	<div class="col-md-10">
		<input type="text" name="baslik_<?=$dil;?>" class="form-control" value="<?=$x["baslik"];?>" />
	</div>
</div>
<div class="form-group">
	<label class="col-md-2 control-label" for="icerik_<?=$dil;?>">İçerik</label>
	<div class="col-md-10">
		<textarea class="ckeditor" name="icerik_<?=$dil;?>"><?=$x["icerik"];?></textarea>
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
$this->add_image('../public/images/uploads/kategoriler/'.$this->data_array["ceviri"][0]["kategori"]);
?>