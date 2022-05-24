<div class="about-line">
	<div class="container">
		<div class="home-content-owl">
			<?php
			foreach($data["home"] as $x => $home){
			$fotopath = upload_img("kategoriler/220/".$home["resim"]);
			?>
			<div class="kin-home-content">
				<a href="<?=url_f("article/".$home["url"]);?>" title="<?=$home["baslik"];?>">
					<div class="kin-home-img">
						<img src="<?=$fotopath;?>" alt="<?=$home["baslik"];?>" title="<?=$home["baslik"];?>" />
					</div>
					<div class="kin-home-title">
						<h1><?=$home["baslik"];?></h1>
					</div>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</div>