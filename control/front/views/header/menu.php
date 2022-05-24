<div class="mainmenu-area">
	<div class="mainmenu">
		<nav>
			<ul>
				<?php foreach($menu as $url => $value){ ?>
				<li lang="tr" id="<?=$url;?>">
					<a href="<?=url_f($url);?>" title="<?=$value;?>">
						<?=$value;?>
					</a>
				</li>
				<?php } ?>
			</ul>
		</nav>
	</div>
</div>