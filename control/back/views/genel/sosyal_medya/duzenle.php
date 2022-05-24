<?php breadcrumb("Hesap Düzenle / ".$this->sosyal_medya["title"], "Sosyal Medya,"); ?>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title m-b-30"><b>Hesap Ekle</b></h4>
			<div class="row">
				<form action="<?=url_b("sosyal-medya/updatesave/".$this->sosyal_medya["id"]);?>" method="post" name="kaydet" id="kaydet" class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-md-2 control-label" for="title">Hesap</label>
						<div class="col-md-10">
							<input type="text" name="title" class="form-control" value="<?=$this->sosyal_medya["title"];?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" for="url">Url</label>
						<div class="col-md-10">
							<input type="text" name="url" class="form-control" value="<?=$this->sosyal_medya["url"];?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" for="icon">İkon</label>
						<div class="col-md-10">
							<textarea name="icon" class="form-control" placeholder="İkon"><?=$this->sosyal_medya["icon"];?></textarea>
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