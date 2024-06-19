<?php 
session_start();
$username_hondel = $_SESSION["username_h"];
$theusername = $username_hondel;
$fname = $_SESSION["firstname"];
$lname =  $_SESSION["lastname"] ;
$email = $_SESSION["email"] ;
$sex = $_SESSION["sex"];
$phone = $_SESSION["phone"];
if(isset($_POST["create"])){
  $dob = $_POST["dob"];
  $marry = $_POST["marry"];
  $work = $_POST["work"];
  $addr = $_POST["addr"];
  $type = $_POST["type"];
  $currency = $_POST["currency"];
  $userpassword = $_POST["upass"];
  $randAcct = rand(0,999999999). rand(0,9);
  $theip = "";
  $ip = array(
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
  );
  foreach ($ip as $key){
    if(isset($_SERVER[$key])){
      $theip .= $_SERVER[$key];
    }
  }

  $curlRequest = curl_init();
  $url = "http://localhost:70/bankproject/hondelapi.php";
  curl_setopt($curlRequest, CURLOPT_URL,$url);
  curl_setopt($curlRequest, CURLOPT_POST, true);
  // set thepost data to be sent
  $data = [
    'fname'=> $fname,
    'lname' => $lname,
    'username'=> $username_hondel,
    'email' => $email,
    'sex' => $sex,
    'phone' => $phone,
    'dob' => $dob,
    'marry' => $marry,
    'work' => $work,
    'addr' => $addr,
    'acctType' => $type,
    'currency' => $currency,
    'userpassword' => $userpassword,
    'AcctNum' => $randAcct,
    'ip' => $theip
  ];
  curl_setopt($curlRequest, CURLOPT_POSTFIELDS, http_build_query($data));
  // set headers
  $headers = array(
    'Content-type:application/x-www-form-urlencoded'
  );
  curl_setopt($curlRequest, CURLOPT_HTTPHEADER, $headers);
  //return string
  curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);
  //execute the request and store the response
  $response = curl_exec($curlRequest);
  // checking for errors 
  if(curl_errno($curlRequest)){
    echo 'curl error:'. curl_error($curlRequest);
  }else{
    parse_str($response, $parsed_response);
    
    // Access the response data
   if($parsed_response['status']  === "success"){
    header("Location: enroll_success.php");
   }else{
    echo "error";
    echo $response;
   }
  }
  curl_close($curlRequest);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="hondelbank.jpg">
	  <meta name="description" content="Manage your banking and business in one place. Open a business bank account in 5 minutes, built to
	  help you succeed. Entrepreneurs 💜 United Financial Trust">
	  <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
	  <link rel="canonical" href=""><title>Bank Enrollment | Business banking for entrepreneurs</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="https://unitedfinancialtrust.org/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://unitedfinancialtrust.org/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="https://unitedfinancialtrust.org/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function () {
    $("#loader").fadeOut(1000);
});
</script>

<style>
 #loader
{
    position: fixed;
    z-index: 9999999;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    background: url('https://unitedfinancialtrust.org/assets/loader.gif') 50% 50% no-repeat #f9f9f9;
}
</style>

</head>

<body class="">
  <div id="loader"></div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" 
			  style="background-image: url('https://unitedfinancialtrust.org/assets/img/bg4.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
			
				<center>	<a href="  ">
        <img src="hondelbank.jpg"   height="60px" width="100px" alt="main_logo"> 
      </a></center>
				<hr>
				
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Enrollment Section Two</h4> 
                </div>
                <div class="card-body">
                    
                 	                                             
                                 <form  action="" method="POST" role="form" enctype="multipart/form-data">
                   
                   <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Date of Birth</label>
                      <input type="date" class="form-control" name="dob" required >
                    </div>
                   
                   
                   
                    <div class="input-group input-group-outline mb-3">
                      <select class="form-control"  name="marry" required="">
                                                <optio>Marital Status</optio>
                                                 <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                    </div>
                    
                   
                        <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Occupation</label>
                      <input type="text" class="form-control" name="work" required >
                    </div>
                   
                   
                        <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Official Address</label>
                      <input type="text" class="form-control" name="addr" required >
                    </div>
                   
                   
                   
                    <div class="input-group input-group-outline mb-3">
                      	<select class="form-control" id="" name="type" required="">
                                               <option>Account Type</option>
                                                <option value="Savings">Savings</option>
                                                <option value="Current">Current</option>
                                                 <option value="Checking">Checking</option>
                                                <option value="Fixed Deposit">Fixed Deposit</option>
                                                 <option value="NON-Resident">NON-Resident</option>
                                                <option value="Online Banking">Online Banking</option>
                                                 <option value="Joint Account">Joint Account</option>
                                                <option value="DOMICILIARY ACCOUNT">DOMICILIARY ACCOUNT</option>
                                          
                                             </select>
                    </div>
                   
                   
                   
                    <div class="input-group input-group-outline mb-3">
                     <select class="custom-select form-control"  name="currency"  required>
                         <option>Select Currency</option>
                                            <option value="$">America (United States) Dollars � USD</option>
                                                <option value="AFN">Afghanistan Afghanis � AFN</option>
                                                <option value="ALL">Albania Leke � ALL</option>
                                                <option value="DZD">Algeria Dinars � DZD</option>
                                                <option value="ARS">Argentina Pesos � ARS</option>
                                                <option value="AUD">Australia Dollars � AUD</option>
                                                <option value="ATS">Austria Schillings � ATS</OPTION>
                                                 
                                                <option value="BSD">Bahamas Dollars � BSD</option>
                                                <option value="BHD">Bahrain Dinars � BHD</option>
                                                <option value="BDT">Bangladesh Taka � BDT</option>
                                                <option value="BBD">Barbados Dollars � BBD</option>
                                                <option value="BEF">Belgium Francs � BEF</OPTION>
                                                <option value="BMD">Bermuda Dollars � BMD</option>
                                                 
                                                <option value="BRL">Brazil Reais � BRL</option>
                                                <option value="BGN">Bulgaria Leva � BGN</option>
                                                <option value="CAD">Canada Dollars � CAD</option>
                                                <option value="XOF">CFA BCEAO Francs � XOF</option>
                                                <option value="XAF">CFA BEAC Francs � XAF</option>
                                                <option value="CLP">Chile Pesos � CLP</option>
                                                 
                                                <option value="CNY">China Yuan Renminbi � CNY</option>
                                                <option value="CNY">RMB (China Yuan Renminbi) � CNY</option>
                                                <option value="COP">Colombia Pesos � COP</option>
                                                <option value="XPF">CFP Francs � XPF</option>
                                                <option value="CRC">Costa Rica Colones � CRC</option>
                                                <option value="HRK">Croatia Kuna � HRK</option>
                                                 
                                                <option value="CYP">Cyprus Pounds � CYP</option>
                                                <option value="CZK">Czech Republic Koruny � CZK</option>
                                                <option value="DKK">Denmark Kroner � DKK</option>
                                                <option value="DEM">Deutsche (Germany) Marks � DEM</OPTION>
                                                <option value="DOP">Dominican Republic Pesos � DOP</option>
                                                <option value="NLG">Dutch (Netherlands) Guilders � NLG</OPTION>
                                                 
                                                <option value="XCD">Eastern Caribbean Dollars � XCD</option>
                                                <option value="EGP">Egypt Pounds � EGP</option>
                                                <option value="EEK">Estonia Krooni � EEK</option>
                                                <option value="EUR">Euro � EUR</option>
                                                <option value="FJD">Fiji Dollars � FJD</option>
                                                <option value="FIM">Finland Markkaa � FIM</OPTION>
                                                 
                                                <option value="FRF*">France Francs � FRF*</OPTION>
                                                <option value="DEM">Germany Deutsche Marks � DEM</OPTION>
                                                <option value="XAU">Gold Ounces � XAU</option>
                                                <option value="GRD">Greece Drachmae � GRD</OPTION>
                                                <option value="GTQ">Guatemalan Quetzal � GTQ</OPTION>
                                                <option value="NLG">Holland (Netherlands) Guilders � NLG</OPTION>
                                                <option value="HKD">Hong Kong Dollars � HKD</option>
                                                 
                                                <option value="HUF">Hungary Forint � HUF</option>
                                                <option value="ISK">Iceland Kronur � ISK</option>
                                                <option value="XDR">IMF Special Drawing Right � XDR</option>
                                                <option value="INR">India Rupees � INR</option>
                                                <option value="IDR">Indonesia Rupiahs � IDR</option>
                                                <option value="IRR">Iran Rials � IRR</option>
                                                 
                                                <option value="IQD">Iraq Dinars � IQD</option>
                                                <option value="IEP*">Ireland Pounds � IEP*</OPTION>
                                                <option value="ILS">Israel New Shekels � ILS</option>
                                                <option value="ITL*">Italy Lire � ITL*</OPTION>
                                                <option value="JMD">Jamaica Dollars � JMD</option>
                                                <option value="JPY">Japan Yen � JPY</option>
                                                 
                                                <option value="JOD">Jordan Dinars � JOD</option>
                                                <option value="KES">Kenya Shillings � KES</option>
                                                <option value="KRW">Korea (South) Won � KRW</option>
                                                <option value="KWD">Kuwait Dinars � KWD</option>
                                                <option value="LBP">Lebanon Pounds � LBP</option>
                                                <option value="LUF">Luxembourg Francs � LUF</OPTION>
                                                 
                                                <option value="MYR">Malaysia Ringgits � MYR</option>
                                                <option value="MTL">Malta Liri � MTL</option>
                                                <option value="MUR">Mauritius Rupees � MUR</option>
                                                <option value="MXN">Mexico Pesos � MXN</option>
                                                <option value="MAD">Morocco Dirhams � MAD</option>
                                                <option value="NLG">Netherlands Guilders � NLG</OPTION>
                                                 
                                                <option value="NZD">New Zealand Dollars � NZD</option>
                                                <option value="NOK">Norway Kroner � NOK</option>
                                                <option value="OMR">Oman Rials � OMR</option>
                                                <option value="PKR">Pakistan Rupees � PKR</option>
                                                <option value="XPD">Palladium Ounces � XPD</option>
                                                <option value="PEN">Peru Nuevos Soles � PEN</option>
                                                 
                                                <option value="PHP">Philippines Pesos � PHP</option>
                                                <option value="XPT">Platinum Ounces � XPT</option>
                                                <option value="PLN">Poland Zlotych � PLN</option>
                                                <option value="PTE">Portugal Escudos � PTE</OPTION>
                                                <option value="QAR">Qatar Riyals � QAR</option>
                                                <option value="RON">Romania New Lei � RON</option>
                                                 
                                                <option value="ROL">Romania Lei � ROL</option>
                                                <option value="RUB">Russia Rubles � RUB</option>
                                                <option value="SAR">Saudi Arabia Riyals � SAR</option>
                                                <option value="XAG">Silver Ounces � XAG</option>
                                                <option value="SGD">Singapore Dollars � SGD</option>
                                                <option value="SKK">Slovakia Koruny � SKK</option>
                                                 
                                                <option value="SIT">Slovenia Tolars � SIT</option>
                                                <option value="ZAR">South Africa Rand � ZAR</option>
                                                <option value="KRW">South Korea Won � KRW</option>
                                                <option value="ESP">Spain Pesetas � ESP</OPTION> 
                                                 
                                                <option value="SDD">Sudan Dinars � SDD</option>
                                                <option value="SEK">Sweden Kronor � SEK</option>
                                                <option value="CHF">Switzerland Francs � CHF</option>
                                                <option value="TWD">Taiwan New Dollars � TWD</option>
                                                <option value="THB">Thailand Baht � THB</option>
                                                <option value="TTD">Trinidad and Tobago Dollars � TTD</option>
                                                 
                                                <option value="TND">Tunisia Dinars � TND</option>
                                                <option value="TRY">Turkey New Lira � TRY</option>
                                                <option value="AED">United States Dirhams � AED</option>
                                                <option value="GBP">United Kingdom Pounds � GBP</option>
                                                <option value="$">United States Dollars � USD</option>
                                                <option value="VEB">Venezuela Bolivares � VEB</option>
                                                 
                                                <option value="VND">Vietnam Dong � VND</option>
                                                <option value="ZMK">Zambia Kwacha � ZMK</option>
                                                
                                                                            </select>
                    </div>
                    
                    
                    
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" name="upass" class="form-control" required>
                    </div>
                    
                    <input type="hidden" class="form-control" name="mname" value="-" > 
                	  <input class="form-control" name="pin_auth" type="hidden" value="1993700101" required >
                                 <input type="hidden"  value=" 02/06/2024" name="reg_date" >  
                             <input type="hidden" name="acc_no"  id="acc_no" 
                             
                             value="1858946919" />
                             
                          
                            <input type="text" name="cot" class="input100" value="1047876307" hidden>
                            <input type="text" name="tax" class="input100" value="417294921" hidden>
                            <input type="text" name="imf" class="input100" value="383425886" hidden> 
                            <input type="text" name="pin" class="input100" value="1070433187" hidden>
                            <input type="text" name="verify" class="input100" value="Y" hidden>
                             <input type="text" name="status" class="input100" value="ACTIVE" hidden>
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked required>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="create" class="btn btn-lg  btn-lg w-100 mt-4 mb-0"  style="background-color:#180d3e; color:white;">SEND</button>
                    </div>
                  </form>
                   <center><a href="hondelbanksignup.php" class="text-primary text-gradient font-weight-bold">GO BACK</a></center>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="https://unitedfinancialtrust.org/assets/js/core/popper.min.js"></script>
  <script src="https://unitedfinancialtrust.org/assets/js/core/bootstrap.min.js"></script>
  <script src="https://unitedfinancialtrust.org/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="https://unitedfinancialtrust.org/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
 
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="https://unitedfinancialtrust.org/assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>
 
 
 
 
 
 
 
 
 
 
 
 
 
 