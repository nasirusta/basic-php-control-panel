<div class="mail-ayarlari">
	<div class="col-md-8 col-md-offset-2">
		<div class="container">
			<form action="<?=url_b("iletisim-yonetimi/mail-form");?>" method="post" name="mail" class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-md-4 control-label" for="isim">İsim</label>
					<div class="col-md-8">
						<input type="text" name="isim" class="form-control" value="<?=$this->mail_form["isim"];?>" placeholder="Gelen iletideki görüntülenecek ismi yazınız" required="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="mail_adresi">Mail Adresi</label>
					<div class="col-md-8">
						<input type="text" name="mail_adresi" class="form-control" value="<?=$this->mail_form["mail_adresi"];?>" placeholder="İletinin gönderileceği E-Mail adresini yazınız." required="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="sunucu">Mail Sunucusu</label>
					<div class="col-md-8">
						<input type="text" name="sunucu" class="form-control" value="<?=$this->mail_form["sunucu"];?>" placeholder="mail.domain.com" required="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="hesap">Mail Hesabı</label>
					<div class="col-md-8">
						<input type="text" name="hesap" class="form-control" value="<?=$this->mail_form["hesap"];?>" placeholder="info@domain.com" required="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="hesap_sifre">Mail Hesabı Şifresi</label>
					<div class="col-md-8">
						<input type="password" name="hesap_sifre" class="form-control" value="<?=$this->mail_form["hesap_sifre"];?>" placeholder="Mail Hesabı Şifresi" required="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="sifreleme_yontemi">Şifreleme Yöntemi</label>
					<div class="col-md-8">
						<select name="sifreleme_yontemi" class="form-control">
							<option value="tls" <?php if($this->mail_form["sifreleme_yontemi"] == "tls"){echo 'selected';} ?>>TLS</option>
							<option value="ssl" <?php if($this->mail_form["sifreleme_yontemi"] == "ssl"){echo 'selected';} ?>>SSL</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label" for="port">Mail Portu</label>
					<div class="col-md-8">
						<input type="text" name="port" class="form-control" value="<?=$this->mail_form["port"];?>" placeholder="TLS kullanıyorsanız 587, SSL kullanıyorsanız 465" required="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label"></label>
					<div class="col-md-10">
						<button type="submit" class="btn btn-success waves-effect waves-light">
							<span class="btn-label"><i class="fa fa-plus"></i></span>Güncelle
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>