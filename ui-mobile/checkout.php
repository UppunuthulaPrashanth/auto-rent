<!doctype html>
<html lang="en">
	 <?php include 'inc_metadata.php'; ?>
	<body class="default">
		
		<!-- Preloading -->
		 <?php include 'inc_preloader.php'; ?>
		<!-- .Preloading -->
		<!-- Sidebar left -->
			 <?php include 'inc_menu_leftsidebar.php'; ?>
			<!-- .Sidebar left -->
			<!-- Sidebar right -->
			 <?php include 'inc_rightsidebar.php'; ?>
			<!-- .Sidebar right-->
			<!-- Header  -->
			<?php include 'inc_topbar.php'; ?>
			<!-- .Header  -->
			<!-- Content  -->
			<div id="content">
        <div class="content-wrap page-checkout">
          
          <div class="subsite-banner">
            <img src="img/subsite-banner-2.jpg">
          </div>
          <div class="subsite subsite-with-banner">
            
            <div class="row subsite-heading-row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Contact Details
                </div>
                <div class="subsite-heading-description">
                  Fill in the form your contact details :
                </div>
              </div>
            </div>
            <div class="row margin-bottom-row">
              <div class="col-md-12">
                <div class="form-layout">
                  <form class="contatct-detail-form">
                    <div class="form-group">
                      <div class="row">
                        <div class="col no-padding-right">
                          <label>First name</label>
                          <div class="field-group">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                        <div class="col">
                          <label>Last name</label>
                          <div class="field-group">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col ">
                          <label>Country</label>
                          <div class="field-group">
                            <i class="fas fa-globe"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col ">
                          <label>Street address 1</label>
                          <div class="field-group">
                            <i class="fas fa-home"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col ">
                          <label>Street address 2</label>
                          <div class="field-group">
                            <i class="fas fa-home"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <label>City</label>
                          <div class="field-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col no-padding-right">
                          <label>State</label>
                          <div class="field-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                        <div class="col">
                          <label>Zip code</label>
                          <div class="field-group">
                            <i class="fas fa-globe"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <label>Phone</label>
                          <div class="field-group">
                            <i class="fas fa-phone-square"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <label>Email</label>
                          <div class="field-group">
                            <i class="fas fa-envelope"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row subsite-heading-row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Payment method
                </div>
                <div class="subsite-heading-description">
                  Choose your payment method :
                </div>
              </div>
            </div>
            
            <div class="row margin-bottom-row ">
              <div class="col-md-12">
                <div class="form-layout">
                  <form class="form-payment-method">
                    <div class="form-group grey-box">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment-method" id="payment-method-1" value="option1" checked>
                        <label class="form-check-label" for="payment-method-1">
                          Credit card
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment-method" id="payment-method-2" value="option1" checked>
                        <label class="form-check-label" for="payment-method-2">
                          Paypal
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment-method" id="payment-method-3" value="option1" checked>
                        <label class="form-check-label" for="payment-method-3">
                          Direct bank transfer
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment-method" id="payment-method-4" value="option1" checked>
                        <label class="form-check-label" for="payment-method-4">
                          Check payment
                        </label>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row subsite-heading-row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Billing detail
                </div>
                <div class="subsite-heading-description">
                  Fill in the form your billing detail :
                </div>
              </div>
            </div>
            <form class="billing-detail-form">
              <div class="row margin-bottom-row">
                <div class="col-md-12">
                  <div class="form-layout">
                    
                    <div class="form-group">
                      
                      <div class="row">
                        <div class="col no-padding-right">
                          <label>First name</label>
                          <div class="field-group">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                        <div class="col">
                          <label>Last name</label>
                          <div class="field-group">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <label>Phone</label>
                          <div class="field-group">
                            <i class="fas fa-phone-square"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <label>Email</label>
                          <div class="field-group">
                            <i class="fas fa-envelope"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col ">
                          <label>Address </label>
                          <div class="field-group">
                            <i class="fas fa-home"></i>
                            <input type="text" class="form-control with-icon">
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="cart-total">
                    <div class="ct-row">
                      <div class="ct-left">Subtotal</div>
                      <div class="ct-right"><span>Aed 145</span></div>
                      <div class="clear"></div>
                    </div>
                    <div class="ct-row">
                      <div class="ct-left">Discount</div>
                      <div class="ct-right"><span>Aed 14</span></div>
                      <div class="clear"></div>
                    </div>
                    <div class="ct-row total">
                      <div class="ct-left">Total</div>
                      <div class="ct-right"><span>Aed 131</span></div>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row margin-bottom-row">
                <div class="col-md-12">
                  <div class="button">
                    <button type="submit" class="theme-button">Process payment </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div> 
			<!-- .Content  -->
			<!-- Botom Panel  -->
				<?php include 'inc_bottompanel.php'; ?>
			<!-- .Bottom Panel  -->
			
			
			<div class="overlay"></div>
			
			<!-- Optional JavaScript -->
			<!-- jQuery v3.4.1 -->
			<?php include 'inc_footerscript.php'; ?>
			
		</body>
	</html>