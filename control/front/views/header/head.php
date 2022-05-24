<?php $site_logo = url_f("public/images/uploads/site/".$data["site_info"]["resim"]); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?=$site_logo;?>">
<meta name="Googlebot" content="index, follow" />
<meta name="robots" content="index, follow" />
<meta name="Robots" content="all" />
<meta name="revisit-after" content="1 days" />
<?php $this->meta(); ?>
<link rel="image_src" href="img/logo.png" />
<link rel="canonical" href="<?=url_f();?>" />
<meta property="og:locale" content="tr_TR" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=url_f();?>" />
<meta property="og:image" content="<?=$site_logo;?>" />
<link rel="shortcut icon" href="img/favicon.html">
<base href="<?=url_f();?>/" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>	
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" type="image/x-icon" href="<?=url_f("public/assets/img/favicon.ico");?>">
<link rel="stylesheet" href="<?=url_f("public/assets/css/owl.carousel.css");?>">
<link rel="stylesheet" href="<?=url_f("public/assets/css/owl.theme.css");?>">
<link rel="stylesheet" href="<?=url_f("public/assets/css/owl.transitions.css");?>">
<link rel="stylesheet" href="<?=url_f("public/assets/css/fancybox/jquery.fancybox.css");?>">
<link rel="stylesheet" href="<?=url_f("public/assets/css/animate.css");?>">	
<link rel="stylesheet" href="<?=url_f("public/assets/css/meanmenu.min.css");?>" media="all" />
<link rel="stylesheet" href="<?=url_f("public/assets/css/normalize.css");?>">
<link rel="stylesheet" href="<?=url_f("public/assets/css/main.css");?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" href="<?=url_f("public/assets/css/style.css");?>">
<link rel="stylesheet" href="<?=url_f("public/assets/css/responsive.css");?>">
<?php
if(isset($this->css)){
foreach($this->css as $css){
?>
<link href="<?=URL."/control/front/".$css;?>" rel="stylesheet" type="text/css" />
<?php } } ?>