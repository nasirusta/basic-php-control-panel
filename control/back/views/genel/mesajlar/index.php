<?php breadcrumb("Mesajlar"); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
						<tr>
							<th>Mesaj No</th>
							<th>Tarih</th>
							<th>İsim</th>
							<th>Soyisim</th>
							<th>Durum</th>
							<th>Uygula</th>
						</tr>
                    </thead>
                    <tbody class="uduzen">
						<?php foreach ($this->mesajlar as $index => $value) { ?>
						<tr>
							<td><strong>#<?=$value["id"];?></strong></td>
							<td><?=$value["tarih"];?></td>
							<td><?=$value["isim"];?></td>
							<td><?=$value["soyisim"];?></td>
							<td>
							<?php if($value["durum"] == 1){ ?>
							<span class="btn-success" style="padding:5px;">Okundu</span>
							<?php }else{ ?>
							<span class="btn-danger" style="padding:3px 6px;">Okunmadı</span>
							<?php } ?>
							</td>
							<td style="width:140px;">
								<a href="<?=url_b("mesajlar/oku/".$value["id"]);?>" class="btn btn-info btn-custom waves-effect waves-light" style="float:left;margin-right:10px;">
									Oku
								</a>
								<a href="<?=url_b("mesajlar/delete/".$value["id"]);?>" class="btn btn-danger btn-custom waves-effect waves-light" style="float:left;">
									Sil
								</a>
							</td>
						</tr>
						<?php } ?>
                    </tbody>
                </table>
				<?php $this->pagination("iletisim_mesajlar","control/mesajlar"); ?>
            </div>
        </div>
    </div>
</div>