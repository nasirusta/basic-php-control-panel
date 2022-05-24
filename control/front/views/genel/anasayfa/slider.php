<div class="col-md-12">
	<div class="row">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php foreach($data["slider"] as $x => $slider){ ?>
				<li data-target="#myCarousel" data-slide-to="<?=$x;?>" <?php if($x == 0){ ?>class="active"<?php } ?>></li>
				<?php } ?>
			</ol>
			<div class="carousel-inner">
				<?php foreach($data["slider"] as $x => $slider){ ?>
				<div class="item <?php if($x == 0){ ?>active<?php } ?>">
					<img src="<?=upload_img("slider/".$slider["resim"]);?>" alt="<?=$slider["baslik"];?>">
					<?php if(!empty($slider["baslik"])){ ?>
					<div class="carousel-caption">
						<h3><?=$slider["baslik"];?></h3>
						<?php if(!empty($slider["alt_baslik"])){ ?>
						<?=$slider["alt_baslik"];?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>