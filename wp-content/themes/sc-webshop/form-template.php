<?php
/**
 * Template Name: Custom Form Page
 *
 * @package Sc-webshop
 */

get_header(); ?>
<?php
if ( ! empty( $_POST ) ) {
	global $wpdb;
	$table   = 'wp_custom_form';
	$data    = array(
		'Name'     => $_POST[ 'your-name' ],
		'Email'    => $_POST[ 'your-email' ],
		'Phone'    => $_POST[ 'tel' ],
	);
	$format  = array(
		'%s',
		'%s',
		'%s',
	);
	$success = $wpdb->insert( $table, $data, $format );
	if ( $success ) {
		echo '<h3>Your request successfully send to HomeFix! Our Staff will contact you!</h3>';
	}
} else {
	?>
	<div id="primary" class="content-area">
		<form method="post" onsubmit="return validation();" name="myform" >
		<p><label> Your Name<br />
			<input type="text" name="name" value="" size="40" id="name" oninput="validateAlpha();" /></label></p>
		<p><label> Your Email<br />
			<input type="email" name="email" id="email" value="" size="40"/></label></p>
		<p><label> Your Phone Number<br />
			<input type="tel" name="tel" value="" size="40" placeholder="Mobile Number" id="mobileno" oninput="mobileValid();" /></label></p>
		<p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit" /></p>
		</form>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<?php } ?>
<script type="text/javascript">

function mobileValid(){
var textInput = document.getElementById("mobileno").value;
textInput = textInput.replace(/[^0-9]/g, "");
document.getElementById("mobileno").value = textInput;
}
</script>
<script type="text/javascript">
function validateAlpha(){
var textInput = document.getElementById("name").value;
textInput = textInput.replace(/[&\/\-_=|\][;\#,+()$~%.'":*?<>{}@^!`0-9]/g, "");
document.getElementById("name").value = textInput;
}
</script>
<script type="text/javascript">
    function validate()
    {
        if(myform.fname.value.length==0)
        {
           document.getElementById('errfn').innerHTML="this is invalid name";
        }
    }
</script>
<?php get_footer(); ?>
