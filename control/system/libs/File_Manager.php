<?php

class File_Manager {

	function __construct() {
		if (isset($_GET["path"])) {
			$this->init("../" . $_GET["path"] . "/*");
		} else {
			$this->init("../public/*");
		}
	}

	function get_date($file) {
		return date("d-m-Y H:i:s", filectime($file));
	}

	function get_owner($file, $name) {
		return posix_getpwuid(fileowner($file))[$name];
	}

	function filesize_formatted($file) {
		$bytes = filesize($file);
		if ($bytes >= 1073741824) {
			return number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			return number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			return number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			return $bytes . ' bytes';
		} elseif ($bytes == 1) {
			return '1 byte';
		} else {
			return '0 bytes';
		}
	}

	private static function rename_dir($text) {
        $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
        $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
        $text = strtolower(str_replace($find, $replace, $text));
        $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
        $text = trim(preg_replace('/\s+/', ' ', $text));
        $text = str_replace(' ', '_', $text);
        return $text;
    }

    private static function filter($par) {
        $par = trim($par, " ");
        $par = rtrim($par, "/");
        return $par;
    }

    public static function make_dir($yol, $dir_name) {
		$dir_name = self::filter($dir_name);
		$dir_name = self::rename_dir($dir_name);
		$dir_name = $yol.$dir_name;

		if(file_exists($dir_name)){
			return FALSE;
		}else{
			mkdir($dir_name, 0755);
			return TRUE;
		}

    }

	function back_up() {
		if (isset($_GET["path"])) {
			$get = trim($_GET["path"], "/");
			$get_array = explode("/", $get);
			$get_array_count = count($get_array);

			if ($get_array_count < 2) {
				$back_link = "dosya-yonetimi";
			} else {
				$back_up_link = trim($_SERVER["REQUEST_URI"], "/");
				$get_back_array = explode("/", $back_up_link);
				array_shift($get_back_array);
				array_pop($get_back_array);
				$back_link = implode("/", $get_back_array);
			}
			?>
			<tr class="filefile2">
				<td></td>
				<td>Klasör</td>
				<td class="file back-up">
					<a href="../<?= $back_link; ?>">Üst Dizin </a>
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<?php
		}
	}

	function islemler() {
	?>
	<div class="file-manager-bottom">
		<div class="buttons">
			<button type="button" class="btn btn-primary waves-effect waves-light" id="dizin-olustur">
				<i class="fa fa-folder-o" aria-hidden="true"></i> Dizin Oluştur
			</button>
			<button type="button" class="btn btn-success waves-effect waves-light" id="yukle">
				<i class="fa fa-arrows" aria-hidden="true"></i> Dosya Yükle
			</button>
			<button type="button" class="btn btn-default waves-effect waves-light" id="tasi">
				<i class="fa fa-arrows" aria-hidden="true"></i> Taşı
			</button>
			<button type="button" class="btn btn-info waves-effect waves-light" id="yeniden-adlandir">
				<i class="fa fa-share-square" aria-hidden="true"></i> Yeniden Adlandır
			</button>
			<button type="button" class="btn btn-warning waves-effect waves-light" id="zip">
				<i class="fa fa-file-archive-o" aria-hidden="true"></i> Zip Arşiv
			</button>
			<button type="button" class="btn btn-danger waves-effect waves-light" id="sil">
				<i class="fa fa-trash" aria-hidden="true"></i> Sil
			</button>
		</div>
	</div>
	<?php
	}

	function dizin_olustur() {
	?>
	<div id="myModal" class="modal">
		<form action="" method="post" id="dizin_olustur" class="form-horizontal" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Dizin Oluştur</h2>
				</div>
				<div class="modal-body" style="width:100%;">
					<div class="body-make-dir">
						<div class="col-md-8 col-md-offset-2">
							<p>Oluşturmak istediğiniz diznin adını forma giriniz.</p>
							<div class="form-group">
								<span class="col-md-8 up-root">
									<?php
									if(isset($_GET["path"])){
										$path = $_GET["path"];
										echo '<input name="up_root" id="up_root" type="hidden" value="'.$path.'">';
									}else{
										$path = "ana_dizin";
										echo '<input name="up_root" id="up_root" type="hidden" value="">';
									}
									echo $path;
									?>
								</span>
								<div class="col-md-4">
									<input type="text" id="dir" name="dir" class="form-control" placeholder="Dizin Adı" required />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="button-line-add-img">
						<button type="button" class="btn btn-primary" id="Kaydet">Kaydet</button>
					</div>
					<div class="button-line-add-img">
						<button type="button" class="btn btn-danger kapat">Vazgeç</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php
	}

	function dosya_ekle() {
		if(isset($_GET["path"])){
			$geturl = "?path=".$_GET["path"];
		}else{
			$geturl = "?path=";
		}
	?>
	<div id="dosya-ekle" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Dosya Yükle</h2>
			</div>
			<div class="modal-body" style="width:100%;">
				<div class="body-make-dir" style="height:400px;">
					<div class="col-md-8 col-md-offset-2">
						<p>Yüklemek istediğiniz dosyayı seçim yükleyebilirsiniz</p>
						<form action="<?=url_b("dosya-yonetimi/upload".$geturl);?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<span class="col-md-9 up-root">
									<input type="file" name="myfile" id="upbtn">
								</span>
								<div class="col-md-3">
									<button type="submit" class="btn btn-success" id="files-upload-buton">Dosyayı Yükle</button>
								</div>
							</div>
							<div id="durum">
								<div class="form-group">
									<div class="progress">
										<div class="bar"></div>
										<div class="percent">0%</div>
									</div>
								</div>
								<div class="form-group">
									<div id="status"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="button-line-add-img">
					<button type="button" class="btn btn-primary" id="Kaydet2">Kaydet</button>
				</div>
				<div class="button-line-add-img">
					<button type="button" class="btn btn-danger yukle-kapat">Vazgeç</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	}

	function loop($dir) {
	$directories = glob($dir);
	?>
	<ul>
		<?php
		foreach ($directories as $file) {
		$file_array = explode("/", $file);
		$file_name  = end($file_array);
		if(is_dir($file)){
			$icon = '<i class="fa fa-folder"></i>';
		}else{
			$icon = '<i class="glyphicon glyphicon-file" aria-hidden="true"></i>';
		}
		if(is_dir($file)){
			$icon_right = '<i class="glyphicon glyphicon-triangle-bottom"></i>';
		}else{
			$icon_right = NULL;
		}
		if(is_dir($file)){
			$class = 'class="hasFiles"';
		}else{
			$class = NULL;
		}
		if(!is_dir($file)){
			$class_file = 'class="padLeft"';
		}else{
			$class_file = NULL;
		}
		?>
		<li <?=$class;?>>
			<div <?=$class_file;?>>
				<?php if(is_dir($file)){ ?>
				<input name="dizin" type="radio" value="<?=$file;?>">
				<?php } ?>
				<?=$icon;?> <?=$file_name;?> <?=$icon_right;?>
			</div>
			<?php
			if (is_dir($file)) {
				$this->loop($file.'/*');
			}
			?>
		</li>
		<?php } ?>
	</ul>
	<?php
	}

	function tasi() {
	?>
	<div id="dosya-tasi" class="modal">
		<div class="modal-content tasi-content">
			<div class="modal-header">
				<h2>Dosya veya klasör taşı</h2>
			</div>
			<div class="modal-body" style="width:100%;">
				<div class="body-make-dir" style="height:420px;">
					<div class="col-md-8 col-md-offset-2">
						<p>Taşımak istediğiniz dizini seçiniz.</p>
						<form action="<?=url_b("dosya-yonetimi/tasima");?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<div class="col-md-12">
									<div class="tasima-liste">
										<?php $this->loop("../public/*"); ?>
									</div>
									<button type="submit" class="btn btn-success" id="dosya-gonder">Taşı</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="button-line-add-img">
					<button type="button" class="btn btn-primary" id="Kaydet2">Kaydet</button>
				</div>
				<div class="button-line-add-img">
					<button type="button" class="btn btn-danger tasi-kapat">Kapat</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	}

	function yeniden_adlandir() {
	?>
	<div id="dosya-yeniden-adlandir" class="modal">
		<form action="" method="post" id="yeniden_adlandir" class="form-horizontal" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Yeniden Adlandır</h2>
				</div>
				<div class="modal-body" style="width:100%;">
					<div class="body-make-dir">
						<div class="col-md-8 col-md-offset-2">
							<div class="form-group">
								<div class="col-md-12 rename">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="button-line-add-img">
						<button type="button" class="btn btn-primary" id="rename-Kaydet">Kaydet</button>
					</div>
					<div class="button-line-add-img">
						<button type="button" class="btn btn-danger yeniden_adlandir-kapat">Kapat</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php
	}

	function file_path() {
	?>
	<div class="file-path">
		<ul>
			<li>
				<a href="<?= url_b("dosya-yonetimi"); ?>">
					<i class="fa fa-home" aria-hidden="true"></i> Kök Dizin
				</a>
				<span>/</span>
			</li>
			<?php
			if (isset($_GET["path"])) {
				$get = trim($_GET["path"], "/");
				$get_array = explode("/", $get);
				$get_plus = null;
				$say = count($get_array);
				$i = 0;
				foreach ($get_array as $value) {
					$get_plus .= $value . "/";
					$new_link = url_b("dosya-yonetimi?path=" . $get_plus);
					$new_link = rtrim($new_link, "/");
					?>
					<li>
						<a href="<?= $new_link; ?>">
							<?php if ($i == $say - 1) { ?>
							<i class="fa fa-folder-open" aria-hidden="true"></i> <?= $value; ?>
							<?php } else { ?>
							<i class="fa fa-folder" aria-hidden="true"></i> <?= $value; ?>
							<?php } ?>
						</a>
						<span>/</span>
					</li>
					<?php
					$i++;
				}
			}
			?>
		</ul>
	</div>
	<?php
	}

	function init($dir) {
	$all_files = glob($dir);
	?>
	<div class="file-manager">
		<?php $this->file_path(); ?>
		<form action="" method="post" enctype="multipart/form-data" id="fiile_manager">
			<table class="table table-striped table-bordered DATAtable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">Seçim
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Tür
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">İçerik
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Boyut
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Kullanıcı
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Oluşturma Tarihi
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Uygulama
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$this->back_up();
					foreach ($all_files as $key => $file) {
						if (is_dir($file)) {
							$class 		= "dir";
							$class2		= "dir";
							$type   	= "Klasör";
						} else {
							$class 	    = "file";
							$type_array = explode(".", $file);
							$file_type  = end($type_array);
							$class2 	= $file_type;
							$type 		= "Dosya";
						}
						$name_array 	= explode("/", $file);
						$file_name 		= end($name_array);
						$path 			= @ltrim($file, "../");
						?>
						<tr class="file<?=$class;?>">
							<td style="width:1px;text-align:center;">
								<input name="file[]" type="checkbox" value="<?=$file;?>">
							</td>
							<td style="width:1px;text-align:center;">
								<?=$type;?>
							</td>
							<td class="file <?=$class2;?>">
								<a href="dosya-yonetimi?path=<?=$path;?>"><?=$file_name;?></a>
							</td>
							<td><?=$this->filesize_formatted($file);?></td>
							<td><?=$this->get_owner($file, "name");?></td>
							<td><?=$this->get_date($file);?></td>
							<td>
								<a class="btn btn-primary btn-xs waves-effect waves-light" href="#">
									<span class="btn-label"><i class="fa fa-download"></i></span> İndir
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php
			$this->islemler();
			$this->dizin_olustur();
			$this->dosya_ekle();
			$this->tasi();
			$this->yeniden_adlandir();
			?>
		</form>
	</div>
	<?php
	}

}
