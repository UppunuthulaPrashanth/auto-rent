<?php
require_once("dompdf_config.inc.php");

$string  = 'php tested variable code';

$html =
  '<!DOCTYPE html>
 <html class="no-js"> <!--<![endif]-->
    <head>
     <style>
    
     .clear:after {
  clear: both;
  content: "";
  display: block;
}

h1,
h2,
h3,
p,
span,body {
  margin: 0;
  padding: 0;
  font-family: "Open Sans", sans-serif;
}
.container {
  border-bottom: none;
}
table td{
  padding:2px 5px;
}
.container:after {
  clear: both;
  content: "";
  display: block;
}
.header .small-header:after {
  clear: both;
  content: "";
  display: block;
}
.header .small-header table {
  width: 100%;
}
.header .logo-sec {
  padding: 7px 0;
  border-bottom: 1px solid #999999;
}
.header .logo-sec table {
  width: 100%;
}
.header .logo-sec:after {
  clear: both;
  content: "";
  display: block;
}
.header .logo-sec img {
  width: 168px;
}
.header .logo-sec h2 {
  text-align: right;
  font-size: 14px;
  line-height: 20px;
}
.header .one-sec {
  padding: 7px 0;
  border-bottom: 1px solid #999999;
}
.header .one-sec h2 {
  font-size: 16px;
  margin-bottom: 5px;
}
.header .one-sec p {
  font-size: 12px;
}
.main-body .top-sec:after {
  clear: both;
  content: "";
  display: block;
}
.main-body .top-sec .left,
.main-body .top-sec table {
  width: 100%;
}

.main-body .inner-body {
  padding: 5px 15px;
}
.main-body .inner-body p {
  font-size: 11px;
  line-height: 17px;
}
.main-body .inner-body:after {
  clear: both;
  content: "";
  display: block;
}
.main-body .inner-body table {
  border: 1px solid #000;
  margin-bottom: 2px;
}
.main-body .inner-body .table-sec {
  padding: 2px;
  border: 1px solid #999999;
}
.main-body .inner-body .table1 {
  width: 100%;
}

.main-body .inner-body .table1 tbody tr td {
  padding: 8px 2px;
  font-size: 13px;
}
.main-body .inner-body .table1 tbody tr td p {
  font-size: 13px;
}
.main-body .inner-body .table2 {
  width: 100%;
}
.main-body .inner-body .table2 tbody tr td {
  font-size: 12px;
  padding: 4px 2px;
}
.main-body .inner-body .table2 tbody tr td p {
  font-size: 13px;
}
.main-body .inner-body .table3 {
  width: 100%;
}
.main-body .inner-body .table3 tbody {
  background: #999999;
}
.main-body .inner-body .table4 {
  width: 100%;
}
.main-body .inner-body .table4 th {
   font-size: 14px;
}
.main-body .inner-body .table4 td {
   font-size: 13px;
}
</style>
 </head>
<body>
    <div class="container">
    <div class="header">
      <div class="small-header">
       <table>
        <tbody>
          <tr>
            <td >
               <p style="font-size:10px;" >12/42/1424</p>
            </td>
            <td>
                <p style="text-align:center;font-size:11px;">Autorent Car Rental LLC Mail - Please Confirm AE35435353 </p>
            </td>
          </tr>
        </tbody>
      </table>
       
      </div>
      <div class="logo-sec">
      <table>
        <tbody>
          <tr>
            <td>
               <img src="logo.png"  style=" width: 130px;" alt="">
            </td>
            <td>
               <h2>Hiren Parikh &#60;hiren@autorent-me.com&#62; </h2>
            </td>
          </tr>
        </tbody>
      </table>
       
      </div>
      <div class="one-sec">
        
        <div class="right">
          <h2>Please Confirm AE534535353245353</h2>
          <p>1 message</p>
        </div>
      </div>
    </div>

    <div class="main-body">
        <div class="top-sec">

          <table>
          <tbody>
            <tr>
              <td>
                <p style="font-size:13px"><b>reservationsdept@cartrawler.com</b> <span style="font-size:12px;"> &#60;reservationsdept@cartrawler.com&#62;</span></p>
                <p style="font-size:13px;">Reply-To: reservationsdept@cartrawler.com</p>
                <p style="font-size:13px;">To: bookings@autorent-me.com</p>
              </td>
              <td>
                  <p style="font-size:12px;margin-top:-22px">Sun , Nov 8, 2015 at 5:01 PM</p>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
        <div class="inner-body">
          <p style="font-size:9px;padding-bottom:4px">PLEASE,DO NOT REPLY TO THIS EMAIL.USE ONE OF THE LINKS BELOW.THANKS.</p>
          <div class="table-sec">
              <table  class="table1">
                <tbody >
                  <tr>
                    <td>
                     <p style="padding-bottom:5px">Booking request form</p>
                      <p>Please confirm availability for the following booking.</p>
                    
                    </td>
                    
                  </tr>
                  
                    
                </tbody>
              </table>

              <table  class="table2">
                <tbody >
                  <tr>
                    <td>
                       Ref no:
                    </td>
                    <td>
                       AE242424242
                    </td>
                    <td>Customer name:</td>
                    <td>Kadir Yildirim</td>
                  </tr>
                  <tr>
                    <td>Pick up date & time:</td>
                    <td>15 Nov 2014, 9.00</td>
                    <td>Customer Phone:</td>
                    <td>+2425236t2 2342 234</td>
                  </tr>
                  <tr>
                  <td>Customer address::</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Pick up location:</td>
                  <td>Car Agent: Dubai Airport </td>
                </tr>
                <tr>
                  <td>Drop off date & time:</td>
                  <td>23 Nov 20245, 9:00 </td>
                </tr>
                <tr>
                  <td>Drop off location:</td>
                  <td>Car Agent: Dubai Airport </td>
                </tr>
                    
                </tbody>
              </table>

                <table  class="table2">
                <tbody >
                  <tr>
                    <td>
                      Group Name:
                    </td>
                    <td>
                      Group L - LDAR
                    </td>
                    
                  </tr>
                  <tr>
                  
                    <td>Car Name:</td>
                    <td>BMW 453i or similar<br>
                        BMW 453i or similar</td>
                  </tr>
                  <tr>
                  <td>Account No:</td>
                  <td>POA</td>
                </tr>
                <tr>
                  <td>IATA/Pseudo IATA Code:</td>
                  <td>---</td>
                </tr>
                <tr>
                  <td>Plan/Contract Name:</td>
                  <td>DB Supplier:AE :Autorent Car Rental LLC poa = all Src </td>
                </tr>
                <tr>
                  <td>Contract ID/Number:</td>
                  <td>Client to pay or arrival</td>
                </tr>
                <tr>
                  <td>Rate Code:</td>
                  <td>---</td>
                </tr>
                <tr>
                  <td>Car Agent Name:</td>
                  <td>DB Supplier:AE :Autorent Car Rental LLC poa = all Src </td>
                </tr>
                <tr>
                  <td>Airline:</td>
                  <td>---</td>
                </tr>
                <tr>
                  <td>Flight No:</td>
                  <td>---</td>
                </tr>
                </tbody>
              </table>
              <table class="table3"><tbody><tr><td></td></tr></tbody></table>
              <table class="table3"><tbody><tr><td></td></tr></tbody></table>
                <table class="table4" border="1">
                <tbody>
                  <tr>
                    <td>Net Rate </td>
                    <td>2232:00</td>
                    <td>4 days</td>
                    <td style="text-align:center;">AED 223232:00</td>
                  </tr>
                </tbody>
              </table>
              <table class="table4" border="1">
                <tbody>
                  <tr>
                    <td>Blance Due on Arrival <br>Not including extras</td>
                    <td style="text-align:center;">AED 223232:00</td>
                  </tr>
                </tbody>
              </table>

                <table class="table4" border="1">
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Included in price quoted online</th>
                    <th>Payable at Counter</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                  <tbody>
                    <tr>
                      <td>Other Fees</td>
                      <td>Yes</td>
                      <td>Yes</td>
                        <td style="text-align:center;">AED 223232:00</td>
                    </tr>
                  </tbody>
                </table>

          </div>
        
    
        </div>
    </div>
  
    </div> 
  
   </body>
   </html>
';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");

?>