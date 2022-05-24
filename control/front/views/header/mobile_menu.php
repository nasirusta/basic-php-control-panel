<div class="mobile-menu-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="mobile-menu">
					<nav id="dropdown">
						<ul>
							<?php foreach($menu as $urlb => $valueb){ ?>
							<li lang="tr">
								<a href="<?=url_f($urlb);?>" title="<?=$valueb;?>">
									<?=$valueb;?>
								</a>
							</li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>