<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Ana Ekran</h4>
        <ol class="breadcrumb">
            <li class="active">Ana Ekran</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?=URL;?>/control/users/adduser" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">
                        <i class="md md-add"></i> Üye Ekle
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
						<tr>
							<th>Avatar</th>
							<th>E-Mail</th>
							<th>Yetki</th>
							<th>Kayıt Tarihi</th>
							<th>Sisteme Son Giriş</th>
							<th>Uygula</th>
						</tr>
                    </thead>
                    <tbody>
						<?php foreach ($this->users_list as $index => $value2) { ?>
						<tr class="active">
							<td>
								<?php if($value2["avatar"] != default_avatar){ ?>
									<img src="<?=URL;?>/control/public/images/uploads/<?=$value2["avatar"];?>" class="img-thumbnail thumb-lg" />
								<?php }else{ ?>
									<img src="<?=URL;?>/control/public/images/<?=$value2["avatar"];?>" class="img-thumbnail thumb-lg" />
								<?php } ?>
							</td>
							<td><?=$value2["login"];?></td>
							<td><?=$this->cat[$index]["title"];?></td>
							<td><?=$value2["date"];?></td>
							<td><?=$this->last_loginv[$index]["date"];?></td>
							<td>
								<a href="<?=URL;?>/control/users/userupdate/<?=$value2["id"];?>" class="table-action-btn">
									<i class="md md-edit"></i>
								</a>
								<?php
								if($value2["role"] == 3){
								if($this->admincount > 1){
								?>
								<a href="<?=URL;?>/control/users/delete/<?=$value2["id"];?>" class="table-action-btn"><i class="md md-close"></i></a>
								<?php } }else{ ?>
								<a href="<?=URL;?>/control/users/delete/<?=$value2["id"];?>" class="table-action-btn"><i class="md md-close"></i></a>
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