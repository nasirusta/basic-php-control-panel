<?php breadcrumb_front($menu[""], $menu["our-news"]); ?>
<div class="blog-area single-blog sample-page">
	<div class="container">
		<div class="row">
			<?php
			foreach($data["haberler"] as $x => $h){
			$datex  = explode(":",$h["tarih"]);
			$tarih  = mb_substr($datex[0], 0, 10, 'UTF-8');
			?>
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
						<div class="post-meta">
							<span class="entry-date">
								<i class="fa fa-calendar"></i> <?=$tarih;?>
							</span>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>