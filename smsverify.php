<?php
include('header.php');
// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');
// Specify your login credentials
$username   = "smbugua";
$apikey     = "74acee8753dd77b4be356cb190c1dd22f6d993f86e2ecb24d092361617d83148";
// NOTE: If connecting to the sandbox, please use your sandbox login credentials
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254722856900,+254728944815,+254724661481,+254716671496";
$id=$_REQUEST['id'];
$db=$_POST['db'];
$r=mysql_query("SELECT tel FROM contacts where id='$db'");
while ($c=mysql_fetch_array($r)) {
 
$recipients=$c['tel']; 

// And of course we want our recipients to know what we really do
$message    = $_POST['msg'];
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
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
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
    echo "<br>";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}

//echo "<script>alert('SMS SUCCEFULLY SENT TO: $recipients')</script>";
}

echo "<script>location.replace('index.php')</script>";
// DONE!!! 
?>
