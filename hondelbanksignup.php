<?php
session_start();
if(isset($_POST['submit'])){
  $_SESSION["username_h"] = $_POST["uname"];
$_SESSION["firstname"] = $_POST["fname"];
$_SESSION["lastname"] = $_POST["lname"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["sex"] = $_POST["sex"];
$_SESSION["phone"] = $_POST["phone"];
header("Location: auth_enroll.php");
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
  <link rel='apple-touch-icon' sizes='76x76' href='assets/img/apple-icon.png'>
  <link rel='icon' type='image/png' href='hondelbank.jpg'>
	  <meta name='description' content='Manage your banking and business in one place. Open a business bank account in 5 minutes, built to
	  help you succeed. Entrepreneurs ðŸ’œ United Financial Trust'>
	  <meta name='ROBOTS' content='NOINDEX, NOFOLLOW'>
	  <link rel='canonical' href=''><title>Bank Enrollment | Business banking for entrepreneurs</title>
  <!--     Fonts and icons     -->
  <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700' />
  <!-- Nucleo Icons -->
  <link href='https://unitedfinancialtrust.org/assets/css/nucleo-icons.css' rel='stylesheet' />
  <link href='https://unitedfinancialtrust.org/assets/css/nucleo-svg.css' rel='stylesheet' />
  <!-- Font Awesome Icons -->
  <script src='https://kit.fontawesome.com/42d5adcbca.js' crossorigin='anonymous'></script>
  <!-- Material Icons -->
  <link href='https://fonts.googleapis.com/icon?family=Material+Icons+Round' rel='stylesheet'>
  <!-- CSS Files -->
  <link id='pagestyle' href='https://unitedfinancialtrust.org/assets/css/material-dashboard.css?v=3.0.0' rel='stylesheet' />



<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>
<script type='text/javascript'>
$(window).load(function () {
    $('#loader').fadeOut(1000);
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

<body class=''>
  <div id='loader'></div>
  <main class='main-content  mt-0'>
    <section>
      <div class='page-header min-vh-100'>
        <div class='container'>
          <div class='row'>
            <div class='col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column'>
              <div class='position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center' 
			  style='background-image: url("https://unitedfinancialtrust.org/assets/img/bg4.jpg"); background-size: cover;'>
              </div>
            </div>
            <div class='col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5'>
			
				<center>	<a href='  '>
        <img src='hondelbank.jpg'   height='60px' width='100px' alt='main_logo' style='margin-top:20px;'> 
      </a></center>
				<hr>
				
              <div class='card card-plain'>
                <div class='card-header'>
                  <h4 class='font-weight-bolder'>Enrollment Section One</h4>
                  <p class='mb-0'>Ensure you complete all fields</p>
                </div>
                <div class='card-body'>
                    
                 	 
                       
                                 <form  action='' method='POST' role='form' enctype='multipart/form-data'>
                                     
                                 
                                     
                    <div class='input-group input-group-outline mb-3'>
                      <label class='form-label'>First Name</label>
                      <input type='text' class='form-control' name='fname'  value='' required >
                    </div>
                    
                     <div class='input-group input-group-outline mb-3'>
                      <label class='form-label'>Last Name</label>
                      <input type='text' class='form-control' name='lname' value='' required >
                    </div>
                     
                    <div class='input-group input-group-outline mb-3'>
                      <label class='form-label'>Email</label>
                      <input type='email' class='form-control' name='email'  value='' required>
                    </div>
                    
                    <div class='input-group input-group-outline mb-3'>
                      <label class='form-label'>Username</label>
                      <input type='text' class='form-control' name='uname' value='' required >
                    </div>
                    
                    <div class='input-group input-group-outline mb-3'> 
                       <select class='form-control'  name='sex' required='' value=''>
                                                <option value=''>Select Gender</option>
                                                <option value='Male'>Male</option>
                                                <option value='Female'>Female</option>
                                                <option value='Others'>Others</option>
                                             </select>
                    </div>
                    
                   
                    <div class='input-group input-group-outline mb-3'>
                      <label class='form-label'>Mobile Number</label>
                      <input type='text' class='form-control' name='phone' value='' required >
                    </div>
                  
                    
                    <div class='text-center'>
                      <button type='submit' name='submit' class='btn btn-lg  btn-lg w-100 mt-4 mb-0' style='background-color:#dc3545; color:white;'>NEXT</button>
                    </div>
                  </form>
                
                </div>
                <div class='card-footer text-center pt-0 px-lg-2 px-1'>
                  <p class='mb-2 text-sm mx-auto'>
                    Already have an account?
                    <a href='hondelbanklogin.php' class='text-primary text-gradient font-weight-bold'>Access Here</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src='https://unitedfinancialtrust.org/assets/js/core/popper.min.js'></script>
  <script src='https://unitedfinancialtrust.org/assets/js/core/bootstrap.min.js'></script>
  <script src='https://unitedfinancialtrust.org/assets/js/plugins/perfect-scrollbar.min.js'></script>
  <script src='https://unitedfinancialtrust.org/assets/js/plugins/smooth-scrollbar.min.js'></script>
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
  <script src='https://unitedfinancialtrust.org/assets/js/material-dashboard.min.js?v=3.0.0'></script>
</body>

</html>