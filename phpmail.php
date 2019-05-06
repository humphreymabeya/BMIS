<?php
    function sendMail()
    {
        $to = 'humphrey.mabeya@tezzasolutions.com';
        $from = 'humphreymabeya@gmail.com';
        $subject = 'Test Mail';
    
        $headers  = 'MIME-Version: 1.0'. "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$from . "\r\n";
        $headers .= 'X-Mailer: PHP/'.phpversion();
    
        $message = 'This mail is sent for testing.';
    
        $mail = mail($to, $subject, $message, $headers);
    
        if (!$mail) {
            return 'Error occured sending mail.';
        }
    
        return 'Mail successfully sent.';
    }
    
    echo sendmail();
?>