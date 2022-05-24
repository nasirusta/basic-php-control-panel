<?php
breadcrumb("Slider Düzenle / ".$this->data_array["ceviri"][0]["baslik"], "Slider,");
$this->ekleme_alanlar("edit", "Slider Düzenle", "slider/updatesave/".$this->data_array["ceviri"][0]["id"], function($dil, $x){
?>
<div class="form-group">
	<label class="col-md-2 control-label" for="buton">Video / Görsel</label>
	<div class="col-md-10">
		<select class="form-control" name="veri_tipi" id="veri_tipi_<?=$dil;?>">
			<option value="0" <?php if(empty($this->data_array["ceviri"][0]["video"]) AND empty($this->data_array["ceviri"][0]["resim"])){?>selected="selected"<?php } ?>>Seçiniz</option>
			<option value="1" <?php if(!empty($this->data_array["ceviri"][0]["resim"])){?>selected="selected"<?php } ?>>Görsel - Yazı</option>
			<option value="2" <?php if(!empty($this->data_array["ceviri"][0]["video"])){?>selected="selected"<?php } ?>>Video</option>
		</select>
	</div>
</div>
<div class="veri-tipi" style="display:<?php if(!empty($this->data_array["ceviri"][0]["resim"]) AND empty($this->data_array["ceviri"][0]["video"])){?>block<?php }else{ ?>none<?php } ?>;">
	<div class="form-group">
		<label class="col-md-2 control-label" for="baslik_<?=$dil;?>">Başlık <?=$dil;?></label>
		<div class="col-md-10">
			<input type="text" name="baslik_<?=$dil;?>" class="form-control" value="<?=$x["baslik"];?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="alt_baslik_<?=$dil;?>">Alt Başlık</label>
		<div class="col-md-10">
			<textarea class="ckeditor" name="alt_baslik_<?=$dil;?>"><?=$x["alt_baslik"];?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="link_<?=$dil;?>">Link</label>
		<div class="col-md-10">
			<input type="text" name="link_<?=$dil;?>" class="form-control" value="<?=$x["link"];?>" />
		</div>
	</div>
</div>
<div class="veri-tipi-2" style="display:<?php if(!empty($this->data_array["ceviri"][0]["video"]) AND empty($this->data_array["ceviri"][0]["resim"])){?>block<?php }else{ ?>none<?php } ?>;">
	<div class="form-group">
		<label class="col-md-2 control-label" for="video_<?=$dil;?>">Video</label>
		<div class="col-md-10">
			<textarea class="form-control" rows="6" name="video_<?=$dil;?>"><?=$x["video"];?></textarea>
		</div>
	</div>
</div>
<?php }, function(){ ?>
<div class="veri-tipi" style="display:<?php if(!empty($this->data_array["ceviri"][0]["resim"]) AND empty($this->data_array["ceviri"][0]["video"])){?>block<?php }else{ ?>none<?php } ?>;">
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
			<img src="<?=url_f("public/images/uploads/slider/".$this->data_array["ceviri"][0]["resim"]);?>" class="img-responsive" />
		</div>
	</div>
</div>
<?php
});
$this->add_image('../public/images/uploads/slider/');
?>