<?php
/*

Template Name: Contact Response

*/



function isValid() {

    if ( $_POST['your_name'] != "" && $_POST['email_address'] != "" && $_POST['your_message'] != "" && filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL) ) {

        return true;

    } else {
 
        return false;
    }

}

function send_email( $from, $to, $body ) {

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $from . "\r\n";

    $subject = 'Contact Form';

    wp_mail( $to, $subject, $body, $headers );
    
}


if ( !empty( $_POST )) {

    $contact_form = get_field( 'contact_form', 'options' );
    $from = $contact_form['from_email'];
    $to = $contact_form['to_email'];
    $recaptcha = $contact_form['recapthca_secret_key'];

    // echo $from;
    // echo $to;
    // echo $recaptcha;

    // exit;



    $email_body = '';

    // -------------- Name ------------------

    if ( isset( $_POST['your_name'] ) ) {
        
        $your_name = $_POST['your_name']; 

        $email_body .= '<hr><b>Name</b><br />';
        $email_body .= $your_name . '<br />';

    }
   
    // -------------- Email -----------------

    if ( isset( $_POST['email_address'] ) ) {

        $email_address = $_POST['email_address']; 
        
        $email_body .= '<hr><b>Email Address</b><br />';
        $email_body .= $email_address . '<br/>';

    }

    // --------------- Subject -----------------

    if ( !empty( $_POST['subject'] ) ) {

        $subject = $_POST['subject']; 
        
        $email_body .= '<hr><b>Subject</b><br />';
        $email_body .= $subject . '<br/>';

    }

    // --------------- Your Message -----------------

    if ( !empty( $_POST['your_message'] ) ) {

        $your_message = $_POST['your_message']; 
        
        $email_body .= '<hr><b>Your Message</b><br />';
        $email_body .= $your_message . '<br/>';

    }


    $error_output = '';
    $success_output = '';

//    send_email( $from, $to, $email_body );


    if ( isValid() ) {

        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = $recaptcha;
        $recaptcha_response = $_POST['recaptcha_response'];
        $recaptcha = file_get_contents( $recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response );
        $recaptcha = json_decode( $recaptcha );

        if ( $recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == 'contact' ) {

            send_email( $from, $to, $email_body );

            $success_output = "Thank you. Your details have been submitted.";
            

        } else {

            $error_output = "Something went wrong. Please try again later.";
        }
       
    } else {

        $error_output = "Please fill all the required fields.";

    }

    $output = array(
        'error'     =>  $error_output,
        'success'   =>  $success_output
    );

    echo json_encode( $output );

}

?>
