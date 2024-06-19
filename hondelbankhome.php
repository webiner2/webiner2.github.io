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
        $useramount_hon = $parsed_response['useramount_hon'];
         $useramount_hon;
         $response;
      }else if ($parsed_response['status'] === "Found_login"){
      }
    }else{
      $error = $response;
    }
  }
  curl_close($curlRequest);
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
                        <div class="the-nav-item-inside-a">
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
                        <div class="the-nav-item-inside-a-a">
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
                    <a href="hondelsupport.php">
                        <div class="the-nav-item-inside-a-a">
                            <div style="height: 8px;"></div>
                            <div style="margin-left: 30px;">Support</div>
                        </div>
                    </a>
                </div>
                <div class="the-nav-item" style="margin-top:10px !important;">
                    <a href="">
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
            <div class="the-body-content" style="margin-bottom: 20px;" >
                <div class="the-greetings"><div style="height: 10px;"></div><span>Hello, <?php if(isset($the_firstname)){ echo $the_firstname;} ?></span></div>
                <div class="account-card">
                    <div class="theline"></div>
                    <div class="the-AccountText">
                        <div class="the-bankingtext"><span style="margin-left:3px;">Banking</h4></div><div class="Amount-total"><span style="margin-left: 20px;">$<?php if(isset($useramount_hon)){ echo number_format($useramount_hon,2,'.',',');} ?></span></div>
                    </div><div style="clear: both;"></div><hr style=" clear:both; border: none; background-color:lightgrey; height:2px; width:100%;">
                    <div class="bank-name"><span>Hondel Financial Trust Bank</span></div>
                    <div class="the-accont-type">
                        <div class="the-left-account-type"><span><?php if(isset($the_acct_type)){ echo $the_acct_type;} ?> - <?php if(isset($user_session_hondel)){ echo substr($user_session_hondel, -4);} ?></span></div>
                        <div class="the-right-account-type"><span>$<?php if(isset($useramount_hon)){ echo number_format($useramount_hon,2,'.',',');} ?></span></div><hr style="clear: both; margin-top:10px; margin-bottom:10px;">
                    </div>
                </div>
                <div class="transaction" style="margin-bottom:20px;" >
                    <div class="trans-header"><div style="height: 10px;"></div><span>TRANSACTIONS</span></div>
                    <?php 
                       if(isset($parsed_response['trans_head'], $parsed_response['date_time'], $parsed_response['Processing_Success'])){
                        // You can use the for statement to get the arrays from the curl or api request and display them 
                     /*   for ($i = 0; $i < count($parsed_response['trans_head']); $i++) {
                            $trans_head = htmlspecialchars($parsed_response['trans_head'][$i]);
                            $date_time = htmlspecialchars($parsed_response['date_time'][$i]);
                            $Processing_Success = htmlspecialchars($parsed_response['Processing_Success'][$i]);
                            if($Processing_Success === "Processing"){
                                echo "
                                <div class='trans-details'>
                                <div style='height: 5px;'></div>
                                <div class='trans-date'><span>$date_time</span></div>
                                <div class='trans-content-header'><span>".$trans_head."</span></div>
                                <div class='trans-amount'><span>-$96.89</span><span style='background-color:#E85D75; border-radius:10px; color:#E0E2DB; width:90px; text-align:center; font-size:14px; height:18px'>$Processing_Success</span></div>
                                <div class='trans-balance' style='margin-top:5px !important;'><span>$2,146.15</span></div>
                                <hr style='clear: both; margin-top:10px;'>
                                </div>
                                ";
                            }else if ($Processing_Success === "Success"){
                                echo "
                                <div class='trans-details'>
                                <div style='height: 5px;'></div>
                                <div class='trans-date'><span>$date_time</span></div>
                                <div class='trans-content-header'><span>".$trans_head."</span></div>
                                <div class='trans-amount'><span>-$96.89</span><span style='background-color:#4FB477; border-radius:10px; color:#E0E2DB; width:90px; text-align:center; font-size:14px; height:18px'>$Processing_Success</span></div>
                                <div class='trans-balance' style='margin-top:5px !important;'><span>$2,146.15</span></div>
                                <hr style='clear: both; margin-top:10px;'>
                                </div>
                                ";
                            }
                        }*/
                        // i prefer the array_map its simple and short easy to understand. i recommend if you want to use it okay both work the same thing 
                        $trans_head = $parsed_response['trans_head'];
                        $date_time = $parsed_response['date_time'];
                        $Processing_Success = $parsed_response['Processing_Success'];
                        $TransAmount_sent = $parsed_response['TransAmount_sent'];
                        $TransBalance = $parsed_response['TransBalance'];
                        $trans_sent_from = $parsed_response['trans_sent_from'];
                      // $transDetails = array_map(null,$parsed_response['trans_head'],$parsed_response['date_time'],$parsed_response['Processing_Success']); yep
                       $transDetails = array_map(null, $trans_head, $date_time, $Processing_Success,$TransAmount_sent,$TransBalance,$trans_sent_from);
                       foreach($transDetails as $Details_Trans){
                        list($trans_head, $date_time, $Processing_Success,$TransAmount_sent,$TransBalance,$trans_sent_from) = $Details_Trans;
                        $trans_head = htmlspecialchars($trans_head); // the htmlspecialchars if for sanitizing the data 
                        $date_time = htmlspecialchars($date_time);
                        $TransAmount_sent = number_format(htmlspecialchars($TransAmount_sent),2,'.',',');
                        $TransBalance = number_format(htmlspecialchars($TransBalance),2,'.',',');
                        $trans_sent_from = htmlspecialchars($trans_sent_from);
                        $Processing_Success = htmlspecialchars($Processing_Success);
                        if($Processing_Success === "Processing"){$background_color = "#E85D75"; $status_text = "Processing"; }
                        if($Processing_Success === "Success"){$background_color = "#4FB477"; $status_text = "Success";}
                        if($trans_sent_from === $user_session_hondel){$minus ="-";}else { $minus="";}
                       // $background_color = ($Processing_Success === "Processing") ? "#E85D75" : "#4FB477";
                       // $status_text = ($Processing_Success === "Processing") ? "Processing" : "Success";
                        
                        echo "
                        <div class='trans-details'>
                            <div style='height: 5px;'></div>
                            <div class='trans-date'><span>$date_time</span></div>
                            <div class='trans-content-header'><span>$trans_head</span></div>
                            <div class='trans-amount'><span>$minus$$TransAmount_sent</span><span style='background-color:$background_color; border-radius:10px; color:#E0E2DB; width:90px; text-align:center; font-size:14px; height:18px'>$status_text</span></div>
                            <div class='trans-balance' style='margin-top:5px !important;'><span>$$TransBalance</span></div>
                            <hr style='clear: both; margin-top:10px;'>
                        </div>
                        ";
                       }
                    }
                    ?>
                    <div class="trans-details">
                        <div style="height: 5px;"></div>
                        <div class="trans-date"><span>09/01/2017</span></div>
                        <div class="trans-content-header"><span>AT&T WIRELESS</span></div>
                        <div class="trans-amount"><span>-$96.89</span></div>
                        <div class="trans-balance"><span>$2,146.15</span></div>
                        <hr style="clear: both; margin-top:10px; margin-bottom:10px;">
                    </div>
                </div>
            </div><br>
            <div style="height: 10px; clear:both;"></div>
            <div class="copyright">All Rights Reserved
                © <script>
                  document.write(new Date().getFullYear())
                </script>
                <a href="#" class="font-weight-bold" >Simplified for a better Web Banking.</a>
              </div>
        </div>
    </body>
</html>