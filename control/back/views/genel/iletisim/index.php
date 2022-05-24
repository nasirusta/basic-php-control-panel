<div class="row">
	<div class="col-sm-12">
        <h4 class="page-title">İletişim Yönetimi</h4>
		<ol class="breadcrumb">
			<li><a href="<?=url_b();?>">Ana Ekran</a></li>
			<li class="active">İletişim Yönetimi</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<ul class="nav nav-tabs navtab-bg nav-justified">
			<li class="active">
				<a href="#home1" data-toggle="tab" aria-expanded="false">
					<span lang="tr">İletişim Bilgileri</span>
				</a>
			</li>
			<li class="">
				<a href="#profile1" data-toggle="tab" aria-expanded="true">
					<span lang="tr">İletişim Formu</span>
				</a>
			</li>
			<li class="">
				<a href="#messages1" data-toggle="tab" aria-expanded="false">
					<span lang="tr">Mail Ayarları</span>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="home1">
				<?php include_once("iletisim_bilgileri.php"); ?>
			</div>
			<div class="tab-pane" id="profile1">
				<?php include_once("iletisim_formu.php"); ?>
			</div>
			<div class="tab-pane" id="messages1">
				<?php include_once("mail_ayarlari.php"); ?>
			</div>
		</div>
	</div>
</div>