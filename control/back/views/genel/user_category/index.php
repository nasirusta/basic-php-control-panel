<?php breadcrumb("Üye Kategorileri"); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?=url_b("user-category/ekle");?>" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">
                        <i class="md md-add"></i> Ekle
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
						<tr>
							<th>ID</th>
							<th>Başlık</th>
							<th>Uygula</th>
						</tr>
                    </thead>
                    <tbody>
						<?php foreach ($this->categorys as $index => $value) { ?>
						<tr>
							<td>#<?=$value["id"];?></td>
							<td><?=$value["title"];?></td>
							<td>
								<a href="<?=url_b("user-category/update/".$value["id"]);?>" class="table-action-btn">
									<i class="md md-edit"></i>
								</a>
								<a href="<?=url_b("user-category/delete/".$value["id"]);?>" class="table-action-btn">
									<i class="md md-close"></i>
								</a>
							</td>
						</tr>
						<?php } ?>
                    </tbody>
                </table>
				<?php $this->pagination("user_category","control/user-category"); ?>
            </div>
        </div>
    </div>
</div>