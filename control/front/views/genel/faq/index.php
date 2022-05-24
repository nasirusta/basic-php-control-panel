<?php breadcrumb_front($menu[""], $top_menu["faq"]); ?>
<div class="faq-area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="faq-content">
					<h3 class="faq-title"><?=$this->lang_w["faq"];?></h3>
				</div>
				<div class="faq-accordion">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<?php foreach($data["faq"] as $x => $faq){ ?>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading<?=$faq["id"];?>">
								<h1 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#col<?=$faq["id"];?>" aria-expanded="true" aria-controls="col<?=$faq["id"];?>">
										<?=$faq["baslik"];?>
									</a>
								</h1>
							</div>
							<div id="col<?=$faq["id"];?>" class="panel-collapse collapse <?php if($x == 0){ ?>in<?php } ?>" role="tabpanel" aria-labelledby="heading<?=$faq["id"];?>">
								<div class="panel-body">
									<?=$faq["icerik"];?>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>