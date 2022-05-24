<?php breadcrumb("Düzenle / ".$this->yazi_info["title"], "User Category,"); ?>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title m-b-30"><b>Ekle</b></h4>
			<div class="row">
				<form action="<?=url_b("user-category/updatesave/".$this->yazi_info["id"]);?>" method="post" name="kaydet" id="kaydet" class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-md-2 control-label" for="title">Başlık</label>
						<div class="col-md-10">
							<input type="text" name="title" class="form-control" value="<?=$this->yazi_info["title"];?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-10">
							<button type="submit" class="btn btn-success waves-effect waves-light">
								<span class="btn-label"><i class="fa fa-plus"></i></span> Kaydet
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>