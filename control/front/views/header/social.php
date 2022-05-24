<div class="header-social">
	<ul>
		<?php foreach($this->sosyal_medya as $sosyal_medya){ ?>
		<li>
			<a href="<?=$sosyal_medya["url"];?>" target="_blank" alt="<?=$sosyal_medya["title"];?>" title="<?=$sosyal_medya["title"];?>">
				<?=$sosyal_medya["icon"];?>
			</a>
		</li>
		<?php } ?>
	</ul>
</div>