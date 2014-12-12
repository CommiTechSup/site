    <?php
        // check if fields passed are empty
        if(empty($_POST['name'])  		||
           empty($_POST['email']) 		||
           empty($_POST['message'])	||
           !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
           {
            echo "No arguments Provided!";
            return false;
           }

        $name = $_POST['name'];
        $email_address = $_POST['email'];
        $message = $_POST['message'];

        // create email body and send it	
        $to = 'contact@commitechsup.fr';  // put your email
        $email_subject = "Contact de:  $name";
        $email_body = "<strong>$name</strong> ".
                    "<$email_address>\n tient à nous dire: \"$message\"";
        $headers = "From: contact@commitechsup.fr\n";
        $headers .= "Reply-To: $email_address\n";
        $headers .= "Content-type: text/html; charset=\"UTF8\"";
        mail($to,$email_subject,$email_body,$headers);
        return true;			
    ?>