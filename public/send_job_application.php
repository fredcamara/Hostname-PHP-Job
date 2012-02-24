<?php 

if (!isset($_POST["name"]) || strlen(trim($_POST["name"])) == 0)
{
	 echo ("We need your name. You can use a nickname if you prefer. Please try again!");
}
else if (!isset($_POST["email"]) || strlen(trim($_POST["email"])) == 0)
{
	 echo ("No email? Are you really a developer?  Please try again!");
}
else if (!isset($_POST["contact"]) || strlen(trim($_POST["contact"])) == 0)
{
	 echo ("We want to be able to call you in the middle of the night and make a prank. Please try again!");
}
else 
{
	if (!isset($_FILES["cv"]["name"]) || strlen(trim($_FILES["cv"]["name"])) == 0)
	{
		echo ("If you don't like CV's, send a TXT file explaining why are you doing all of this for a job opportunity. Please try again!");
	}	
	else if ($_FILES["cv"]["size"] > 500000)
  	{
  		echo "Is your CV that big? 500k maximum. Please try again!";
  		
    }
    else if ($_FILES["cv"]["error"] > 0)
    {
    	echo "Return Code: " . $_FILES["cv"]["error"] . ". Something weird happened with your file. Please try again!";
	}
    else 
    {
	    try 
	    {
			//send email
	  		$name = $_POST['name'] ; // Your name here
	  		$email = $_POST['email'] ; // Your email here 
	  		$contact = $_POST['contact'] ; // Your phone contact here

	  		include_once("../library/Mail.php"); 
	  		
			$Subject = "PHP Technical Consultant - Funny way"; // Don't change this
			
			$Message = 
			"I'm applying to the PHP Technical Consultant job, via the funny way. <br>" .
			"Please find my CV attached.<br>" .
			"My email is ".$email . "<br>" .
			"My other contat is ".$contact . "<br><br>" .
			"Thanks,<br>" .
			$name; 
			// Make your own message
			
			$mail = new Mail($name, $email, "Hostname Jobs", "jobs@hostname.pt", $Subject, $Message);
			
			$mail->addAttachment($_FILES["cv"]["tmp_name"], $_FILES["cv"]["name"]);
			
			$sent = $mail->send();
			
			if($sent) {
				echo ("Great! Nice work. We will call you back as soon as possible.<br>");
				echo ("You can also contact us via email: contact@hostname.pt");	
			}
			else {
				echo ("The email wasn't sent for some reason related to the SMTP settings. Please try again!");
			}
			
		} catch (Exception $e) {
			echo ("Something went wrong sending the email. Please try again! <br><br>". $e);
		}	
    }
}
?>
<br><br>
<a href="javascript:window.history.back();"><< back</a>