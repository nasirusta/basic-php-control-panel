<div class="panel bilgiler">
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="m-b-30">
					<button id="bilgi-ekle" class="btn btn-default waves-effect waves-light">
						İletişim Bilgisi Ekle <i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table m-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Başlık</th>
						<th>İçerik</th>
						<th>Grup</th>
						<th>Uygula</th>
					</tr>
				</thead>
				<tbody class="uduzen">
					<?php foreach ($this->kayitlar as $index => $value) { ?>
					<tr id="sira-<?=$value["id"];?>" style="cursor:move;background:rgb(255, 255, 255);width:100%;">
						<input name="rec[]" type="hidden" id="rec-<?=$index+1;?>" value="<?=$value["id"];?>" />
						<th scope="row" class="say"><?=$index+1;?></th>
						<td><?=$value["title"];?></td>
						<td><?=$value["content"];?></td>
						<td><?=$this->data_array["grup"][$index]["title"];?></td>
						<td>
							<a href="javascript:void(0)" class="on-default edit-row" id="<?=$index+1;?>">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="javascript:void(0)" class="on-default remove-row" id="<?=$index+1;?>">
								<i class="fa fa-trash-o"></i>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>