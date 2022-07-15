<div class="theme-footer" id="mainFooter">
	<div class="container _ph-mob-0">
		<div class="row row-eq-height row-mob-full" data-gutter="60">
			<div class="col-md-3">
				<div class="theme-footer-section theme-footer-">
					<a class="theme-footer-brand _mb-mob-30" href="#"> <img src="uploads/pages/logo-web-footer.png" alt="Autorent" title="Autorent"/> </a>
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
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-3">
						<div class="theme-footer-section theme-footer-">
							<h5 class="theme-footer-section-title">Monthly Rentals</h5>
							<ul class="theme-footer-section-list">
								<li>
									<a href="/rent-cars/Dubai">Car Rental in Dubai </a>
								</li>
								
								<li>
									<a href="/rent-cars/Abu Dhabi">Car Rental in Abu Dhabi</a>
								</li>
								<li>
									<a href="/rent-cars/Sharjah">Car Rental in Sharjah </a>
								</li>
<li>
									<a href="/rent-cars/Ras Al Khaimah">Car Rental in Ras Al Khaimah </a>
								</li>

							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="theme-footer-section theme-footer-">
							<h5 class="theme-footer-section-title">By Brand</h5>
							<ul class="theme-footer-section-list">
								<li>
									<a href="#">Rent Nissan Cars</a>
								</li>
								<li>
									<a href="#">Rent Toyota Cars</a>
								</li>
								
								<li>
									<a href="#">Rent Mitsubishi Cars</a>
								</li>
<li>
									<a href="#">Rent Kia Cars</a>
								</li>

							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="theme-footer-section theme-footer-">
							<h5 class="theme-footer-section-title"></h5><br>
							<ul class="theme-footer-section-list">
								<li>
									<a href="#">Rent Chevrolet Cars</a>
								</li>
								<li>
									<a href="#">Rent Dodge Cars</a>
								</li>
								<li>
									<a href="#">Rent Infiniti Cars</a>
								</li>
								<li>
									<a href="#">Rent Renault Cars</a>
								</li>


							</ul>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="theme-footer-section theme-footer-">
							<h5 class="theme-footer-section-title"></h5><br>
							<ul class="theme-footer-section-list">
								<li>
									<a href="#">Rent Lexus Cars</a>
								</li>
								<li>
									<a href="#">Rent BMW Cars</a>
								</li>
								<li>
									<a href="#">Rent Ferrari Cars</a>
								</li>
								<li>
									<a href="#">Rent Suzuki Cars</a>
								</li>


							</ul>
						</div>
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