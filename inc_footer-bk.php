<div class="theme-footer" id="mainFooter">
	<div class="container _ph-mob-0">
		<div class="row row-eq-height row-mob-full" data-gutter="60">
			<div class="col-md-3">
				<div class="theme-footer-section theme-footer-">
					<a class="theme-footer-brand _mb-mob-30" href="#"> <img src="uploads/pages/logo-web-footer.png" alt="Image Alternative text" title="Image Title"/> </a>
					<div class="theme-footer-brand-text">
						<?php
						$pageID = '4';
						$result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
						$row    = mysqli_fetch_assoc( $result );
						echo $row['summary'];
						?>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-4">
						<div class="theme-footer-section theme-footer-">
							<h5 class="theme-footer-section-title">Navigation</h5>
							<ul class="theme-footer-section-list">
								<li>
									<a href="/about">About</a>
								</li>
								<li>
									<a href="#">Offers</a>
								</li>
								<li>
									<a href="/news">News</a>
								</li>
								<li>
									<a href="/contact">Contact Us</a>
								</li>


							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<div class="theme-footer-section theme-footer-">
							<h5 class="theme-footer-section-title">Services</h5>
							<ul class="theme-footer-section-list">
								<li>
									<a href="#">Rent</a>
								</li>
								<li>
									<a href="#">Lease</a>
								</li>
								<li>
									<a href="#">Used Cars</a>
								</li>
								<li>
									<a href="#">Flexiplans</a>
								</li>


							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<div class="theme-footer-section theme-footer-">
							<h5 class="theme-footer-section-title">Customer Care</h5>
							<ul class="theme-footer-section-list">
								<li>
									<a href="/faqs">FAQs</a>
								</li>
								<li>
									<a href="#">Report Breakdown</a>
								</li>
								<li>
									<a href="/locations">Locations</a>
								</li>
								<li>
									<a href="#">Feedback</a>
								</li>


							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="theme-footer-section theme-footer-section-subscribe  _mt-mob-30">
					<div class="theme-footer-section-subscribe-bg"></div>
					<div class="theme-footer-section-subscribe-content">
						<?php
						$pageID = '5';
						$result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
						$row    = mysqli_fetch_assoc( $result );
						?>
						<h5 class="theme-footer-section-title"><?php echo $row['pageTitle']; ?></h5>
						<?php echo $row['summary']; ?>
						<form method="post" id="subscribeForm" name="subscribeForm">
							<div class="form-group">
								<input class="form-control theme-footer-subscribe-form-control" required type="email" name="subscribeemail" id="subscribeemail" placeholder="Type your e-mail here"/>
							</div>
							<button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="subscribe-btn" type="submit">Get deals</button>
							<img id="subscribe-ajaxLoader" src="uploads/ajax_loader.gif" style="display: none; margin-left: auto; margin-right: auto;">
						</form>
						<br>
						<div id="sub-success-message-div" class="col-lg-12 col-md-12 form-field" style="display: none"></div>
						<div id="sub-error-message-div" class="col-lg-12 col-md-12 form-field" style="display: none"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="theme-copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<p class="theme-copyright-text">Copyright &copy; <?php echo date( 'Y' ); ?>
					<a href="/">Autorent</a>. All rights reserved. </p>
			</div>
			<div class="col-md-6">
				<ul class="theme-copyright-social"><?php
					$result = $db->query( "SELECT * FROM socials WHERE active = 1 ORDER BY so ASC" );
					while ( $row = mysqli_fetch_assoc( $result ) )
					{
						?>
						<li>
						<a class="<?php echo $row['class']; ?>" href="<?php echo $row['linkTo']; ?>"></a>
						</li><?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>