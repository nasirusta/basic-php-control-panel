<div class="home-network">
	<div class="typewrite">
		Kurdish Information & activity network
	</div>
	<div class="home-posts">
		<div class="container">
			<div class="home-page-about">
				<?php
				foreach($data["about_us"] as $x => $about_us){
				$fotopath = upload_img("kategoriler/214/".$about_us["resim"]);
				?>
				<div class="col-md-12">
					<div class="about-item">
						<div class="image">
							<a href="<?=url_f("article/".$about_us["url"]);?>" title="<?=$about_us["baslik"];?>">
								<img src="<?=$fotopath;?>" alt="<?=$about_us["baslik"];?>" title="<?=$about_us["baslik"];?>" />
							</a>
						</div>
						<div class="title">
							<a href="<?=url_f("article/".$about_us["url"]);?>" title="<?=$about_us["baslik"];?>">
								<h1><?=$about_us["baslik"];?></h1>
							</a>
						</div>
						<div class="desc">
							<p><?=kisalt(strip_tags($about_us["icerik"]), 220);?></p>
						</div>
						<div class="read-more">
							<a href="<?=url_f("article/".$about_us["url"]);?>" title="<?=$about_us["baslik"];?>">
								Devamını oku...
							</a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>