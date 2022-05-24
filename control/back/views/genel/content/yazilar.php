<?php
breadcrumb_back($this->kategori["baslik"]." Kategorisi Yazıları");
$add = url_b("content/ekle/".$this->kategori["id"]."/".$this->modul);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
			<div class="row">
				<div class="row">
					<div class="col-sm-12">
						<a href="<?=$add;?>" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">
							<i class="md md-add"></i> Yazı Ekle
						</a>
					</div>
				</div>
				<?php
				$this->tablo_liste(function($dil){
					include("tablo.php");
				});
				?>
			</div>
        </div>
    </div>
</div>