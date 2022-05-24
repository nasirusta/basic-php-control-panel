<article class="blog-post-wrapper">
	<h1 class="sample-title"><?=$data["content"]["baslik"];?></h1>
	<div class="post-thumbnail">
		<img src="<?=upload_img("kategoriler/214/".$data["content"]["resim"]);?>" alt="<?=$data["content"]["baslik"];?>" title="<?=$data["content"]["baslik"];?>" />
	</div>
	<div class="post-information">
		<div class="entry-content">
			<?=$data["content"]["icerik"];?>
		</div>
	</div>
</article>
<div class="clear"></div>