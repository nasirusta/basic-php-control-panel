<div class="table-responsive">
	<table class="table table-hover mails m-0 table table-actions-bar">
		<thead>
			<tr>
				<th>Görsel</th>
				<th>Başlık</th>
				<th>Tarih</th>
				<th>Kategori</th>
				<th>Düzenle</th>
				<th>Sil</th>
			</tr>
		</thead>
		<tbody class="uduzen">
			<?php
			foreach ($this->yazilar[$dil] as $value) {
			$resim  = upload_img("kategoriler/".$value["kategori"]."/".$value["resim"]);
			$update = url_b("content/update/".$value["kategori"]."/".$this->modul."/".$value["id"]);
			$delete = url_b("content/delete/".$value["id"]."/".$value["kategori"]."/".$this->modul);
			?>
			<tr id="sld-<?=$value["id"];?>" style="cursor:move;background:rgb(255, 255, 255);width:100%;">
				<td>
					<?php if(!empty($value["resim"])){ ?>
					<img src="<?=$value["resim"];?>" class="img-responsive" style="height:80px;" />
					<?php }else{ ?>
					Görsel Yok
					<?php } ?>
				</td>
				<td><?=$value["baslik"];?></td>
				<td><?=$value["createdAt"];?></td>
				<td><?=$this->kategori["baslik"];?></td>
				<td style="width:10px;">
					<a href="<?=$update;?>" class="btn btn-warning waves-effect waves-light">
						<i class="md md-edit"></i>
					</a>
				</td>
				<td style="width:10px;">
					<a href="<?=$delete;?>" class="btn btn-danger waves-effect waves-light">
						<i class="md md-close"></i>
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>