<div class="newsletter footer-menu">
	<h3 class="widget-title">E-Mail Aboneliği</h3>
	<p>Duyuru haber ve bilgilenme için mail abonemiz olun.</p>
	<form action="#">
		<div class="stay-us">
			<input type="text" placeholder="E-Mail Adresiniz">
			<button type="submit"><i class="fa fa-chevron-right"></i></button>
		</div>
	</form>
	<div class="footer-icons">
		<?php foreach($this->sosyal_medya as $sosyal_medya){ ?>
		<a href="<?=$sosyal_medya["url"];?>" target="_blank" data-toggle="tooltip" title="<?=$sosyal_medya["title"];?>" data-original-title="<?=$sosyal_medya["title"];?>">
			<?=$sosyal_medya["icon"];?>
		</a>
		<?php } ?>
	</div>
</div>