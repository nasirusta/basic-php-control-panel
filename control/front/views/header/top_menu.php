<div class="header-top-left">
	<div class="top--left-menu">
		<ul>
			<?php foreach($top_menu as $top_url => $value2){ ?>
			<li>
				<a href="<?=url_f($top_url);?>" title="<?=$value2;?>">
					<?=$value2;?>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>