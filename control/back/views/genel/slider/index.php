<?php breadcrumb("Slider"); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?=url_b("slider/ekle");?>" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">
                        <i class="md md-add"></i> Slider Ekle
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
						<tr>
							<th>Görsel</th>
							<th>Başlık</th>
							<th>Alt Başlık</th>
							<th>Durum</th>
							<th>İçerik Tipi</th>
							<th>Uygula</th>
						</tr>
                    </thead>
                    <tbody class="uduzen">
						<?php
						foreach ($this->slider as $index => $value) {
						$resim = url_f("public/images/uploads/slider/".$value["resim"]);
						?>
						<tr id="sld-<?=$value["id"];?>" style="cursor:move;background:rgb(255, 255, 255);width:100%;">
							<td>
							<?php if(empty($value["video"]) AND !empty($value["resim"])){ ?>
								<img src="<?=$resim;?>" class="img-responsive" style="height:120px;" />
							<?php }else{ ?>
								<iframe height="150" src="https://<?=convertYoutube($value["video"]);?>" frameborder="0" allowfullscreen></iframe>
							<?php } ?>
							</td>
							<td><?=$value["baslik"];?></td>
							<td><?=$value["alt_baslik"];?></td>
							<td>
							<?php if($value["durum"] == 1){ ?>
							<a href="<?=url_b("slider/durum/".$value["id"]);?>" class="btn btn-success waves-effect waves-light">
								Aktif
							</a>
							<?php }else{ ?>
							<a href="<?=url_b("slider/durum/".$value["id"]);?>" class="btn btn-danger waves-effect waves-light">
								Pasif
							</a>
							<?php } ?>
							</td>
							<td>
							<?php if(empty($value["video"]) AND !empty($value["resim"])){ ?>
								Görsel
							<?php }else{ ?>
								Video
							<?php } ?>
							</td>
							<td>
								<a href="<?=url_b("slider/update/".$value["id"]);?>" class="table-action-btn">
									<i class="md md-edit"></i>
								</a>
								<a href="<?=url_b("slider/delete/".$value["id"]);?>" class="table-action-btn">
									<i class="md md-close"></i>
								</a>
							</td>
						</tr>
						<?php } ?>
                    </tbody>
                </table>
				<?php $this->pagination("slider","control/slider"); ?>
            </div>
        </div>
    </div>
</div>