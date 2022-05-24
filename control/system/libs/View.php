<?php

class view {

    function __construct() {
        //echo 'This is the view <br />';
    }

    public function render($yuz, $name, $noInclude = FALSE, $data = FALSE) {
        if ($data == TRUE) {
			extract($data);
        }

        if ($noInclude == TRUE) {
            require $yuz . 'views/' . $name . '.php';
        } else {
            require $yuz . 'views/header/header.php';
            require $yuz . 'views/' . $name . '.php';
            require $yuz . 'views/footer/footer.php';
        }
    }

    public function front_render_genel($dosya, $inc = FALSE, $data = FALSE) {
        $this->render("control/front/", "genel/" . $dosya, $inc, $data);
    }

    public function front_render_ozel($dosya2, $inc2 = FALSE, $data = FALSE) {
        $this->render("control/front/", "ozel/" . $dosya2, $inc2, $data);
    }

    public function back_render_genel($dosya, $inc = FALSE, $data = FALSE) {
        $this->render("back/", "genel/" . $dosya, $inc, $data);
    }

    public function back_render_ozel($dosya2, $inc2 = FALSE, $data = FALSE) {
        $this->render("back/", "ozel/" . $dosya2, $inc2, $data);
    }

    public function pagination($total, $dir) {
        $array = explode("-", $this->total_data[$total]);
		if($array[0] != 0){
			$pages = ceil($array[0] / $array[1]);
			$get = $array[2];
			if (@$_GET[$get] > $pages) {
				@$_GET[$get] = $pages;
			}

			if (empty($_GET[$get])) {
				$_GET[$get] = 1;
			}

			$nav = "<nav aria-label='Page navigation example'>\n
			<ul class='pagination'>";

			if (@$_GET[$get] > 1) {
				$link = $_GET[$get] - 1;
				$nav .= "<li class='page-item'>"
						. "<a class='page-link' href='" . URL . "/" . $dir . "'>İlk</a>"
						. "</li>\n";
				$nav .= "<li class='page-item'>"
						. "<a class='page-link' href='" . URL . "/" . $dir . "?" . $get . "=" . $link . "'>Önceki</a>"
						. "</li>\n";
			}

			for ($x = 1; $x <= $pages; $x++) {
				if ($x > 0 and $x <= $array[0]) {
					if ($x == $_GET[$get]) {
						$nav .= "<li class='page-item active'>"
								. "<a class='page-link' href='javascript:void(0)'>" . $x . "<span class='sr-only'>(current)" . $x . "</span></a>"
								. "</li>\n";
					} else {
						$nav .= "<li class='page-item'>"
								. "<a class='page-link' href='" . URL . "/" . $dir . "?" . $get . "=" . $x . "'>" . $x . "</a>"
								. "</li>\n";
					}
				}
			}

			if (@$_GET[$get] != $pages) {
				$link2 = $_GET[$get] + 1;
				$nav .= "<li class='page-item'><a class='page-link' href='" . URL . "/" . $dir . "?" . $get . "=" . $link2 . "'>Sonraki</a></li>\n";
				$nav .= "<li class='page-item'><a class='page-link' href='" . URL . "/" . $dir . "?" . $get . "=" . $pages . "'>Son</a></li>\n";
			}

			$nav .= "</ul>\n
			</nav>";
			echo $nav;
		}
    }

    public function pagination_array($array = array(), $goster, $par) {
		$this->get_page_get = $par;
		$sayfaid = (!empty($_GET[$par])) ? intval($_GET[$par]) : 1;
		$toplam = count($array);
		$limit = $goster;
		$toplamsayfa = ceil($toplam / $limit);
		$sayfaid = max($sayfaid, 1);
		$page = min($sayfaid, $toplamsayfa);
		$offset = ($sayfaid - 1) * $limit;
		if( $offset < 0 ) $offset = 0;
		$veriler = array_slice($array, $offset, $limit);
		$this->get_page_next = $sayfaid;
		$this->get_page_limit = $limit;
		$this->get_page_total = count($array);
		return $veriler;
    }

    public function pagination_array_list($dir) {
		$sayfasay = ceil($this->get_page_total / $this->get_page_limit);
		?>
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<?php
				for($i=1; $i<=$sayfasay; $i++){
				if($i == $this->get_page_next){
				?>
				<li class='page-item active'>
					<a class='page-link' href="javascript:void(0)"><?=$i;?><span class="sr-only">(current)<?=$i;?></span></a>
				</li>
				<?php }else{ ?>
				<li class='page-item'>
					<a class="page-link" href="<?=URL."/".$dir;?>?<?=$this->get_page_get."=".$i;?>"><?=$i;?></a>
				</li>
				<?php } } ?>
			</ul>
		</nav>
		<?php
    }

	public function ekleme_alanlar($metot, $title, $post, $callfunc, $callfunc2 = FALSE){
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box">
				<h4 class="m-t-0 header-title m-b-30" lang="tr">
					<b lang="tr"><?=$title;?></b>
				</h4>
				<div class="row">
					<form action="<?=url_b($post);?>" method="post" name="kaydet" class="form-horizontal" role="form">
						<ul class="nav nav-tabs navtab-bg nav-justified">
							<?php
							$x = 0;
							foreach ($this->data_list as $index => $value) {
							$x++;
							$dil  = $this->data_array["dil"][$index]["lang"];
							$url  = $this->data_array["dil"][$index]["url"];
							$flag = $this->data_array["dil"][$index]["flag"];
							?>
							<li class="<?php if($x == 1){echo "active";} ?>">
								<a href="#lang-<?=$url;?>" data-toggle="tab" aria-expanded="<?php if($x == 1){echo "false";}else{echo "true";} ?>">
									<?php if($this->dil_say > 1){ ?>
									<span lang="tr">
										<img src="<?=url_b("public/images/flags/".$flag);?>" style="height:32px;" /> <?=$dil;?>
									</span>
									<?php } ?>
								</a>
							</li>
							<?php } ?>
						</ul>
						<div class="tab-content">
							<?php
							$i = 0;
							foreach ($this->data_list as $index2 => $value2) {
							$i++;
							$url2 = $this->data_array["dil"][$index2]["url"];
							?>
							<div class="tab-pane <?php if($i == 1){echo "active";} ?>" id="lang-<?=$url2;?>">
								<?php
								if (is_callable($callfunc)) {
									if($metot == "ekle"){
										call_user_func_array($callfunc, array($this->data_array["dil"][$index2]["url"]));
									}else{
										call_user_func_array($callfunc, array($this->data_array["dil"][$index2]["url"], $this->data_array["ceviri"][$index2]));
									}
								}
								?>
							</div>
							<?php
							}
							if ($callfunc2 != FALSE) {
								if (is_callable($callfunc2)) {
									call_user_func($callfunc2);
								}
							}
							?>
							<div class="form-group">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-10">
									<button type="submit" class="btn btn-success waves-effect waves-light">
										<span class="btn-label"><i class="fa fa-plus"></i></span>Kaydet
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
	}

    public function js_function_get($function, $yuz = FALSE, $par = FALSE) {
		if($yuz != FALSE){
			require_once 'control/system/helper/js_functions/'.$function.'.php';
		}else{
			require_once PATH.'/system/helper/js_functions/'.$function.'.php';
		}
        if (function_exists($function) ) {
            $function($par, $par = array());
        }
    }

    public function js_function($param = array(), $array = array(), $yuz_js = FALSE) {
        $this->js_function[] = $param;
        $this->js_function_array[] = $array;
        $this->js_yuz = $yuz_js;
    }

    public function js_modul($yuz) {
		if (isset($this->js)) {
			foreach ($this->js as $js) {
				if ($yuz == "back") {
					echo "<script src='" . url_b("back/". $js) . "'></script>\n";
				}else{
					echo "<script src='" . url_b("front/". $js) . "'></script>\n";
				}
			}
		}

        if (isset($this->js_function)) {
			for($x = 0; $x < count($this->js_function); $x++){
				if (isset($this->js_function_array)) {
					$this->js_function_get($this->js_function[$x], $this->js_yuz, $this->js_function_array[$x]);
				} else {
					$this->js_function_get($this->js_function[$x], $this->js_yuz);
				}
			}
        }
    }

    function coklu_resim($modul, $resim) {
	$rid 	  = $resim;
	$bul 	  = array('.jpg', '.jpeg', '.png');
	$degistir = array('');
	$resim_id = str_replace($bul, $degistir, $rid);
	?>
	<div class="col-md-2 col-sm-3 col-xs-6 nas" id="img-<?=$resim_id;?>">
		<div class="main">
			<div class="top">
				<div class="col-xs-8">
					<div class="left-text kapak-yap" id="<?=$resim;?>">Kapak Görseli</div>
				</div>
				<div class="col-xs-4">
					<div class="right-text sil" id="<?=$resim;?>">Sil</div>
				</div>
			</div>
			<div class="foto">
				<a href="<?=url_f("public/images/uploads/".$modul."/".$resim);?>" target="_blank">
					<img src="<?=url_f("public/images/uploads/".$modul."/".$resim);?>" class="img-thumbnail">
				</a>
			</div>
		</div>
	</div>
	<?php
    }

    function foto_upload_guest($modul, $resim) {
	$rid 	  = $resim;
	$bul 	  = array('.jpg', '.jpeg', '.png');
	$degistir = array('');
	$resim_id = str_replace($bul, $degistir, $rid);
	?>
	<div class="col-sm-4 col-xs-6 nas" id="img-<?=$resim_id;?>">
		<div class="main">
			<div class="top">-
				<div class="text-right sil" id="<?=$resim;?>">
					X
				</div>
			</div>
			<div class="foto">
				<a href="<?=url_f("public/images/uploads/".$modul."/".$resim);?>" target="_blank">
					<img src="<?=url_f("public/images/uploads/".$modul."/".$resim);?>" class="img-thumbnail">
				</a>
			</div>
		</div>
	</div>
	<?php
    }

    function edit_coklu_resim($modul, $resim_array) {
		foreach($resim_array as $resim){
		$rid 	  = $resim["resim"];
		$bul 	  = array('.jpg', '.jpeg', '.png');
		$degistir = array('');
		$resim_id = str_replace($bul, $degistir, $rid);
		?>
		<div class="col-md-2 col-sm-3 col-xs-6 nas" id="img-<?=$resim_id;?>">
			<div class="main">
				<div class="top">
					<div class="col-xs-8">
						<div class="left-text kapak-yap" id="<?=$resim["resim"];?>">Kapak Görseli</div>
					</div>
					<div class="col-xs-4">
						<div class="right-text sil" id="<?=$resim["resim"];?>">Sil</div>
					</div>
				</div>
				<div class="foto">
					<a href="<?=url_f("public/images/uploads/".$modul."/".$resim["resim"]);?>" target="_blank">
						<img src="<?=url_f("public/images/uploads/".$modul."/".$resim["resim"]);?>" class="img-thumbnail">
					</a>
				</div>
			</div>
		</div>
		<?php
		}
    }

    function coklu_resim_alan($kayitli_resimler = FALSE, $modul_resimler = FALSE) {
	?>
	<div class="coklu-resim">
		<div class="form-group">
			<label class="col-md-2 control-label">Fotoğraflar</label>
			<div class="col-md-10">
				<input id="file_upload" name="file_upload" type="file" multiple="true">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<div class="fotolar">
					<?php
					if($kayitli_resimler != FALSE AND $modul_resimler != FALSE){
						$this->edit_coklu_resim($modul_resimler, $kayitli_resimler);
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
    }

    function add_image($modul) {
	?>
	<div id="myModal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Görsel Ekle</h2>
			</div>
			<div class="modal-body resimler">
				<div class="button-add-img-top">
					<input id="file_upload" name="file_upload" type="file" multiple="true">
				</div>
				<?php ListDirectory($modul.'*'); ?>
			</div>
			<div class="modal-footer">
				<div class="button-line-add-img">
					<button type="button" class="btn btn-primary kapat" id="gorsel-yap">Görsel Yap</button>
				</div>
				<div class="button-line-add-img">
					<button type="button" class="btn btn-default vazgec">Seçilen Görseli İptal Et</button>
					<button type="button" class="btn btn-danger pencere-kapat">Kapat</button>
				</div>
			</div>
		</div>
	</div>
	<?php
    }

    function lang_w($dil) {
        include_once(PATH."/control/front/views/diller/".$dil.".php");
        return $this->lang_w = $lang;
    }

	function get_meta($title, $description, $meta_title) {
	?>
<title><?=$title;?></title>
<meta name="description" content="<?=$description;?>" />
<meta property="og:description" content="<?=$description;?>">
<meta property="og:title" content="<?=$meta_title;?>" />
	<?php
	}

	function meta() {
		$title 		 = isset($this->title) ? $this->title : NULL;
		$meta_title  = isset($this->meta_title) ? $this->meta_title : NULL;
		$description = isset($this->meta_description) ? $this->meta_description : NULL;
		$this->get_meta($title, $description, $meta_title);
	}

	public function tablo_liste($callfunc){
	?>
	<div class="row">
		<ul class="nav nav-tabs navtab-bg nav-justified">
			<?php foreach ($this->tablo_liste as $key => $value) { ?>
			<li class="<?php if($key == 0){echo "active";} ?>">
				<a href="#lang-<?=$value["url"];?>" data-toggle="tab" aria-expanded="<?php if($key == 0){echo "false";}else{echo "true";} ?>">
					<?php if($this->dil_say > 1){ ?>
					<span lang="tr">
						<img src="<?=url_b("public/images/flags/".$value["flag"]);?>" style="height:32px;" /> <?=$value["lang"];?>
					</span>
					<?php } ?>
				</a>
			</li>
			<?php } ?>
		</ul>
		<div class="tab-content">
			<?php foreach ($this->tablo_liste as $key2 => $value2) { ?>
			<div class="tab-pane <?php if($key2 == 0){echo "active";} ?>" id="lang-<?=$value2["url"];?>">
				<?php
				if (is_callable($callfunc)) {
					call_user_func_array($callfunc, array($value2["url"]));
				}
				?>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php
	}

}
