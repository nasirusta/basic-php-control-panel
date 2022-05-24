<div class="latest-blog-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-heading-4" style="margin-top:25px;">
					<h3>DUYURULAR</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="latest-blog-curosel">
				<?php foreach($data["haberler"] as $x => $h){ ?>
				<div class="col-lg-3 col-md-3">
					<div class="single-latest-blog">
						<div class="post-thumb">
							<a href="<?=url_f("news/".$h["url"]."-".$h["id"]);?>" title="<?=$h["baslik"];?>">
								<img src="<?=upload_img("kategoriler/216/".$h["resim"]);?>" alt="<?=$h["baslik"];?>" title="<?=$h["baslik"];?>" />
								<span class="moretag"></span>
							</a>
						</div>
						<div class="latest-blog-info">
							<h3>
								<a href="#" title="<?=$h["baslik"];?>">
									<?=$h["baslik"];?>
								</a>
							</h3>
							<div class="post-excerpt">
								<p><?=kisalt(strip_tags($h["icerik"]), 150);?></p>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>