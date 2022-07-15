<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Header and Footer example</title>
<style type="text/css">
.clear:after {
  clear: both;
  content: "";
  display: block;
}
h1,
h2,
h3,
p,
span {
  margin: 0;
  padding: 0;
}
.container {
  border-bottom: none;
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
.header .small-header .left,
.header .small-header .right {
  font-size: 14px;
}
.header .small-header .right{
  text-align: right;
}
.header .small-header .left{
  text-align: left;
}
.header .small-header .left {
  width: 30%;
}
.header .small-header .right {
  text-align: center;
  width: 70%;
}
.header .logo-sec {
  padding: 15px 0;
  border-bottom: 1px solid #999999;
}
.header .logo-sec:after {
  clear: both;
  content: "";
  display: block;
}
.header .logo-sec .left,
.header .logo-sec .right {
 display: inline-block;
}
.header .logo-sec .left img {
  width: 168px;
}
.header .logo-sec .right h2 {
  text-align: right;
  font-size: 18px;
  line-height: 66px;
}
.header .one-sec {
  padding: 15px 0;
  border-bottom: 1px solid #999999;
}
.header .one-sec h2 {
  font-size: 19px;
  margin-bottom: 5px;
}
.header .one-sec p {
  font-size: 14px;
}
.main-body .top-sec:after {
  clear: both;
  content: "";
  display: block;
}
.main-body .top-sec .left,
.main-body .top-sec .right {
  display: inline-block;
}
.main-body .top-sec .left {
  width: 60%;
}
.main-body .top-sec .right {
  width: 40%;
  text-align: right;
}
.main-body .inner-body {
  padding: 15px 15px;
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
  padding: 7px 2px;
}
.main-body .inner-body .table1 tbody tr td p {
  font-size: 14px;
}
.main-body .inner-body .table2 {
  width: 100%;
}
.main-body .inner-body .table2 tbody tr td {
  font-size: 16px;
  padding: 4px 2px;
}
.main-body .inner-body .table2 tbody tr td p {
  font-size: 14px;
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

 
</style>
  
</head>

<body>
    <div class="container">
    <div class="header">
      <div class="small-header">
        <div class="left">
        <p>12/42/1424</p>
        </div>
        <div class="right">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, vitae!</p>
        </div>
      </div>
      <div class="logo-sec">
      <table>
        <tbody>
          <tr>
            <td>
               <img src="http://autorent-me.com/new/images/logo.png" alt="">
            </td>
            <td>
               <h2>php code here.......".
                <?php
                   $id="232";
                   echo $id; 
                ?>
                </h2>
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
          <div class="left">
            <p><b>reservationsdept@cartrawler.com</b> reservationsdept@cartrawler.com</p>
            <p>Reply-To: reservationsdept@cartrawler.com</p>
            <p>To: reservationsdept@cartrawler.com</p>
          </div>
          <div class="right">
            <p>Sun , Nov 8, 2015 at 5:01</p>
          </div>
        </div>
        <div class="inner-body">
          <p>PLEASE,DO NOT REPLY TO THIS EMAIL.USE ONE OF THE LINKS BELOW.THANKS.</p>
          <p>POR FAVOR,NO RESPONDA A ESTE CORREO.UTILICE UNO DE LOS ENLACES DE ABAJO.GRACIAS.</p>
          <p>NON RISPONDERE A QUESTO EMAIL.USARE UNO DEI LINKI AL DI SOTTO PER FAVORE.GRACIE.</p>
          <p>BITTE NICHT AUF DIESE EMAIL ANTWORTEN! BENUTZEN SIE EINEN DER LINKS AM ENDE DIESER EMAIL.</p>
          <div class="table-sec">
              <table  class="table1">
                <tbody >
                  <tr>
                    <td>
                    Booking request form
                    </td>
                    
                  </tr>
                    <tr>
                    
                    <td>Please confirm availability for the following booking.</td>
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
                    <td>AED 223232:00</td>
                  </tr>
                </tbody>
              </table>
              <table class="table4" border="1">
                <tbody>
                  <tr>
                    <td>Blance Due on Arrival <br>Not including extras</td>
                    <td>AED 223232:00</td>
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
                        <td>AED 223232:00</td>
                    </tr>
                  </tbody>
                </table>

          </div>
        
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati corporis dolores, animi deserunt ipsum neque.</p>
        
        </div>
<p class="link">https://mail.google.com/mail/u/1/?ui=2&ik=67d3afd791&view=pt&q=cartrawler%20booking&qs=true&search=query&th=150e72fa080e61c0&siml=150e72fa080...</p>
    </div>
  
    </div> 
  
   </body>
   </html>
