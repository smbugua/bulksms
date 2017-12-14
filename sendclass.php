<?php
include('header.php');
// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');
// Specify your login credentials
$username   = "cuspid";
$apikey     ="2ef9464f924f7253b7b163f5b42033c8c4232782f311e47f585096b436203265";
// NOTE: If connecting to the sandbox, please use your sandbox login credentials
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254722856900,+254728944815,+254724661481,+254716671496";
$ph=$_POST['prefix'];
$no=$_POST['no'];
$phone=$ph.$no;
$recipients=$phone;
// And of course we want our recipients to know what we really do
$message    = $_POST['msg'];
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
$from="CUSPID";
// NOTE: If connecting to the sandbox, please add the sandbox flag to the constructor:
/*************************************************************************************
             ****SANDBOX****
$gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");
**************************************************************************************/
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message,$from);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}

echo "<script>alert('SMS SUCCEFULLY SENT TO: $recipients')</script>";
    echo "<script>location.replace('index.php')</script>";
// DONE!!! 
?>
