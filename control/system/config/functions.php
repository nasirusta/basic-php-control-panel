<?php
if (!function_exists('dosya_dongu')){
	function dosya_dongu($dir) {
		$directories = glob($dir);
		$array = array();

		foreach ($directories as $file) {
			$ex = explode("/", $file);
			$file_array = explode("/", $file);
			$file_name  = end($file_array);

			if (is_file($file)) {
				$array[] = $file;
			}

			if (is_dir($file)) {
				$array[$file_name] = dosya_dongu($file . '/*');
			}
		}
		return $array;
	}
}

if (!function_exists('ListDirectory')){
	function ListDirectory($dir) {
		$directories = glob($dir);

		echo '<ul>';
		foreach ($directories as $file) {
			$file_array = explode("/", $file);
			$file_name  = end($file_array);

			if (is_dir($file)) {
				$icon_class = 'class="hasFiles"';
			} else {
				$icon_class    = NULL;
			}

			if (is_file($file)) {
				$rid 		   = $file_name;
				$bul 		   = array('.jpg', '.jpeg', '.png');
				$degistir 	   = array('');
				$degistirilmis = str_replace($bul, $degistir, $rid);
				$id_attr 	   = 'id="'.$degistirilmis.'"';
			}else{
				$id_attr = NULL;
			}

			echo '<li ' . $icon_class . '" '.$id_attr.'>';
			echo '<div>';

			if (is_file($file)) {
				echo '<i class="glyphicon glyphicon-remove resim-sil" id="'.$file_name.'"> </i>';
				echo '<img src="'.$file.'" class="img-responsive normal-resim" id="'.$file_name.'" />';
			}

			echo '</div>';

			if (is_dir($file)) {
				ListDirectory($file . '/*');
			}
			echo '</li>';
		}
		echo '</ul>';
		echo '<div class="goster"></div>';
	}
}

if (!function_exists('mesaj')){
	function mesaj($tip, $baslik, $mesaj) {
		$return = "<div class='alert alert-".$tip."' role='alert'>\n";
			$return .= "<h3>".$baslik."</h3>\n";
			$return .= $mesaj."\n";
		$return .= "</div>\n";
		return $return;
	}
}

if (!function_exists('meta_info')){
	function meta_info($title = NULL, $meta_title = NULL, $meta_desc = NULL, $meta_keyword = NULL) {
		echo "<title>".$title."</title>\n";
		echo "<meta name='title' content='".$meta_title."'>\n";
		echo "<meta name='description' content='".$meta_desc."'>\n";
		echo "<meta name='keywords' content='".$meta_keyword."'>\n";
	}
}

if (!function_exists('url_b')){
	function url_b($href = False) {
		return URL."/control/".$href;
	}
}

if (!function_exists('url_f')){
	function url_f($href = False) {
		return URL."/".$href;
	}
}

if (!function_exists('inc')){
	function inc($param, $values = False) {
		include_once(PATH."/".$param.".php");
	}
}

if (!function_exists('baa_harf_buyuk')){
	function baa_harf_buyuk($metin) {
		$k_uzunluk = mb_strlen($metin, "UTF-8");
		$ilkKarakter = mb_substr($metin, 0, 1, "UTF-8");
		$kalan = mb_substr($metin, 1, $k_uzunluk - 1, "UTF-8");
		return mb_strtoupper($ilkKarakter, "UTF-8") . mb_strtolower($kalan, "UTF-8");
	}
}
// Kullan???? -> baa_harf_buyuk($isim);

// Y??nlendirme
if (!function_exists('go')){
	function go($url, $time = 0){
	  if($time) header("Refresh: {$time}; url={$url}");
	  else header("Location: {$url}");
	}
}
// Kullan??m??
//go("siteadi.com", 10);
// Ya da
//go("siteadi.com");
// K??saltma
if (!function_exists('kisalt')){
	function kisalt($kelime, $uzunluk, $son = "...") {
		$say = strlen($kelime);
		if ($say > $uzunluk) {
			$yeni = mb_substr($kelime, 0, $uzunluk, "UTF-8");
			$yeni .= $son;
		} elseif (($say == $uzunluk) or ( $say < $uzunluk)) {
			$yeni = $kelime;
		}
		return $yeni;
	}
}

// echo kisalt($degisken, 120);

// Seo Url
if (!function_exists('permalink')){
	function permalink($str, $options = array()){
		$str 	  = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
		$defaults = array(
			'delimiter' => '-',
			'limit' => null,
			'lowercase' => true,
			'replacements' => array(),
			'transliterate' => true
		);
		$options  = array_merge($defaults, $options);
		$char_map = array(
			// Latin
			'??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'AE', '??' => 'C',
			'??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I',
			'??' => 'D', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O',
			'??' => 'O', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'Y', '??' => 'TH',
			'??' => 'ss',
			'??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'ae', '??' => 'c',
			'??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i',
			'??' => 'd', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o',
			'??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'y', '??' => 'th',
			'??' => 'y',
			// Latin symbols
			'??' => '(c)',
			// Greek
			'??' => 'A', '??' => 'B', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Z', '??' => 'H', '??' => '8',
			'??' => 'I', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => '3', '??' => 'O', '??' => 'P',
			'??' => 'R', '??' => 'S', '??' => 'T', '??' => 'Y', '??' => 'F', '??' => 'X', '??' => 'PS', '??' => 'W',
			'??' => 'A', '??' => 'E', '??' => 'I', '??' => 'O', '??' => 'Y', '??' => 'H', '??' => 'W', '??' => 'I',
			'??' => 'Y',
			'??' => 'a', '??' => 'b', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'z', '??' => 'h', '??' => '8',
			'??' => 'i', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => '3', '??' => 'o', '??' => 'p',
			'??' => 'r', '??' => 's', '??' => 't', '??' => 'y', '??' => 'f', '??' => 'x', '??' => 'ps', '??' => 'w',
			'??' => 'a', '??' => 'e', '??' => 'i', '??' => 'o', '??' => 'y', '??' => 'h', '??' => 'w', '??' => 's',
			'??' => 'i', '??' => 'y', '??' => 'y', '??' => 'i',
			// Turkish
			'??' => 'S', '??' => 'I', '??' => 'C', '??' => 'U', '??' => 'O', '??' => 'G',
			'??' => 's', '??' => 'i', '??' => 'c', '??' => 'u', '??' => 'o', '??' => 'g',
			// Russian
			'??' => 'A', '??' => 'B', '??' => 'V', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Yo', '??' => 'Zh',
			'??' => 'Z', '??' => 'I', '??' => 'J', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => 'O',
			'??' => 'P', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', '??' => 'F', '??' => 'H', '??' => 'C',
			'??' => 'Ch', '??' => 'Sh', '??' => 'Sh', '??' => '', '??' => 'Y', '??' => '', '??' => 'E', '??' => 'Yu',
			'??' => 'Ya',
			'??' => 'a', '??' => 'b', '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'yo', '??' => 'zh',
			'??' => 'z', '??' => 'i', '??' => 'j', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => 'o',
			'??' => 'p', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u', '??' => 'f', '??' => 'h', '??' => 'c',
			'??' => 'ch', '??' => 'sh', '??' => 'sh', '??' => '', '??' => 'y', '??' => '', '??' => 'e', '??' => 'yu',
			'??' => 'ya',
			// Ukrainian
			'??' => 'Ye', '??' => 'I', '??' => 'Yi', '??' => 'G',
			'??' => 'ye', '??' => 'i', '??' => 'yi', '??' => 'g',
			// Czech
			'??' => 'C', '??' => 'D', '??' => 'E', '??' => 'N', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U',
			'??' => 'Z',
			'??' => 'c', '??' => 'd', '??' => 'e', '??' => 'n', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u',
			'??' => 'z',
			// Polish
			'??' => 'A', '??' => 'C', '??' => 'e', '??' => 'L', '??' => 'N', '??' => 'o', '??' => 'S', '??' => 'Z',
			'??' => 'Z',
			'??' => 'a', '??' => 'c', '??' => 'e', '??' => 'l', '??' => 'n', '??' => 'o', '??' => 's', '??' => 'z',
			'??' => 'z',
			// Latvian
			'??' => 'A', '??' => 'C', '??' => 'E', '??' => 'G', '??' => 'i', '??' => 'k', '??' => 'L', '??' => 'N',
			'??' => 'S', '??' => 'u', '??' => 'Z',
			'??' => 'a', '??' => 'c', '??' => 'e', '??' => 'g', '??' => 'i', '??' => 'k', '??' => 'l', '??' => 'n',
			'??' => 's', '??' => 'u', '??' => 'z'
		);
		$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
		if ($options['transliterate']) {
			$str = str_replace(array_keys($char_map), $char_map, $str);
		}
		$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
		$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
		$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
		$str = trim($str, $options['delimiter']);
		return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}
}
// Kullan???? -> permalink($baslik);

if (!function_exists('moduller_loop')){
function moduller_loop($modul, $name, $icon){
?>
<div class="col-sm-2 col-xs-12">
	<div class="col-lg-12">
		<a href="<?=url_b($modul);?>">
			<div class="module">
				<i class="<?=$icon;?> text-inverse"></i>
				<div class="text-muted m-t-5 module-name"><?=$name;?></div>
			</div>
		</a>
	</div>
</div>
<?php
}
}

if (!function_exists('breadcrumb')){
function breadcrumb($title, $link = FALSE){
$link = rtrim($link, ",");
$get_link_array = explode(",", $link);
?>
<div class="row">
	<div class="col-sm-12">
		<h4 class="page-title"><?=$title;?></h4>
		<ol class="breadcrumb">
			<li><a href="<?=url_b();?>">Ana Ekran</a></li>
			<?php
			if($link != FALSE){
			foreach($get_link_array as $value){
			?>
			<li><a href="<?=url_b(permalink($value));?>"><?=$value;?></a></li>
			<?php } } ?>
			<li class="active"><?=$title;?></li>
		</ol>
	</div>
</div>
<?php
}
}

if (!function_exists('breadcrumb_back')){
function breadcrumb_back($title, $link = FALSE){
?>
<div class="row">
	<div class="col-sm-12">
		<h4 class="page-title"><?=$title;?></h4>
		<ol class="breadcrumb">
			<li><a href="<?=url_b();?>">Ana Ekran</a></li>
			<?php
			if($link != FALSE){
			foreach($link as $key => $value){
			?>
			<li><a href="<?=url_b($key);?>"><?=$value;?></a></li>
			<?php } } ?>
			<li class="active"><?=$title;?></li>
		</ol>
	</div>
</div>
<?php
}
}

if (!function_exists('yuzdeHesaplama')){
	function yuzdeHesaplama($sayi,$yuzde){
		return ($sayi*$yuzde)/100;
	}
}

if (!function_exists('klasorsil')){
	function klasorsil($klasor){
		if (substr($klasor, -1) != '/')
		$klasor .= '/';
		if ($handle = opendir($klasor)) {
			while ($obj = readdir($handle)) {
				if ($obj!= '.' && $obj!= '..') {
					if (is_dir($klasor.$obj)) {
						if (!klasorsil($klasor.$obj))
						return false;
					}elseif (is_file($klasor.$obj)) {
						if (!unlink($klasor.$obj))
						return false;
					}
				}
			}
			closedir($handle);
			if (!@rmdir($klasor))
			return false;
			return true;
		}
		return false;
	}
}

if (!function_exists('convertYoutube')){
	function convertYoutube($string) {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"www.youtube.com/embed/$2",
			$string
		);
	}
}

if (!function_exists('upload_img')){
	function upload_img($yol) {
		return url_f("public/images/uploads/".$yol);
	}
}

if (!function_exists('breadcrumb_front')){
function breadcrumb_front($home, $active, $array = FALSE){
?>
<div class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb">
					<ul>
						<li>
							<a href="<?=url_f();?>"><?=$home;?></a> <i class="fa fa-angle-right"></i>
						</li>
						<?php
						if($array != FALSE){
						foreach($array as $link => $name){
						?>
						<li>
							<a href="<?=url_f($link);?>"><?=$name;?></a> <i class="fa fa-angle-right"></i>
						</li>
						<?php } } ?>
						<li><?=$active;?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } } ?>