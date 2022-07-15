<?php include "inc_opendb.php";
$PAGEID = 'Login'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<!--	--><?php //$page_id = "page_base_a"; ?>
	<!--	--><?php //$page_title = "Add Extras"; ?>
	<!--	--><?php //$page_keywords = "Website Keywords"; ?>
	<!--	--><?php //$page_description = "Website Description"; ?>
	<meta charset="UTF-8"/>
	<?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php'; ?>

<div class="theme-hero-area" style="margin-bottom: 50px;">
	<div class="theme-hero-area-bg-wrap">
		<div class="theme-hero-area-bg" style="background-image:url(img/adult-book-business-cactus-297755_1500x800.jpg);"></div>
		<div class="theme-hero-area-mask theme-hero-area-mask-strong-login"></div>
	</div>
	<div class="theme-hero-area-body">
		<div class="theme-page-section _pt-100 theme-page-section-xl">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="theme-login theme-login-white">

							<div class="theme-login-box">
								<div class="theme-login-box-inner">
<!--									<form class="theme-login-form" id="loginform" name="logi_form" method="post">-->
									<form class="" id="loginform" name="logi_form" method="post">
										<h1 style="font-size: 20px;margin-top: 0px;margin-bottom: 10px;">Login</h1>
										<div class="form-group theme-login-form-group">
											<input class="form-control" id="email" name="email" type="text" required placeholder="Email Address"/>
										</div>
										<div class="form-group theme-login-form-group">
											<input class="form-control" type="password" name="password" id="password" required placeholder="Password"/>
											<p class="help-block">
												<a>Forgot password?</a>
											</p>
										</div>
										<div class="form-group">
											<div class="theme-login-checkbox">
												<label class="icheck-label"> <input class="icheck" id="loggedin" name="loggedin" type="checkbox"/> <span class="icheck-title">Keep me logged in</span> </label>
											</div>
										</div>

										<input type="submit" id="btnsignin" name="btnsignin" class="btn btn-uc btn-primary btn-block btn-lg" value="Sign In"/> <br>
										<div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
										<div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
									</form>

<!--                                    <a class="btn btn-uc btn-primary btn-block btn-lg" type="submit" href="sign-up">Sign Up</a>-->
									<!--									<div class="theme-login-social-separator">-->
									<!--										<p>or sign in with social media</p>-->
									<!--									</div>-->


									<!--									<div class="theme-login-social-login">-->
									<!--										<div class="row" data-gutter="10">-->
									<!--											<div class="col-xs-6">-->
									<!--												<a class="theme-login-social-login-facebook" href="#"> <i class="fa fa-facebook-square"></i> <span>Sign in with-->
									<!--                                <br/>-->
									<!--                                <b>Facebook</b>-->
									<!--                              </span> </a>-->
									<!--											</div>-->
									<!--											<div class="col-xs-6">-->
									<!--												<a class="theme-login-social-login-google" href="#"> <i class="fa fa-google-plus-circle"></i> <span>Sign in with-->
									<!--                                <br/>-->
									<!--                                <b>Google</b>-->
									<!--                              </span> </a>-->
									<!--											</div>-->
									<!--										</div>-->
									<!--									</div>-->


								</div>
																<div class="theme-login-box-alt">
																	<p>Don't have an account? &nbsp; <a href="sign-up">Sign up.</a>
																	</p>
																</div>
							</div>

							<p class="theme-login-terms">By logging in you accept our <a href="#">terms of use</a> <br/>and <a href="#">privacy policy</a>. </p><br><br><br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>
</body>
</html>