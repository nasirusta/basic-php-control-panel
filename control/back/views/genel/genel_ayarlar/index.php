<?php
breadcrumb("Genel Ayarlar", "");
$this->ekleme_alanlar("edit", "Yazı Ekle", "site/guncelle/1", function($dil, $x){
?>
<div class="form-group">
	<label class="col-md-2 control-label" for="baslik_<?=$dil;?>">Başlık</label>
	<div class="col-md-10">
		<input type="text" name="title_<?=$dil;?>" class="form-control" value="<?=$x["title"];?>" />
	</div>
</div>
<div class="form-group">
	<label class="col-md-2 control-label">Meta Başlık Yazısı</label>
	<div class="col-md-9">
		<input name="meta_title_<?=$dil;?>" maxlength="70" onkeyup="textCounter(this,'counterbaslik',70);" type="text" class="form-control" placeholder="Sayfanın başlığı buradan belirlenir (Max 70 karakter) <?=$dil;?>" value="<?=$x["meta_title"];?>">
	</div>
	<div class="col-md-1">
		<input disabled class="form-control" maxlength="3" size="3" value="70" id="counterbaslik">
	</div>
</div>
<div class="form-group">
	<label class="col-md-2 control-label">Meta Açıklama Yazısı</label>
	<div class="col-md-9">
		<textarea maxlength="160" onkeyup="textCounter(this,'counterdescription',160);" class="form-control" name="meta_desc_<?=$dil;?>" placeholder="Sayfa Açıklama Yazısı (Max 160 karakter) <?=$dil;?>"><?=$x["meta_desc"];?></textarea>
	</div>
	<div class="col-md-1">
		<input disabled class="form-control" maxlength="3" size="3" value="160" id="counterdescription">
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
		<img src="<?=url_f("public/images/uploads/site/".$this->data_array["ceviri"][0]["resim"]);?>" class="img-responsive" />
	</div>
</div>
<?php
});
$this->add_image('../public/images/uploads/site/');
?>