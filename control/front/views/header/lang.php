<div class="select-language-pick">
	<div class="dropdown">
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
			<?=$this->active_lang["lang"];?> <span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<?php foreach($this->lang_list as $langs){ ?>
			<li>
				<a href="<?=url_f("lang/".$langs["url"]);?>" title="<?=$langs["lang"];?>" alt="<?=$langs["lang"];?>">
					<?=$langs["lang"];?>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>