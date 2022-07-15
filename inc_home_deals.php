<?php
$countResult = $db->query( "SELECT * FROM promotions WHERE active = 1 ORDER BY so DESC" );
$counter = mysqli_num_rows($countResult);
if($counter > 1)
{
?>

<div class="theme-page-section theme-page-section-xxl">
	<div class="container _pv-40">
		<div class="theme-page-section-header">
			<?php
			$pageID = '13';
			$result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
			$row    = mysqli_fetch_assoc( $result );
			?>
			<h5 class="theme-page-section-title title-blue"><?php echo $row['pageTitle'] ?> </h5>
			<p class="theme-page-section-subtitle"><?php echo $row['subTitle']; ?></p>
		</div>
		<div class="row row-col-mob-gap" data-gutter="10">
			<?php
			$promotionResult = $db->query( "SELECT * FROM promotions WHERE active = 1 ORDER BY so DESC limit 3 " );
			while ( $promotionRow = mysqli_fetch_assoc( $promotionResult ) )
			{
				?>
				<div class="col-md-4 ">
					<div class="banner _br-5 banner-animate banner-animate-mask-in banner-animate-zoom-in">
						<img class="banner-img" src="uploads/promotions/<?php echo $promotionRow['homeImage']; ?>" alt="<?php echo $promotionRow['title']; ?>" title="<?php echo $promotionRow['title']; ?>"/>
						<div class="banner-mask"></div>
						<a class="banner-link" href="#"></a>
						<div class="banner-caption _ta-c _pb-20 _pt-20 banner-caption-bottom banner-caption-grad">
							<h4 class="banner-title _fs"><?php echo $promotionRow['title']; ?></h4>
							<p class="banner-subtitle _fw-n _mt-5"><?php echo $promotionRow['summary']; ?></p>
						</div>
					</div>
				</div>
				<?php
			}
			?>

		</div>
	</div>
</div>
<?php } ?>