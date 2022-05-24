<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-t-15">
			<a href="<?=url_b("dil-yonetimi/ekle");?>" class="btn btn-default dropdown-toggle waves-effect waves-light">
				Dil Ekle <span class="m-l-5"><i class="fa fa-plus"></i></span>
			</a>
		</div>
        <h4 class="page-title">Dil Yönetimi</h4>
		<ol class="breadcrumb">
			<li><a href="<?=url_b();?>">Ana Ekran</a></li>
			<li class="active">Dil Yönetimi</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="portlet">
			<div id="portlet2" class="panel-collapse collapse in">
				<div class="portlet-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th># Sıralama</th>
									<th>Dil Kodu</th>
									<th>Görsel</th>
									<th>Dil</th>
									<th>Url</th>
									<th>Kaldır</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($this->added_list as $value) { ?>
								<tr>
									<td><?=$value["sira"];?></td>
									<td><?=$value["code"];?></td>
									<td><img src="<?=url_b("public/images/flags/".$value["flag"]);?>" /></td>
									<td><?=$value["lang"];?></td>
									<td><?=$value["url"];?></td>
									<td>
										<?php if($value["id"] != 1){ ?>
										<a href="javascript:void(0)" class="table-action-btn lang-del" id="<?=$value["id"];?>">
											<i class="md md-close"></i>
										</a>
										<?php } ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>