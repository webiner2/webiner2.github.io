<?php
session_start();
unset($_SESSION["username_h"]);
unset($_SESSION["firstname"]);
unset($_SESSION["lastname"]);
unset($_SESSION["email"]);
unset( $_SESSION["sex"]);
unset($_SESSION["phone"]);
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" type="image/png" href="hondelbank.jpg">
	  <meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#000000">
	  <meta name="description" content="Manage your banking and business in one place. Open a business bank account in 5 minutes, built to
	  help you succeed. Entrepreneurs ðŸ’œ Hondel Financial Trust">
	  <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
	  
	  <link rel="canonical" href="">
	  
	  <title>Enrollment Acknowledgment | Business banking for entrepreneurs</title>
    <meta name="description" content="mobile Banking Dashboard">
    <meta name="keywords">
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script>
$(document).ready(function(){
$("#myModal").modal({
show:true,
backdrop:'static'
});
});
</script>
 
    <script>
    $(document).ready(function() {
      $('#mybutton').hide().delay(10000).fadeIn(2200);
});
    </script>

<script>
    
    blink {
  -webkit-animation: 2s linear infinite condemned_blink_effect; /* for Safari 4.0 - 8.0 */
  animation: 2s linear infinite condemned_blink_effect;
}

/* for Safari 4.0 - 8.0 */
@-webkit-keyframes condemned_blink_effect {
  0% {
    visibility: hidden;
  }
  50% {
    visibility: hidden;
  }
  100% {
    visibility: visible;
  }
}

@keyframes condemned_blink_effect {
  0% {
    visibility: hidden;
  }
  50% {
    visibility: hidden;
  }
  100% {
    visibility: visible;
  }
}

</script>  
  
  
<style>
    .bs-example{
    	margin: 20px;
    }
    
    
 
</style>
</head>
<body style="background-color:#f6f9f9;">
<div class="bs-example">
  
    
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:green;">REGISTRATION ACKNOWLEDGED...</h5> 
                </div>
                <div class="modal-body">
                    <center><img src='https://unitedfinancialtrust.org/icon/check-circle.gif' width='100px'  /></center>
                 
                <p style="text-align:center;"><strong style="color:green;">Dear Customer,</strong> kindly Login to your account to complete the KYC Verification.</p>
                    		  
                    		  <p style="text-align:center;">A details of Hondel Financial Trust Bank Registration has been sent your email address including the
                    		  <strong style="color:orange;">Hondel Financial Trust Bank 10 Digit Account </strong>
                    		  Number</p> 
                    		  
                    	
                    		 <p>&nbsp;</p>
                    		 <p style="font-weight:700;">FOR: Hondel Financial Trust Bank, Member FDIC</p>
                    
                    
               </div>
               <form  action="hondelbanklogin.php"  method="POST" />
               
              
           
                                        
                <div>
                     
                    <center><button type="submit" id="mybutton" class="btn btn-danger">Back to Login</button></center>
                </div>
                
                <br><br>
            </div></form>
        </div>
    </div>
</div>
</body>
</html>