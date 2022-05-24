<div class="row">
	<div class="col-sm-12">
		<h4 class="page-title">Dil Ekle</h4>
		<ol class="breadcrumb">
			<li><a href="<?=url_b();?>">Ana Ekran</a></li>
			<li><a href="<?=url_b("dil-yonetimi");?>">Dil Yönetimi</a></li>
			<li class="active">Dil Ekle</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title m-b-30" lang="tr"><b>Dil Ekle</b></h4>
			<div class="row">
				<div class="container">
					<div class="col-md-8 col-md-offset-2">
						<form action="<?=url_b("dil-yonetimi/ekleok");?>" method="post" name="add_dil" class="form-horizontal" role="form">
							<div class="form-group">
								<label class="col-md-2 control-label" lang="tr">Dil Seç</label>
								<div class="col-md-10">
									<select name="language" class="form-control" id="language">
										<?php
										foreach ($this->lang_list as $value) {
										?>
										<option value="<?=$value["id"];?>" <?php if($value["add_id"] == 1){echo "disabled";} ?>><?=$value["lang"];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-10">
									<button type="submit" class="btn btn-success waves-effect waves-light">
										<span class="btn-label"><i class="fa fa-plus"></i></span>Dil Ekle
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