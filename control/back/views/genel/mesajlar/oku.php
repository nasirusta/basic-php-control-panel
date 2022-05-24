<?php breadcrumb("Mesaj Oku", "Mesajlar,"); ?>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<div class="row">
				<table class="table table-bordered m-0">
					<thead>
						<tr>
							<th>Mesaj No</th>
							<th>İsim</th>
							<th>Soyisim</th>
							<th>E-Mail</th>
							<th>Konu</th>
							<th>Tarih</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">#<?=$this->mesaj_oku["id"];?></th>
							<td><?=$this->mesaj_oku["isim"];?></td>
							<td><?=$this->mesaj_oku["soyisim"];?></td>
							<td><?=$this->mesaj_oku["mail"];?></td>
							<td><?=$this->mesaj_oku["konu"];?></td>
							<td><?=$this->mesaj_oku["tarih"];?></td>
						</tr>
					</tbody>
				</table>
				<div class="row" style="margin-top:30px;height:auto;">
					<div class="col-xs-2">
						<div class="text-center" style="border-right:1px solid #b7b7b7;">
							<strong>Mesaj :</strong>
						</div>
					</div>
					<div class="col-xs-10">
						<div class="text-left">
							<?=$this->mesaj_oku["mesaj"];?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>