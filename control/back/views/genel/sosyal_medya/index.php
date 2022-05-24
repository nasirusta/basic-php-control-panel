<?php breadcrumb("Sosyal Medya"); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?=url_b("sosyal-medya/ekle");?>" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">
                        <i class="md md-add"></i>Hesap Ekle
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
						<tr>
							<th>Hesap</th>
							<th>Url</th>
							<th>İkon</th>
							<th>Uygula</th>
						</tr>
                    </thead>
                    <tbody>
						<?php foreach ($this->sosyal_medya as $index => $value) { ?>
						<tr>
							<td><?=$value["title"];?></td>
							<td><?=$value["url"];?></td>
							<td><?=$value["icon"];?></td>
							<td>
								<a href="<?=url_b("sosyal-medya/update/".$value["id"]);?>" class="table-action-btn">
									<i class="md md-edit"></i>
								</a>
								<a href="<?=url_b("sosyal-medya/delete/".$value["id"]);?>" class="table-action-btn">
									<i class="md md-close"></i>
								</a>
							</td>
						</tr>
						<?php } ?>
                    </tbody>
                </table>
				<?php $this->pagination("sosyal_medya","control/sosyal-medya"); ?>
            </div>
        </div>
    </div>
</div>