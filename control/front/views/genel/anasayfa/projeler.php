<div class="latest-blog-area">
	<div class="row">
		<div class="col-md-12">
			<?php foreach($projects as $key => $proje){ ?>
				<div class="project-list">
					<div class="col-md-5">
						<div class="row">
							<a href="#">
								<div class="img-project">
									<img src="<?=url_f("public/images/".$proje["resim"]);?>" alt="<?=$proje["name"];?>" class="img-responsive">
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-7">
						<div class="row">
							<div class="project-body">
								<a href="#">
									<h1><?=$proje["name"];?></h1>
								</a>
								<p><?=kisalt($proje["content"], 300);?></p>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>