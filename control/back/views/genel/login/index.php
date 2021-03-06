<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/favicon_1.ico">
<title>Giriş Yap</title>
<link href="<?=assets;?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=assets;?>/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?=assets;?>/css/components.css" rel="stylesheet" type="text/css" />
<link href="<?=assets;?>/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?=assets;?>/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?=assets;?>/css/responsive.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script src="assets/js/modernizr.min.js"></script>
</head>
<body>
<div class="animationload">
    <div class="loader"></div>
</div>
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading"> 
            <h3 class="text-center"> Sisteme <strong class="text-custom">Giriş Yap</strong> </h3>
        </div> 
        <div class="panel-body">
            <form action="login/run" method="post" name="giris_yap" class="form-horizontal m-t-20" id="giris_yap">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input name="mail" type="text" class="form-control" id="mail" required="" placeholder="Kullanıcı Adı (E-Posta Adresi)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="sifre" type="password" class="form-control" id="sifre" required="" placeholder="Şifre">
                    </div>
                </div>
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-inverse btn-block text-uppercase waves-effect waves-light" type="submit" lang="tr">Giriş Yap</button>
                    </div>
                </div>
            </form>
        </div>   
    </div>
</div>
<script>
	var resizefunc = [];
</script>
<script src="<?=assets;?>/js/jquery.min.js"></script>
<script src="<?=assets;?>/js/bootstrap.min.js"></script>
<script src="<?=assets;?>/js/detect.js"></script>
<script src="<?=assets;?>/js/fastclick.js"></script>
<script src="<?=assets;?>/js/jquery.slimscroll.js"></script>
<script src="<?=assets;?>/js/jquery.blockUI.js"></script>
<script src="<?=assets;?>/js/waves.js"></script>
<script src="<?=assets;?>/js/wow.min.js"></script>
<script src="<?=assets;?>/js/jquery.nicescroll.js"></script>
<script src="<?=assets;?>/js/jquery.scrollTo.min.js"></script>
<script src="<?=assets;?>/js/jquery.core.js"></script>
<script src="<?=assets;?>/js/jquery.app.js"></script>
</body>
</html>