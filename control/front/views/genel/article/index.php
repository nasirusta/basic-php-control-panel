<?php breadcrumb_front($menu[""], $data["content"]["baslik"]); ?>
<div class="blog-area single-blog">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3">
				<aside class="widget widget-recent">
					<ul>
						<?php
						foreach($data["home"] as $x => $home){
						$fotopath = upload_img("kategoriler/220/".$home["resim"]);
						?>
						<li>
							<div class="post-wrapper">
								<div class="post-sidebar-img">
									<a href="<?=url_f("article/".$home["url"]);?>" title="<?=$home["baslik"];?>">
										<img src="<?=$fotopath;?>" alt="<?=$home["baslik"];?>" title="<?=$home["baslik"];?>" />
									</a>
								</div>
								<div class="post-sidebar-info">
									<h3>
										<a href="<?=url_f("article/".$home["url"]);?>" title="<?=$home["baslik"];?>">
											<?=$home["baslik"];?>
										</a>
									</h3>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</aside>
			</div>
			<div class="col-lg-9 col-md-9">
				<article class="blog-post-wrapper">
					<div class="post-information">
						<h2><?=$data["content"]["baslik"];?></h2>
						<div class="post-thumbnail">
							<img src="<?=upload_img("kategoriler/220/".$data["content"]["resim"]);?>" title="<?=$data["content"]["baslik"];?>" />
						</div>
						<div class="entry-content">
							<?=$data["content"]["icerik"];?>
						</div>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>