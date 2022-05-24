<aside class="widget widget-categories">
	<h3 class="sidebar-title"><?=$menu["about-us"];?></h3>
	<ul class="sidebar-menu">
		<?php foreach($data["about_us"] as $x => $about_us){ ?>
		<li>
			<a href="<?=url_f("about-us/".$about_us["url"]."-".$about_us["id"]);?>" title="<?=$about_us["baslik"];?>" alt="<?=$about_us["baslik"];?>">
				<?=$about_us["baslik"];?>
			</a>
		</li>
		<?php } ?>
	</ul>
</aside>