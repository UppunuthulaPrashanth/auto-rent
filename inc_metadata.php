<base href="/">

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>



<?php

$metaTitle1      = "Autorent";

$metaTitle       = "";

$metaDesc       = "";

$metaKeyword    = "";

$query  = "SELECT * FROM meta_datas WHERE pageName = 'Home'";



switch ( $PAGEID )

{

    case "Home":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Home'";

        break;



    case "About":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'About'";

        break;



    case "Services":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Services'";

        break;



    case "Promotions":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Promotions'";

        break;



    case "Blog":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Blog'";

        break;



    case "Locations":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Locations'";

        break;



    case "Road Side Assistance":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Road Side Assistance'";

        break;



    case "Faqs":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Faqs'";

        break;



    case "Settings":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Settings'";

        break;



    case "Contact Us":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Contact Us'";

        break;



    case "Payments":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Payments'";

        break;



    case "Profile":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Profile'";

        break;



    case "Rent a Car":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Rent a Car'";

        break;



    case "Book Rent a Car":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Book Rent a Car'";

        break;



    case "Checkout":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Checkout'";

        break;



    case "Booking Confirmation":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Booking Confirmation'";

        break;



    case "Book Lease a Car":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Book Lease a Car'";

        break;



    case "Book Pay as You Go":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Book Pay as You Go'";

        break;



    case "Booking Payment":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Booking Payment'";

        break;



    case "Booking View":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Booking View'";

        break;



    case "History":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'History'";

        break;



    case "Modify Booking":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Modify Booking'";

        break;



    case "Notifications":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Notifications'";

        break;



    case "Page Book Addons":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Page Book Addons'";

        break;



    case "Lease a Cars":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Lease a Cars'";

        break;



    case "Rent a Cars":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Rent a Cars'";

        break;



    case "Pay as You Drive":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Pay as You Drive'";

        break;



     case "Pay Per Hour":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Pay Per Hour'";

        break;



    case "Addon Lease Cars":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Addon Lease Cars'";

        break;



    case "Enquiry Used Cars":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Enquiry Used Cars'";

        break;



    case "Used Cars":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Used Cars'";

        break;



    case "Used Cars Info":

        if ( isset( $_GET['slug'] ) && strlen( $_GET['slug'] ) > 0 ) {

            $query = "SELECT make,model FROM view_used_cars WHERE slug = '" . $slug . "'";

        }

        break;

		

		    case "Blog Info":

        if ( isset( $_GET['slug'] ) && strlen( $_GET['slug'] ) > 0 ) {

            $query = "SELECT title FROM news WHERE slug = '" . $slug . "'";

        }

        break;

		

		case "Rental Guide Info":

        if ( isset( $_GET['slug'] ) && strlen( $_GET['slug'] ) > 0 ) {

            $query = "SELECT title FROM rental_guide WHERE slug = '" . $slug . "'";

        }

        break;



    case "Feedbacks":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Feedbacks'";

        break;



    case "Corporate Leasing":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Corporate Leasing'";

        break;



    case "Corporate Customized Solutions":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Corporate Customized Solutions'";

        break;



    case "Book Pay as you Drive":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Book Pay as you Drive'";

        break;



    case "Rental Guide":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Rental Guide'";

        break;



    case "Login":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Login'";

        break;



    case "Terms and Conditions":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Terms and Conditions'";

        break;



    case "Rent Cars Enquiry":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Rent Cars Enquiry'";

        break;



    case "Pay as you drive Enquiry":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Pay as you drive Enquiry'";

        break;



    case "Signup":

        $query = "SELECT * FROM meta_datas WHERE pageName = 'Signup'";

        break;

		

		



}



$metaRes   = $db->query( $query );

$metaRow   = mysqli_fetch_assoc( $metaRes );



//echo $query;



if(isset($metaRow['metaTitle'])) {

    $metaTitle = $metaRow['metaTitle'];

    $metaKeyword = $metaRow['metaKeyword'];

    $metaDesc  = $metaRow['metaDescription'];

}



elseif(isset( $metaRow['title'] ) && strlen( $metaRow['title']  ) > 0)

{

	$metaTitle = $metaRow['title'];

}



else

{

    $carInfoTitles = $metaRow['make'] . " " . $metaRow['model'] . " | Autorent";

    $metaTitle = $carInfoTitles;

    if(empty($carInfoTitles))

    {

        $metaTitle = $metaTitle1;

        $metaRow['metaKeyword'] = "";

        $metaRow['metaDescription'] = "";

    }

}



?>





<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"/>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<link rel="stylesheet" href="css/font-awesome.css"/>



<link rel="stylesheet" href="css/lineicons.css"/>

<link rel="stylesheet" href="css/weather-icons.css"/>

<link rel="stylesheet" href="css/bootstrap.css"/>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">



<!--tooltip-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!--tooltip-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>



<link rel="stylesheet" href="css/styles.css"/>
<link rel="stylesheet" href="css/bootstrap.scss"/>


<link rel="stylesheet" href="css/custom.css"/>

<!--Favicon-->

<link rel="shortcut icon" href="data/favicon.png" type="image/x-icon">

<link rel="icon" href="data/favicon.png" type="image/x-icon">



<title><?php echo $metaTitle; ?></title>

<meta name = "keywords" content = "<?php echo $metaKeyword; ?>" />

<meta name = "description" content = "<?php echo $metaDesc; ?>" />


<meta name="google-site-verification" content="azReg_X5J19RyiEAFZJLfnHZTjHtMQ00kN5eXjsfvlw" />


<!--Start of Zendesk Chat Script-->

<script type="text/javascript">

window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=

d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.

_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");

$.src="https://v2.zopim.com/?1dhAIQt76G8ECa6HumRmek1QuRy39cqC";z.t=+new Date;$.

type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");

</script>

<!--End of Zendesk Chat Script-->







<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-3335STM51B"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



 



  gtag('config', 'G-3335STM51B');

</script>