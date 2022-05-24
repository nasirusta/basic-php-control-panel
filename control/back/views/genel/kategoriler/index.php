<?php function kategori($data, $parent = 0){ ?>
	<ol class="dd-list">
		<?php
		foreach($data as $key => $item){
		if($item["parent"] == $parent){
		$id		  = $item["id"];
		$label    = $item["baslik"];
		$sil_link = url_b("kategoriler/delete/".$id);
		?>
		<li class="dd-item dd3-item" data-id="<?=$id;?>" >
			<div class="dd-handle dd3-handle">Drag</div>
			<div class="dd3-content">
				<span id="label_show<?=$id;?>"><?=$label;?></span> 
				<span class="span-right">
					<a href="<?=url_b("kategoriler/update/".$id);?>" class="edit-button">
						<i class="md md-edit"></i>
					</a>
					<a href="<?=$sil_link;?>" class="delete-button">
						<i class="fa fa-trash"></i>
					</a>
				</span> 
			</div>
			<?php kategori($data, $id); ?>
		</li>
		<?php } } ?>
	</ol>
<?php
}
breadcrumb("Kategoriler");
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?=url_b("kategoriler/ekle");?>" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">
                        <i class="md md-add"></i> İçerik Ekle
                    </a>
                </div>
            </div>
			<div class="kategori-liste">
				<div class="custom-dd dd" id="nestable_list_2">
					<?php if(isset($this->data_list)){ kategori($this->data_list); } ?>
				</div>
			</div>
        </div>
    </div>
</div>