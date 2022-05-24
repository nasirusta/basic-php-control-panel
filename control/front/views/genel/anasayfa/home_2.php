<div class="latest-blog-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-heading-3">
					<h3>Projeler</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="latest-blog-curosel">
				<?php foreach($projects as $key => $proje){ ?>
				<div class="col-lg-3 col-md-3">
					<div class="project-list">
						<a href="#">
							<div class="img-project">
								<img src="<?=url_f("public/images/".$proje["resim"]);?>" alt="<?=$proje["name"];?>" class="img-responsive">
							</div>
						</a>
						<div class="project-body">
							<a href="#">
								<h1><?=$proje["name"];?></h1>
							</a>
							<p><?=kisalt($proje["content"], 90);?></p>
						</div>
						<div class="project-links">
							<ul>
								<li>
									<a href="#">
										<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> İncele
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-chevron-circle-down" aria-hidden="true"></i> Destekle
									</a>
								</li>
							</ul>
						</div>
						<div class="project-state">
							<div class="col-md-6 col-xs-6">
								<h1>1<?=$key;?>.000 TL</h1>
							</div>
							<div class="col-md-6 col-xs-6">
								<h2 class="text-right">1<?=$key;?> Gün kaldı</h2>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class="progress">
									<div class="progress-bar" role="progressbar" aria-valuenow="7<?=$key;?>" aria-valuemin="0" aria-valuemax="100" style="width:7<?=$key;?>%">
										7<?=$key;?>%
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>