<?php 
		include'../core/logic.php';
		$log = new Logic();
		session_start();
		$email = $_SESSION['Client'];
		$client_id =$log->getClientIdByEmail($email);
		$message = $_SESSION['message'];
		$amount = $_SESSION['amount'];
		$status = $_SESSION['payament-status'];
try 
{	

	require_once('Stripe/lib/Stripe.php');
	Stripe::setApiKey("sk_test_TL8RcPmCxO0nFrSABWhTMnxP"); //Replace with your Secret Key
	
	$charge = Stripe_Charge::create(array(
		"amount" => $amount,
		"currency" => "ZAR",
		"card" => $_POST['stripeToken'],
		"description" => "Standard Deposit"
		
	));
	//send the file, this line will be reached if no error was thrown above
	echo "<h1>Your payment has been completed.</h1>";
	//you can send the file to this email:
}
catch(Stripe_CardError $e) 
{
	
}
//catch the errors in any way you like
catch (Stripe_InvalidRequestError $e) 
{
  // Invalid parameters were supplied to Stripe's API

} catch (Stripe_AuthenticationError $e) 
{
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)

} catch (Stripe_ApiConnectionError $e) 
{
  // Network communication with Stripe failed
} catch (Stripe_Error $e) 
{
  // Display a very generic error to the user, and maybe send
  // yourself an email
} 
catch (Exception $e)
 {

  // Something else happened, completely unrelated to Stripe
}

if(isset($_GET['Verification']))
{
			#$to = $email;
			$date = date('Y-m-d H:i:s');
			$headers = '[Ipheya] Payment notification';
			$message = 'Your Payment with ipheya was successfull info will be sent to you using email' ;
			$refid = "SELECT payment_id FROM payments ORDER BY payment_id DESC LIMIT 1";
			$valu = mysqli_query($log->connect(),$refid);
			while($arr =mysqli_fetch_row($valu))
			{
				$val = substr($arr[0],4,1);
			}
			$id =intval($val)+1;
			$ref = 'PM00'.$id;
			// mail($to,$headers,$message);
			$insertQ ="INSERT INTO payments VALUES ('{$ref}','{$amount}','{$date}','{$status}','{$client_id}')";
			if(!mysqli_query($log->connect(),$insertQ))
			{
					die("Error".mysqli_error($log->connect()));
			}
			header('../client/home.php');
}
?>