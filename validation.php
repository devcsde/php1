<html>
  <head>
    <title>Form Validation</title>
  </head>
  <style type="text/css">
  body{
  	  background-color: #cccccc;
  }
  input[type="text"],input[type="email"],textarea{
  	border:  1px solid dashed;
  	background-color: rgb(221,216,212);
  	width: 600px;
  	padding: .5em;
  	font-size: 1.0em;
  }
  .Error{
  	color: red;
  }
  </style>
  <body>
    <?php
    
    $NameError="";
    $EmailError="";
    $GenderError="";
    $WebsiteError="";
    
    if(isset($_POST["Submit"])){
    	
    	if(empty($_POST["Name"])){
    		$NameError="Name is Required";
    	} else {
    		$Name=Test_User_Input($_POST["Name"]);
    		
    		if(!preg_match("/^[A-Za-z .-]{2,}$/", $Name)){
    				$NameError="Only Letters, dots and white spaces are allowed.";
    		}
    	}
    	
    	if(empty($_POST["Email"])){
    		$EmailError="Email is Required";
    	} else {
    		$Email=Test_User_Input($_POST["Email"]);
    		
    		if(!preg_match("/^[A-Za-z0-9.\-_]{2,}@[A-Za-z0-9-]{3,}[.]{1}[A-Za-z.]{2,}$/", $Email)){
    			$EmailError="Please enter a valid email address.";
    		}
    	}
    	
    	if(empty($_POST["Gender"])){
    		$GenderError="Gender is Required";
    	} else {
    		$Gender=Test_User_Input($_POST["Gender"]);
    	}
    	
    	if(empty($_POST["Website"])){
    		$WebsiteError="Website is Required";
    	} else {
    		$Website=Test_User_Input($_POST["Website"]);
    		
    		if(!preg_match("/(https?:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!+]+\.?\:?[a-zA-Z0-9.\-_\/?\$=&\#\~`:!]*+\@?[A-Za-z0-9.:\/]*$/", $Website)){
    			$WebsiteError="Please enter a valid HTTP, HTTPS or FTP URL";
    		}
    	}
    	
    	if(!empty($_POST["Name"]) && 
    		preg_match("/^[A-Za-z .-]{2,}$/", $Name) &&
    		!empty($_POST["Email"]) && 
    		preg_match("/^[A-Za-z0-9.\-_]{2,}@[A-Za-z0-9-]{3,}[.]{1}[A-Za-z.]{2,}$/", $Email) &&
    		!empty($_POST["Gender"]) && 
    		!empty($_POST["Website"]) &&
    		preg_match("/(https?:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!+]+\.?\:?[a-zA-Z0-9.\-_\/?\$=&\#\~`:!]*+\@?[A-Za-z0-9.:\/]*$/", $Website)
    		){
    			echo "<h2>Your info was submitted:</h2><br>";
    			echo"Name: {$_POST["Name"]}<br>";
    			echo"Email: {$_POST["Email"]}<br>";
    			echo"Gender: {$_POST["Gender"]}<br>";
    			echo"Website: {$_POST["Website"]}<br>";
    			echo"Comment: {$_POST["Comment"]}<br>";
    			
    			$emailTo = "toreceipant@gmx.com";
    			$subject = "Contact Form";
    			$body = "User: ".$_POST["Name"]." with email: ".$_POST["Email"].", gender: ".$_POST["Gender"].", website: ".$_POST["Website"]." added the following comment:<br>".$_POST["Comment"];
    			$sender = "From: from@mail.com";
    			
    			if(mail($emailTo, $subject, $body, $sender)){
    				echo "Mail sent successfully!";
    			} else {
    				echo "Mail not sent!";
    			}
    			
    	} else {
    		echo "<h2 class='Error'>Please complete and correct your form.</h2>";
    	}
    		
    }
    
    function Test_User_Input($Data) {
    	return $Data;
    }
    
					
     ?>

     <h2>Form Validation with PHP.</h2>

     <form  action="validation.php" method="post">
     <legend>* Please Fill Out the following Fields.</legend>
     <fieldset>
     Name:<br>
     <input class="input" type="text" Name="Name" value="">
     <span class="Error">*<?php echo $NameError;  ?></span><br>
     E-mail:<br>
     <input class="input" type="text" Name="Email" value="">
     <span class="Error">*<?php echo $EmailError; ?></span><br>
     Gender:<br>
     <input class="radio" type="radio" Name="Gender" value="Female">Female
     <input class="radio" type="radio" Name="Gender" value="Male">Male
     <span class="Error">*<?php echo $GenderError; ?></span><br>
     Website:<br>
     <input class="input" type="text" Name="Website" value="">
     <span class="Error">*<?php echo $WebsiteError; ?></span><br>
     Comment:<br>
     <textarea Name="Comment" rows="5" cols="25"></textarea>
     <br>
     <br>
     <input type="Submit" Name="Submit" value="Submit Information">
        </fieldset>
     </form>


  </body>
</html>
