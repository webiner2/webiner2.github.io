<?php
session_start();

if(isset($_SESSION["the_acct_session"])){
    $session_acct = $_SESSION["the_acct_session"];
    $curlRequest = curl_init();
  $url = "http://localhost:70/bankproject/hondelapi.php";
  curl_setopt($curlRequest, CURLOPT_URL,$url);
  curl_setopt($curlRequest, CURLOPT_POST, true);
  // set thepost data to be sent
  $data = [
    'session_acct' => $session_acct
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
   $username_signup = $parsed_response['username_signup'];
   $num1 = $parsed_response['num1'];
   $num2 = $parsed_response['num2'];
   }else if($parsed_response['status'] === "error"){
    header("Location: hondelbanklogin.php");
    exit;
   }
  }
  curl_close($curlRequest);
if(isset($_POST["submit"])){
    include "hondel-database.php";
    $number1 = $_POST["number1"];
    $input_number=$number1;

    $curlRequest = curl_init();
  $url = "http://localhost:70/bankproject/hondelapi.php";
  curl_setopt($curlRequest, CURLOPT_URL,$url);
  curl_setopt($curlRequest, CURLOPT_POST, true);
  // set thepost data to be sent
  $data = [
    'user_name_signup' => $username_signup,
    'input_verify' => $input_number,
    'theAcctNum' => $session_acct
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
   if($parsed_response['status']  === "unset"){
    unset($_SESSION["the_acct_session"]);
    header("Location: hondelbanklogin.php");
   }else if ($parsed_response['status'] === "wrong code"){
    $wrongcode = $parsed_response['status'];
   }else if($parsed_response['status'] === "insert error"){
    $wrongcode = $parsed_response["status"];
   }else{
    $wrongcode = $parsed_response['status'];
    echo $response;
   }
  }
  curl_close($curlRequest);
}
}else{
    header("Location: hondelbanklogin.php");
}


?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <link rel="icon" href="nelson-logo-1.jpg">
        <title>OTP Authentication</title>
    </head>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the link element
    var resendLink = document.getElementById("resend_email");
    var small1 = document.getElementById("small1");
    
    // Add click event listener
    resendLink.addEventListener("click", function(e) {
        e.preventDefault(); // Prevent the default link behavior
        
        // Get the value of the custom data attribute
        var value = resendLink.getAttribute("data-value");
        
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        
        // Configure the request
        xhr.open("POST", "http://localhost:70/bankproject/hondelapi.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        // Define the callback function
        xhr.onreadystatechange = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Request was successful
                //console.log(xhr.responseText);
                if (xhr.responseText === "worked"){
                    small1.style.display = "inline-block";
                    small1.style.marginLeft = "33%";
                    small1.style.width = "auto";
                    //console.log("he");
                }else if (xhr.responseText === "Message could not be sent. Mailer Error:"){
                    small1.style.display = "inline-block";
                    small1.style.marginLeft = "33%";
                    small1.style.width = "auto";
                    small1.style.backgroundColor = "red";
                    small1.innerHTML = xhr.responseText;
                   // console.log("he1");
                }else if (xhr.responseText === "Error updating record: "){
                    small1.style.display = "inline-block";
                    small1.style.marginLeft = "33%";
                    small1.style.width = "auto";
                    small1.style.backgroundColor = "red";
                    small1.innerHTML = xhr.responseText;
                   // console.log("he3");
                }else if (xhr.responseText === " no user found"){
                    small1.style.display = "inline-block";
                    small1.style.marginLeft = "33%";
                    small1.style.width = "auto";
                    small1.style.backgroundColor = "red";
                    small1.innerHTML = xhr.responseText;
                   // console.log("he4");
                }else{
                    console.log("none worked");
                    console.log(xhr.responseText);
                }
            } else {
                // Request failed
                console.error("Request failed with status:", xhr.status);
            }
        };
        
        // Handle network errors
        xhr.onerror = function() {
            console.error("Network error occurred");
        };
        
        // Send the request with the custom data attribute value
        xhr.send("usernameforresend=" + encodeURIComponent(value));
    });
});
</script>
    <style>
        body{
                margin: 0;
                display: block;
                background-color: #15172b;
            }
            .verification{
                border: 1px solid white;
                width: 90%;
                height: 380px;
                margin-left: 5%;
                margin-top: 5%;
                background-color: white;
                align-items: center;
                -webkit-border-radius:12px;
                -moz-border-radius:12px;
                border-radius: 12px;
            }
            .verification-header{
                width: 100%; 
                text-align: center;
                margin-top: 10px;
            }
            .verification-header span{
                font-size: xx-large;
                font-weight: 600;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

            }
            .sub-header{
                width: 100%;
                text-align: center;
            }
            .sub-header span{
                font-size: x-large;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-weight: 600;
            }
            .verification-text{
                text-align: center;
                font-size: 15px;
                color: #a3a3a3;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

            }
            .verification-form{
                width: 100%;
            }
            form{
                width: 100%;
            }
            form input[type=tel]{
                width: 78%;
                height: 35px;
                margin-left: 10%;
                border: none;
                border-bottom: 2px solid green;
                font-size: 40px;
                letter-spacing: 15px;
                text-indent: 300px;
                outline: none;
            }
            form input[type=submit]{
                    font-size: 17px;
                    padding: 0.5em 2em;
                    margin: 20px;
                    margin-left: 15.5%;
                    width: 69%;
                    border: transparent;
                    box-shadow: 2px 2px 4px rgba(0,0,0,0.4);
                    background-color: dodgerblue;
                    color: white;
                    -webkit-border-radius: 4px;
                    -moz-border-radius: 4px;
                    border-radius: 4px;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    appearance: none;
            }
            input[type=submit]:hover{
                background: rgb(2,0,36);
                background: linear-gradient(90deg, rgba(30,144,255,1) 0%, rgba(0,212,255,1) 100%);
            }
            input[type=submit]:active{
                transform: translate(0em, 0.2em);
            }
            small{
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-size: 18px;
                width: 70%;
                margin-left: 15%;
                clear: both;
            }
            #small1 {
                display: none;
                clear: both;
                color: white;
                font-size: 20px;
                margin-left: 33%;
                background-color: green;
            }
            small a {
                text-decoration: none;
                color: blue;
                font-size: 19px;
            }
        @media only screen and (max-width:600px){
            body{
                margin: 0;
                display: block;
                background-color: #15172b;
            }
            .verification{
                border: 1px solid white;
                width: 90%;
                height: 380px;
                margin-left: 5%;
                margin-top: 48%;
                background-color: white;
                align-items: center;
                -webkit-border-radius:12px;
                -moz-border-radius:12px;
                border-radius: 12px;
            }
            .verification-header{
                width: 100%; 
                text-align: center;
                margin-top: 10px;
            }
            .verification-header span{
                font-size: xx-large;
                font-weight: 600;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

            }
            .sub-header{
                width: 100%;
                text-align: center;
            }
            .sub-header span{
                font-size: x-large;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-weight: 600;
            }
            .verification-text{
                text-align: center;
                font-size: 15px;
                color: #a3a3a3;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

            }
            .verification-form{
                width: 100%;
            }
            form{
                width: 100%;
            }
            form input[type=tel]{
                width: 78%;
                height: 35px;
                margin-left: 10%;
                border: none;
                border-bottom: 2px solid green;
                font-size: 40px;
                letter-spacing: 15px;
                text-indent: 12px;
                outline: none;
            }
            form input[type=submit]{
                    font-size: 17px;
                    padding: 0.5em 2em;
                    margin: 20px;
                    margin-left: 15.5%;
                    width: 69%;
                    border: transparent;
                    box-shadow: 2px 2px 4px rgba(0,0,0,0.4);
                    background-color: dodgerblue;
                    color: white;
                    -webkit-border-radius: 4px;
                    -moz-border-radius: 4px;
                    border-radius: 4px;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    appearance: none;
            }
            input[type=submit]:hover{
                background: rgb(2,0,36);
                background: linear-gradient(90deg, rgba(30,144,255,1) 0%, rgba(0,212,255,1) 100%);
            }
            input[type=submit]:active{
                transform: translate(0em, 0.2em);
            }
            small{
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-size: 18px;
                width: 70%;
                margin-left: 15%;
                clear: both;
            }
            #small1 {
                display: none;
                clear: both;
                color: white;
                font-size: 20px;
                margin-left: 33%;
                background-color: green;
            }
            small a {
                text-decoration: none;
                color: blue;
                font-size: 19px;
            }
        }
    </style>
    <body>
        <!--This is the card for the form-->
        <div class="verification">
            <div class="verification-header"><!--this is the header -->
                <span>OTP</span></div>
            <div class="sub-header">
                <span>Verification Code</span>
            </div>
            <div class="verification-text">
                <p> We have sent a verification code to your email address
                <?php if(isset($num1,$num2)){
                        echo $num1."xxxxxxx".$num2;
                    }
                    ?>
                </p>
            </div>
            <?php
            if(isset($wrongcode)){
                echo "<div style='color:red; text-align:center;'>$wrongcode</div><br>";
            }
            ?>
            <!--this is the verification form-->
            <div class="verification-form">
                <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <!--this is the verifrication input here am using tel right because its going to be number-->
                    <input type="tel" name="number1" placeholder="XXXXXX" pattern="[0-9]{6}" maxlength="6" required>
                    <br>
                    <input type="submit" name="submit" value="verify">
                </form>
            </div>
            <small id="small1">Success</small><br>
            <small> Didn't get the code ?
                <a href="" class="re-send" id="resend_email" data-value="<?php echo $session_acct; ?>">Resend</a>
            </small>
        </div>
      
    </body>
</html>