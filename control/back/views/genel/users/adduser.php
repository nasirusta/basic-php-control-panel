<div class="row">
	<div class="col-sm-12">
		<h4 class="page-title">Üye Ekle</h4>
		<ol class="breadcrumb">
			<li><a href="<?=URL;?>/control">Ana Ekran</a></li>
			<li class="active">Üye Ekle</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title m-b-30"><b>Üye Ekle</b></h4>
			<div class="row">
				<div class="container">
					<div class="col-md-8 col-md-offset-2">
						<form action="<?=URL;?>/control/users/adduserok" method="post" enctype="multipart/form-data" name="add_user" class="form-horizontal" id="add_user" role="form">
							<div class="form-group" id="sifre-uyari" style="display:none;">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-10">
									<div class="alert alert-danger">
										<strong>Uyarı!</strong> İki şifre uyuşmuyor. Lütfen tekrar deneyiniz!
									</div>
								</div>
							</div>
							<div class="form-group" id="sifre-uyari2" style="display:none;">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-10">
									<div class="alert alert-danger">
										<strong>Uyarı!</strong> Şifre en az 6 karakter olmalıdır!
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label" for="example-email">E-Mail</label>
								<div class="col-md-10">
									<input type="mail" id="example-email" name="mail" class="form-control" placeholder="E-Mail" required="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Şifre</label>
								<div class="col-md-10">
									<input type="password" class="form-control" name="sifre" id="sifre" placeholder="Şifre" required="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Şifre Tekrar</label>
								<div class="col-md-10">
									<input type="password" class="form-control" name="sifre_tekrar" id="sifre_tekrar" placeholder="Şifre Tekrar" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Yetki</label>
								<div class="col-md-10">
									<select class="form-control" name="yetki" id="yetki">
										<?php foreach ($this->user_cat_liste as $value) { ?>
										<option value="<?=$value["id"];?>"><?=$value["title"];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Avatar</label>
								<div class="col-md-10">
									<input class="form-control" type="file" name="avatar" id="avatar" multiple="multiple" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-10">
									<button type="submit" class="btn btn-success waves-effect waves-light">
										<span class="btn-label"><i class="fa fa-plus"></i></span>Kaydet
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>