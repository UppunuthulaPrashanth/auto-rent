<?php
$pageID = '29';
$result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
$row    = mysqli_fetch_assoc( $result );
?>

<div class="theme-page-section theme-page-section-xl " style="padding:90px 0px;">
	<div class="container _pv-40">
		<div class="theme-page-section-header">
			<h5 class="theme-page-section-title title-blue"><?php echo $row['pageTitle']; ?></h5>
			<p class="theme-page-section-subtitle"></p>
		</div>
		
		<div class="row row-col-mob-gap">
				<div class="col-md-12 ">
					<img class="img-responsive" src="uploads/pages/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>">
				</div>
		</div>
	</div>
</div>
