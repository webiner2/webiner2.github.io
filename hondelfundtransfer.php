<?php
session_start();
if(isset($_SESSION["the_acct_session"])){
    $user_session_hondel = $_SESSION["the_acct_session"];
     //echo $user_session_hondel;
  $curlRequest = curl_init();
  $url = "http://localhost:70/bankproject/hondelapi.php";
  curl_setopt($curlRequest, CURLOPT_URL,$url);
  curl_setopt($curlRequest, CURLOPT_POST, true);
  // set thepost data to be sent
  $data = [
    'user_session_hondel' => $user_session_hondel
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
        $the_firstname =  $parsed_response['the_user_name'];
        $the_lastname = $parsed_response['lastname'];
        $the_acct_type = $parsed_response['acct_type'];
        $useramount = $parsed_response['useramount_hon'];
         $response;
      }else if ($parsed_response['status'] === "Found_login"){
      }
    }else{
      $error = $response;
    }
  }
  curl_close($curlRequest);
// this is to process  the data remember that you 
  if(isset($_POST["submit"])){
    $sender_account = $user_session_hondel;
    // $sender_account;
    $from_Amount = $_POST["amount"];
    $receiver_account_number = $_POST["receiver_account_number"];
    $receiver_account_name = $_POST["receiver_account_name"];
    $receiver_bank_name = $_POST["receiver_bank_name"];
    $narration = $_POST["narration"];
    //echo $user_session_hondel;
 $curlRequest = curl_init();
 $url = "http://localhost:70/bankproject/hondelapi.php";
 curl_setopt($curlRequest, CURLOPT_URL,$url);
 curl_setopt($curlRequest, CURLOPT_POST, true);
 // set thepost data to be sent
 $data = [
   'sender_account' => $sender_account,
   'SentAmount' => $from_Amount,
   'receiver_account_number' => $receiver_account_number,
   'receiver_account_name' => $receiver_account_name,
   'receiver_bank_name' => $receiver_bank_name,
   'narration' => $narration
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
   if($parsed_response['statusfail'] === "The Receiver Account Number Not Found"){
    $errorHandling = $parsed_response['statusfail'];
    $background_color_error = "red";
   }else if($parsed_response['statusfail'] === "The Receiver Account Name does Not Match"){
    $errorHandling = $parsed_response['statusfail'];
    $background_color_error = "red";
   }else if($parsed_response['statusfail'] === "Your Account is Restricted Please Contact Support"){
    $errorHandling = $parsed_response['statusfail'];
    $background_color_error = "red";
   } else if($parsed_response['statusfail'] === "Your Transfer is Succcessful"){
    $errorHandling = $parsed_response['statusfail'];
    $background_color_error = "lightgreen";
   } else if($parsed_response['statusfail'] === "Your Transfer is Succcessful Please hold while we process your transfer"){
    $errorHandling = $parsed_response['statusfail'] ."...";
    $background_color_error = "lightgreen";
   } else{
    $errorHandling = "The Receiver Account Number Found";
    $background_color_error = "lightgreen";
   }
   // echo  $response;
 }
 curl_close($curlRequest);
  }
}else{
    header("Location: hondelbanklogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="hondelbank.jpg">
  <link rel="icon" type="image/png" href="hondelbank.jpg">
  <link href="hondelbankhome.css" rel="stylesheet">
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
	  <link rel="canonical" href=""><title>Hondel Financial Trust Bank| Business banking for entrepreneurs</title>

      <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader');
            var fadeEffect = setInterval(function() {
                if (!loader.style.opacity) {
                    loader.style.opacity = 2;
                }
                if (loader.style.opacity > 0) {
                    loader.style.opacity -= 0.1;
                } else {
                    clearInterval(fadeEffect);
                    loader.style.display = 'none';
                }
            }, 100);
        });
        document.addEventListener("DOMContentLoaded", function () {
        var navbar = document.getElementById("nav-bar");
        var header_nav_left = document.getElementById("header-nav-left");
        var the_cancel_button = document.getElementById("the-cancel-button");
        function navbardisplay(){
            if(navbar.style.display === "block"){
                sh = header_nav_left.style.display = "block";
                sh = navbar.style.display = "none";
                console.log(sh);
            }else {
                console.log("wow");
            }
        }
        navbar.addEventListener("click", navbardisplay);

        function cancelnav(){
            if(navbar.style.display === "none"){
                header_nav_left.style.display = "none";
                navbar.style.display = "block";
            }
        }

        the_cancel_button.addEventListener("click", cancelnav)
    });
        </script>
    </head>
    <style>
        #loader{
            position: fixed;
            z-index: 9999999;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
    background: url('https://unitedfinancialtrust.org/assets/loader.gif') 50% 50% no-repeat #f9f9f9;
}
    </style>
    <body> 
        <div id="loader"></div>
        <div class="main">
            <div class="header-nav-left" id="header-nav-left">
               <div class="the-inside-nav"><br>
                <div class="the-logo-nav0">
                  <div class="img"> <img src="hondelbank.jpg" width="100px" height="50px"></div>
                  <div class="the-cancel-button"><button id="the-cancel-button"><span>X</span></button></div>
                </div>
                <hr style="clear: both;">
                <div class="the-nav-item">
                    <a href="hondelbankhome.php">
                        <div class="the-nav-item-inside-a-a">
                            <div style="height: 8px;"></div>
                            <div style="margin-left: 30px;">Dashboard</div>
                        </div>
                    </a>
                </div><hr style="border: none; background-color:darkcyan; height:1px; width:90%; margin-top:15px;">
                <div class="the-nav-item">
                    <a href="">
                        <div class="the-nav-item-inside-a-a">
                            <div style="height: 8px;"></div>
                            <div style="margin-left: 30px;">Account Statement</div>
                        </div>
                    </a>
                </div>
                <div class="the-nav-item" style="margin-top:10px !important;">
                    <a href="hondelfundtransfer.php">
                        <div class="the-nav-item-inside-a">
                            <div style="height: 8px;"></div>
                            <div style="margin-left: 30px;">Pay & Transfer</div>
                        </div>
                    </a>
                </div>
                <div class="the-nav-item" style="margin-top:10px !important;">
                    <a href="hondelmake_deposit.php">
                        <div class="the-nav-item-inside-a-a">
                            <div style="height: 8px;"></div>
                            <div style="margin-left: 30px;">Make Deposit</div>
                        </div>
                    </a>
                </div>
                <div class="the-nav-item" style="margin-top:10px !important;">
                    <a href="">
                        <div class="the-nav-item-inside-a-a">
                            <div style="height: 8px;"></div>
                            <div style="margin-left: 30px;">Support</div>
                        </div>
                    </a>
                </div>
                <div class="the-nav-item" style="margin-top:10px !important;">
                    <a href="hondelsupport.html">
                        <div class="the-nav-item-inside-a-a">
                            <div style="height: 8px;"></div>
                            <div style="margin-left: 30px;">Logout</div>
                        </div>
                    </a>
                </div>
               </div>
            </div>
            <div class="header-nav-right">
                <div style="height: 30px;" class="break"></div>
              <div class="the-dashboard-text" style="float: left;"><span style="margin-left:10px;">Bank Dashboard</span></div>
              <div class="the-profile-image" style="float: left;"><div class="theletters"><?php if(isset($the_firstname) && isset($the_lastname)){echo $the_firstname." ". $the_lastname;} ?></div></div>
              <div class="the-notifications-name" style="float: left;">
                <a><img src="https://webiner2.github.io/notify.jpg" width="30px" height="30px" style="background-color: #D8E2DC;"></a>
              </div><span style="color:white; background-color:red; border-radius:50%; margin-left:2px;">1</span>
              <div class="nav-bar" >
                <button id="nav-bar" style="display: block; border:none; background-color:transparent;">
                <div class="the-mobile-nav"></div>
                <div class="the-mobile-nav"></div>
                <div class="the-mobile-nav"></div>
                </button>
              </div>
            </div>
            <div class="the-body-content">
                <div class="the-greetings"><div style="height: 10px;"></div><span>Hello, <?php if(isset($the_firstname)){ echo $the_firstname;} ?></span></div>
                <div class="the-bank-transfer">
                    <div class="the-local-card">
                        <div class="the-local-text"><div style="height: 3px;"></div>
                            <div class="the-local-text-header"><span>Local & International Bank Transfer</span><span style="color: red; margin-left:2px;">&#8594;</span></div>
                           <div class="thespan-local"><span>(Interbank Transfer within the country)</span></div>
                        </div>
                        <div class="the-local-time"><span>maximum 48hrs delivery</span></div>
                    </div>
                </div>
                <div class="the-form-transfer">
                    <div class="the-account-form">
                        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <fieldset>
                                <legend><div class="the-form-transfer-header">
                                    <div style="height: 10px;"></div>
                                    <div class="hj"> <span>Local Bank Transfer</span></div>
                                </div></legend>
                                <div class="the-form-transfer-balance">
                               <?php 
                               if(isset($errorHandling)){
                                echo "
                                <div class='the-account-number' style='background-color:$background_color_error; margin-bottom:10px;' ><div style='height: 15px;'></div><span style='color:white;'>$errorHandling</span></div>
                                ";
                               }
                               ?>
                                    <div class="the-form-transfer-balance-header"><span>Debit Account</span></div>
                                    <div class="the-account-number"><div style="height: 15px;"></div><span><?php if(isset($user_session_hondel)){echo $user_session_hondel;} ?> | $<?php if(isset($useramount)){ echo number_format($useramount,2,'.',',');} ?></span></div>
                                </div>
                                <div class="amount4"><span>Amount ($)</span></div>
                            <input type="text" placeholder="Amount" name="amount" required>
                            <input type="tel" name="receiver_account_number" placeholder="Receiver Account Number" required>
                            <input type="text" name="receiver_account_name" placeholder="Receiver Account Name" required>
                            <input type="text" name="receiver_bank_name" placeholder="Receiver Bank Name (Use Hondel Bank if Transfering to a user banking with us)">
                            <div class="forthetextarea">
                                <div class="forthetextarea-t">Transaction Naration</div>
                                <textarea name="narration" placeholder="Write something.." cols="5"></textarea>
                            </div>
                            <input type="submit" name="submit" value="TRANSFER&#8594;">
                            </fieldset>
                        </form>
                    </div>
                </div>
               
            </div>
            <div style="height: 20px; clear:both;"></div>
            <div class="copyright">All Rights Reserved
                © <script>
                  document.write(new Date().getFullYear())
                </script>
                <a href="#" class="font-weight-bold" >Simplified for a better Web Banking.</a>
              </div>
        </div>
        <style>
            .the-bank-transfer{
                background-color: transparent;
                margin-top: 20px;
                width: 100%;
            }
            .the-local-card{
                height: 100px;
                background-color: white;
                width: 90%;
                margin-left: 1%;
                border-radius: 10px;
                box-shadow: 0px 0px 5px white, 0px 0px 3px lightgrey;
            }
            .the-local-text{
                background-color: transparent;
                height: 50px;
            }
            .the-local-time{
                margin-top: 10px;
            }
            .the-local-time span{
                margin-left: 7px;
                font-size: 15px;
                color: #858786;
                font-family: sans-serif;
            }
            .the-local-text-header{
                font-size: 25px;
                font-family: sans-serif;
                margin-left: 4px;
            }
            .thespan-local{
                margin-left: 7px;
                margin-top: 10px;
            }.thespan-local span{
                font-size: 17px;
                font-family: sans-serif;
                color: #554348;
            }
            .the-form-transfer-header span{
                font-family: sans-serif;
            }
            .the-form-transfer-header{
                clear: both;
                width: 100%;
                height: 80px;
                background-color: #e92160;
                border-radius: 8px;
                box-shadow: 0px 0px 5px white, 0px 4px 10px rgb(235, 188, 188), 0px 4px 10px rgb(244, 210, 210);
            } 
            .the-form-transfer-header .hj{
                margin-top: 12px;
                margin-left: 10px;
                font-size: 25px;
                color: white;
                font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-weight: 700;
            }
            .the-form-transfer{
                width: 100%;
                height: 100%;
                display: block;
                margin-top: 40px;
            }
            fieldset legend{
                width: 98%;
                margin-left: 1%;
            }
            fieldset{
                border: none;
                border-radius: 15px;
                box-shadow: 0px 0px 5px #ccc;
                height: 100%;
            }
            .the-form-transfer-balance{
                margin-top: 42px;
                margin-left: 1%;
                width: 98%;
            }
            .the-form-transfer-balance-header{
                font-size: 15px;
                font-family: sans-serif;
                color: #808F85;
            }
            .the-account-number{
                height: 49px;
                margin-top: 15px;
                border: 1px solid #d0d1ce;
                border-radius: 6px;
                background-color: #FBFBFF;
            }
            .the-account-number span{
                font-family: sans-serif;
                font-size: 16px;
                color: rgb(104, 103, 103);
                margin-left: 12px;
                font-weight: 300;
            }
            .amount4 {
                margin-top: 17px;
                font-size: 15px;
                font-family: sans-serif;
                color: #808F85;
                width: 98%;
                margin-left: 1%;
            }
            form input[type=text]{
                margin-top: 17px;
                width: 98%;
                margin-left: 1%;
                height: 49px;
                border: 1px solid #ccc;
                border-radius: 4px;
                outline: 1px solid #ccc;
                font-size: 16px;
                color: rgb(88, 87, 87);
                font-family: sans-serif;
                text-indent: 12px;
            }
            form input[type=tel]{
                margin-top: 17px;
                width: 98%;
                margin-left: 1%;
                height: 49px;
                border: 1px solid #ccc;
                outline: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
                color: rgb(88, 87, 87);
                font-family: sans-serif;
                text-indent: 12px;
            }
            .forthetextarea{
                width: 98%;
                margin-left: 1%;
                margin-top: 17px;
            }
            .forthetextarea-t{
                font-size: 14px;
                font-family: sans-serif;
                color: #808F85;
            }
            .forthetextarea textarea{
                width: 100%;
                height: 80px;
                outline: 1px solid #ccc;
                margin-top: 17px;
                font-size: 16px;
                color: rgb(88, 87, 87);
                font-family: sans-serif;
                text-indent: 12px;
                padding: 10px 0;
                border-radius: 4px;
            }
            form input[type=submit]{
                margin-top: 17px;
                height: 45px;
                margin-left: 1%;
                width: 120px;
                border-radius: 4px;
                border: none;
                font-size: 12px;
                background-color: #2E2F2F;
                color: white;
                font-family: sans-serif;
                text-shadow: 0px 0px 3px white;
                margin-bottom: 50px;
            }
            form input[type=submit]:hover{
                box-shadow: 0px 0px 10px #b39b8c;
            }
            @media only screen and (max-width:600px){
                .the-bank-transfer{
                    background-color: transparent;
                    margin-top: 20px;
                    width: 100%;
                }
                .the-local-card{
                    height: 130px;
                    background-color: white;
                    width: 100%;
                    margin-left: 0;
                    border-radius: 10px;
                    box-shadow: 0px 0px 5px white, 0px 0px 3px lightgrey;
                }
                .the-local-text{
                    background-color: transparent;
                    height: 50px;
                }
                .the-local-time{
                    margin-top: 50px;
                }
                .the-local-time span{
                    margin-left: 18px;
                    font-size: 15px;
                    color: #858786;
                    font-family: sans-serif;
                }
                .the-local-text-header{
                    font-size: 25px;
                    font-family: sans-serif;
                    margin-left: 10px;
                }
                .thespan-local{
                    margin-left: 7px;
                    margin-top: 10px;
                }.thespan-local span{
                    font-size: 17px;
                    font-family: sans-serif;
                    color: #554348;
                }
            }
        </style>
    </body>
</html>