<link href="<?=back_assets;?>/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="<?=back_assets;?>/plugins/nvd3/build/nv.d3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/plugins/nestable/jquery.nestable.css" rel="stylesheet" />
<link href="<?=back_assets;?>/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?=back_assets;?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/css/components.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/uploadifive/uploadifive.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/datatable_nas/css/addons/datatables.min.css" rel="stylesheet">
<link href="<?=back_assets;?>/css/nas.css" rel="stylesheet" type="text/css" />
<link href="<?=back_assets;?>/coklu_resimler/coklu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?=back_assets;?>/bootstrap-multiselect/bootstrap-multiselect.css" />
<?php
if (isset($this->css)) {
    foreach ($this->css as $css) {
        echo "<link href='".URL."/control/back/" . $css . "' rel='stylesheet' type='text/css' />\n";
    }
}
if (isset($this->ozel_css)) {
    foreach ($this->ozel_css as $ozel_css) {
        echo "<link href='".URL."/" . $ozel_css . "' rel='stylesheet' type='text/css' />\n";
    }
}
?>
<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->