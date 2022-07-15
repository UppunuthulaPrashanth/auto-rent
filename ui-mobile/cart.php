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
        <div class="content-wrap page-cart">
          <div class="subsite">
            <div class="row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Your Reservation
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="chart-box">
                  <div class="cart-car-box">
                    <div class="chart-car"><img src="img/car2-mitsubishi2.png"></div>
                    <div class="chart-car-title">Mitsubishi Xpander</div>
                    <div class="chart-car-price">Aed 50 / Hour</div>
                  </div>
                  <div class="cart-box-detail">
                    <ul>
                      <li><i class="fas fa-map-marker-alt"></i> <label>Country</label> : UAE</li>
                      <li><i class="fas fa-map-marker-alt"></i> <label>City</label> : Sharjah</li>
                      <li><i class="fas fa-map-marker-alt"></i> <label>Location</label> : Bank Street</li>
                      <li><i class="fas fa-dice-d6"></i> <label>Rental Package</label> : 12 Hours/day</li>
                      <li><i class="far fa-clock"></i><label> Rental Start</label> : 4/28/2022 &nbsp;10:00 AM</li>
                      <li><i class="far fa-clock"></i><label> Rental End</label> : 4/28/2022 &nbsp;10:00 PM</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Extra Services
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="chart-box">
                  <div class="cb-box">
                    <div class="extraservice">
                      <div class="service-row">
                        <div class="es-left"><i class="fas fa-check"></i>Driver</div>
                        <div class="es-right">Aed 10/Hour</div>
                        <div class="clear"></div>
                      </div>
                      <div class="service-row">
                        <div class="es-left"><i class="fas fa-check"></i>Snack</div>
                        <div class="es-right"> Aed 15/Hour</div>
                        <div class="clear"></div>
                      </div>
                      <div class="service-row">
                        <div class="es-left"><i class="fas fa-check"></i>Entertainment</div>
                        <div class="es-right">Aed 20/Hour</div>
                        <div class="clear"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Coupon
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="coupon">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Coupon Code" aria-label="Coupon Code"
                    aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button">Apply Coupon</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Cart Totals
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="cart-total">
                  <div class="ct-row">
                    <div class="ct-left">Subtotal</div>
                    <div class="ct-right"><span>Aed 95</span></div>
                    <div class="clear"></div>
                  </div>
                  <div class="ct-row">
                    <div class="ct-left">Discount</div>
                    <div class="ct-right"><span>Aed 14</span></div>
                    <div class="clear"></div>
                  </div>
                  <div class="ct-row total">
                    <div class="ct-left">Total</div>
                    <div class="ct-right"><span>Aed 81</span></div>
                    <div class="clear"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="button">
                  <button type="submit" class="theme-button">Checkout</button>
                </div>
              </div>
            </div>
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