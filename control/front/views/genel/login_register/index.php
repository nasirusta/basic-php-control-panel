<?php breadcrumb_front($menu[""], $menu["login-register"]); ?>
<div class="login-register">
	<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
		<div class="panel panel-default box-shadow">
			<div class="panel-heading">
				<h1 class="text-primary">
					<i class="fa fa-sign-in" aria-hidden="true"></i> <?=$this->lang_w["login"];?>
				</h1>
			</div>
			<div class="panel-body">
				<form action="javascript:void(0);" method="post" name="login" id="login">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</div>
							<input id="user-mail" name="username" type="text" class="form-control" tabindex="1" autofocus required placeholder="E-Mail adresiniz">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</div>
							<input id="user-password" name="password" type="password" class="form-control" tabindex="2" required placeholder="Şifreniz">
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<div class="checkbox">
									<label>
										<input name="hatirla" type="checkbox" value="1"> 
										Beni Hatırla
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkbox text-right">
									<a href="#forget-password" class="btn btn-xs btn-link" tabindex="4">
										Şifremi Unuttum
									</a>
								</div>
							</div>
						</div>
					</div>
					<button id="loginbtn" type="submit" class="btn btn-block btn-primary" tabindex="3">
						<?=$this->lang_w["login"];?>
					</button>
					<a href="<?=url_f("register");?>" class="btn btn-block btn-info" tabindex="5">
						<?=$this->lang_w["register"];?>
					</a>
				</form>
			</div>
		</div>
	</div>
</div>