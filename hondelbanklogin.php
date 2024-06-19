<?php
session_start();

if(isset($_POST["login"])){
  $acct_number = $_POST["acc_no"];
$password_login = $_POST["upass"];
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
    'acct_number' => $acct_number,
    'password_login' => $password_login,
    'ip_login' => $theip
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
    if(isset($parsed_response['status'])){
      if($parsed_response['status']=== "success"){
        $_SESSION["the_acct_session"] = $parsed_response['the_acct_sess'];
        header("Location: hondelapi.php");
        exit;
      }else if ($parsed_response['status'] === "Found_login"){
        //$error = $parsed_response['status'];
        $_SESSION["the_acct_session"] = $parsed_response['the_acct_sess'];
        header("Location: hondelbankhome.php");
        exit;
      }
    }else{
      $error = $response;
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
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
	  <link rel="canonical" href=""><title>Hondel Financial Trust Bank | Business banking for entrepreneurs</title>
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
  
  
  <!-- Pixel Code for https://www.widgetsquad.com/ -->
<script async src="https://www.widgetsquad.com/pixel/hkvwvv0ykwov5e67wd2uo3swsvesqs4w"></script>
<!-- END Pixel Code -->
</head>

<body class="bg-gray-200">
<div id="loader"></div>


  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image:url(https://unitedfinancialtrust.org/assets/img/bg3.jpg);">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="shadow-primary border-radius-lg py-3 pe-1"  style="background-color:#230C33;">
				
			<center>	<a href="  ">
        <img src="hondelbank.jpg"   height="60px" width="100px" alt="main_logo"> 
      </a></center>
				<hr>
				
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">  <i class="material-icons opacity-10">account_balance</i> Banking Login</h4>
     
                </div>
              </div>
              <div class="card-body">
                <div class="error_handeling"> <?php if(isset($error)){echo $error;} ?> </div>
			                            				 <form  action=""  method="POST" role="form" class="text-start">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Account Number</label>
                    <input type="text" class="form-control"  name="acc_no" required>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="upass" required  >
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember this Device</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="login" class="btn w-100 my-4 mb-2" style="background-color:#dc3545; color:white;">  <i class="material-icons opacity-10">account_balance</i> Authorize</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="hondelbanksignup.php" class="text-primary text-gradient font-weight-bold">Enroll Now</a>
					<hr>
					<a href="#" class="text-primary text-gradient font-weight-bold">Visit Main Website</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
 
    </div>
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
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="https://unitedfinancialtrust.org/assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>
 
	 
	 

                         
                     
                     
	
 
	 
 
	 
	 