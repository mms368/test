<?php 
   $headermessage="";
   
    $name="";
    $nameerror="";
   
    $email="";
    $emailerror="";
    
    $phonenumber="";
    $phonenumbererror="";
   
    $contactmethods="";
    $contactmethodserror="";
    
    $response="";
    $responseerror="";
    
    $feedback="";
    $feedbackerror="";
   
   if(isset($_POST["submit"])){
        $name=htmlspecialchars($_POST['name']);
        $email=htmlspecialchars($_POST['email']);
        $phonenumber=htmlspecialchars($_POST['phonenumber']);
        $feedback=htmlspecialchars($_POST['feedback']);
        $contactmethods = isset($_POST['contactmethods']) ? $_POST['contactmethods'] : '';
        $response = isset($_POST['response']) ? $_POST['response'] : '';
   
       
       if (empty($name)) {
   		$nameerror = "<div class=error>Contact name is missing</div>";
       }
        else if ( !preg_match ("/^[a-zA-Z\s]+$/",$name)){
        $nameerror = "<div class=error>Invalid contact name</div>";
       }
       
       if (empty($email)){ 
           $emailerror = "<div class=error>Email is missing</div>";
       }
       else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerror = "<div class=error>Email is invalid</div>";
       }
   
       if (empty($phonenumber)) {
   		$phonenumbererror = "<div class=error>Telephone number is missing</div>";
       }
       else if (!((preg_match("/(\d{3}+\-\d{3}+\-\d{4}+)/", $phonenumber )) && strlen($phonenumber) == 12)) {
           $phonenumbererror = "<div class=error>Telephone number is invalid.  Please enter as 123-123-1234</div>";
        }
       
       if(isset($_POST['contactmethods']) && $_POST['contactmethods'] == 'Empty') { 
       $contactmethodserror= "<div class=error>Please select an option</div>"; 
       }  
       
       if(empty($response)) {
        $responseerror="<div class=error>Please select an option</div>";
       }
       
       if(empty($feedback)) {
           $feedbackerror="<div class=error>Please enter information</div>";
       }
       
       if (empty($nameerror) && empty($emailerror) && empty($phonenumbererror) && empty($contactmethodserror) && empty($responseerror) && empty($feedbackerror)){
   		$headermessage = "<div class=success>Thanks for submitting!</h3></div>";
   	} else{
   	$headermessage = "<div class=success>**Please correct form errors</h3></div>";
   	}
   }
       
   
   
   
   
   if(isset($_POST['submit']) && empty($nameerror) && empty($emailerror) && empty($phonenumbererror) && empty($contactmethodserror) && empty($responseerror) && empty($feedbackerror)){
    $to = "mms368@cornell.edu"; 
    $from = $_POST['email']; 
    $name = $_POST['name'];
    $subject = "Form submission";
    $message = $name . " wrote the following:" . "\n\n" . 
        "Name: ".$name."\n\n" .
        "Email: ".$email."\n\n" .
        "Phone Number: ".$phonenumber."\n\n" .
        "Feedback: ".$feedback."\n\n" .
        "Response: ".$response."\n\n" .
        "Contact Method: ".$contactmethods."\n\n" .
   
   
    $headers = "From:" . $from;
   
    mail($to,$subject,$message,$headers);
    
    

    }
   
   
?>

<?php include("navigation.php"); ?>
<div class="test">
   <?php title("Contact Me"); ?>
</div>
<p class=formintroduction>I hope you enjoyed learning about me!  If you have any further questions, comments, or concerns, please fill out the form below and I'll get back to you ASAP!</p>
<form action="ContactMe.php" method="post">
   <fieldset>
      <?php echo $headermessage ?>
      <p class=name>Primary Contact Name:</p>
      <input type="text" name="name" required placeholder="John Doe"
         value="<?php echo $name ?>"/>
      <?php echo $nameerror ?>
      <p class=email>Email Address:</p>
      <input type="email" name="email" required
         value="<?php echo $email ?>" placeholder="yourname@email.com"/>
      <?php echo $emailerror ?>
      <p class=phone>Phone Number:</p>
      <input type="tel" name="phonenumber" required
         value="<?php echo $phonenumber ?>" placeholder="123-123-1234"/>
      <?php echo $phonenumbererror ?>
      <p class=feedback>Feedback:</p>
      <textarea rows="3" cols="50" name="feedback" required placeholder="If you have any questions, comments, or concerns, please describe them here."><?php echo $feedback; ?></textarea>
      <?php echo $feedbackerror ?>
      <p class=response>Does your feedback warrant a response?</p>
      <input type="radio" name="response" value="Yes" <?php if(isset($_POST['response']) && $_POST['response'] == "Yes") echo 'checked="checked"' ;?>>
      Yes
      <input type="radio" name="response" value="No" <?php if(isset($_POST['response']) && $_POST['response'] == "No") echo 'checked="checked"' ;?>>
      No 
      <?php echo $responseerror ?>
      <p class=responsetype>What is the best way for me to contact you, regarding your feedback?</p>
      <select name="contactmethods">
         <option value="Empty">Please select an option</option>
         <option value="No response" <?php if (isset($_POST['contactmethods']) && $_POST['contactmethods'] == "No response") echo 'selected="selected"' ;?>>No response necessary</option>
         <option value="Phone" <?php if (isset($_POST['contactmethods']) && $_POST['contactmethods'] == "Phone") echo 'selected="selected"' ;?>>Phone</option>
         <option value="Email" <?php if (isset($_POST['contactmethods']) && $_POST['contactmethods'] == "Email") echo 'selected="selected"' ;?>>Email</option>
      </select>
      <?php echo $contactmethodserror ?><br><br>
      <input class=submit type="submit" name="submit" value="Click to submit" />
   </fieldset>
</form>
<br><br>
</body> 
</html>