<?php breadcrumb_front($menu[""], $this->lang_w["register"]); ?>
<div class="login-register">
	<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
		<div class="panel panel-default box-shadow">
			<div class="panel-heading">
				<h1 class="text-primary">
					<i class="fa fa-sign-in" aria-hidden="true"></i> <?=$this->lang_w["register"];?>
				</h1>
			</div>
			<div class="panel-body">
				<form action="javascript:void(0);" method="post" name="register" id="register">
					<p><span class="req">*</span> (Yıldız) Olan alanlar zorunludur.</p>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="glyphicon glyphicon-envelope"></i>
							</div>
							<input id="user-mail" name="mail" type="text" class="form-control" tabindex="1" autofocus placeholder="E-Mail adresiniz *" required="">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</div>
							<input id="user-password" name="password" type="password" class="form-control" tabindex="2" required placeholder="Şifreniz *" required="">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</div>
							<input name="password_t" type="password" class="form-control" tabindex="2" placeholder="Şifreniz Tekrar *" required="">
						</div>
					</div>
					<button id="create-user" type="submit" class="btn btn-block btn-primary" tabindex="3">
						<?=$this->lang_w["register"];?>
					</button>
					<a href="<?=url_f("login-register");?>" class="btn btn-block btn-info" tabindex="5">
						<?=$this->lang_w["login"];?>
					</a>
				</form>
			</div>
		</div>
	</div>
</div>