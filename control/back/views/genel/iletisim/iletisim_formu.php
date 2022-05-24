<div class="panel iletisim-formu">
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="m-b-30">
					<button id="alan-ekle" class="btn btn-default waves-effect waves-light">
						Alan Ekle <i class="fa fa-plus"></i>
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
						<th>Alan</th>
						<th>Zorunlu Alan</th>
						<th>Uygula</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->form_alanlari as $index => $value) { ?>
					<input name="alan_rec[]" type="hidden" id="alan-rec-<?=$index+1;?>" value="<?=$value["id"];?>" />
					<tr id="tr-<?=$index+1;?>">
						<th scope="row" class="say"><?=$index+1;?></th>
						<td><?=$value["title"];?></td>
						<td><input type="text" class="form-control" disabled="" value="<?=$value["title"];?>"></td>
						<td><?=$value["zorunlu"];?></td>
						<td>
							<a href="javascript:void(0)" class="on-default edit-row-form" id="<?=$index+1;?>">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="javascript:void(0)" class="on-default remove-row-form" id="<?=$index+1;?>">
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