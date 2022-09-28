<?php 

/*
  Template Name: Contact
*/

/**
 * The template for displaying and holding contact form code
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */


get_header(); 

$messageStatus = "";

if (!empty( $_POST ) && isset($_POST['textinputYourName'])) { 

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . get_option('admin_email') . "\r\n";

    $to = get_option('admin_email');
    if (get_theme_mod(GENLITE_CONTACT_MAILTO)) {
      $to = get_theme_mod(GENLITE_CONTACT_MAILTO);
    }
     
    $subject = __('Contact Form Message has arrived', 'genlite');
    if (get_theme_mod(GENLITE_CONTACT_SUBJECT)) {
        $subject = get_theme_mod(GENLITE_CONTACT_SUBJECT);
    }

    $messageStatus = __('Thanks for reaching out.  Once reviewed I will get back to you as soon as possible.','genlite');
    if (get_theme_mod(GENLITE_CONTACT_STATUS)) {
       $messageStatus = get_theme_mod(GENLITE_CONTACT_STATUS);
    }

    $textinputYourName = esc_attr($_POST["textinputYourName"]);
    $textinputYourEmail = esc_attr($_POST["textinputYourEmail"]);
    $textareaMessage = esc_attr($_POST["textareaMessageDetails"]);
  
    $body = $textinputYourName . " - " . $textinputYourEmail . " - " . $textareaMessage;

    
    if ($to === '' || $subject === '' ) {
       $messageStatus = __('Required missing fields','genlite');
     } else {
        if ( !is_customize_preview() ) { 
          
           wp_mail( $to, $subject, $body, $headers );

        }
   	}	 
}

?>

<div class="container">

    <div class="row justify-content-center">
    
      <div class="genlite-title-row">

            <h1 class="text-center"><?php the_title(); ?></h1>

       </div>

    </div>        
  
    <div class="row">

        <div class = "col-lg-12 text-center">

          <?php while(have_posts()) : the_post(); ?>

              <?php the_content(''); ?>

          <?php 

          endwhile; wp_reset_query(); ?>

          <br>
        
        </div>

    </div>

    <div class="row justify-content-center">

        <div class = "col-lg-4 col-md-offset-4">     

          <form name="genliteContact" method="post" class="form-horizontal">
  
            <fieldset>

                  <div class="form-group">
                    <label class="genlite-contact-label" for="textinputYourName"><?php esc_attr_e('Name *','genlite'); ?></label>  
                    <div>
                      <input id="textinputYourName" name="textinputYourName" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="genlite-contact-label" for="textinputYourEmail"><?php esc_attr_e('Email *','genlite'); ?></label>  
                    <div>
                      <input id="textinputYourEmail" name="textinputYourEmail" type="email" placeholder="" class="form-control input-md" required="">
                    </div>  
                  </div>

                  <div class="form-group">
                    <label class="genlite-contact-label" for="textareaMessageDetails"><?php esc_attr_e('Message Details *','genlite'); ?></label>
                    <div>                     
                      <textarea rows="10" class="form-control" id="textareaMessageDetails" name="textareaMessageDetails"></textarea>
                    </div>
                  </div>

           </fieldset>

           <br>
	 	     
	         <div class="form-group">

	              <div class="col-12 text-center">
	                 <button class="genlite-btn-contact" type="submit" id="singlebuttonSend" name="singlebuttonSend" ><?php esc_attr_e('Send','genlite'); ?></button>
	              </div>

	         </div>
	   
          <br>

          <div class="text-center genlite-green"><?php echo esc_attr($messageStatus); ?></div>

          <br>

        </form>

        <!-- End of Contact Form  -->

      </div>
  
   </div>

</div>


<?php get_footer(); ?>