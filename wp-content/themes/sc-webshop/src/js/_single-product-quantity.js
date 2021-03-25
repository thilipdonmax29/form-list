( function ( $ ) {
	const input = $( '.quantity input' );

	input.attr( 'type', 'text' );
	input.before(
		'<a href="#" class="btn btn-outline-secondary rounded-circle qty-decrease">-</a>'
	);
	input.after(
		'<a href="#" class="btn btn-outline-secondary rounded-circle qty-increase">+</a>'
	);

	// Increase quantity.
	$( document ).on( 'click', '.qty-increase', function ( e ) {
		e.preventDefault();

		if ( input.val() < input.attr( 'max' ) ) {
			input.val( function ( i, oldval ) {
				return parseInt( oldval, 10 ) + 1;
			} );
		}
	} );

	// Decrease quantity.
	$( document ).on( 'click', '.qty-decrease', function ( e ) {
		e.preventDefault();

		if ( input.val() > input.attr( 'min' ) ) {
			input.val( function ( i, oldval ) {
				return parseInt( oldval, 10 ) - 1;
			} );
		}
	} );
} )( jQuery );


$(function() {
	// Initialize form validation on the registration form.
	// It has the name attribute "registration"
	$("form[name='myform']").validate({
	  // Specify validation rules
	  rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
		name: "required",
		tel: "required",
		email: {
		  required: true,
		  // Specify that email should be validated
		  // by the built-in "email" rule
		  email: true
		}
	  },
	  // Specify validation error messages
	  messages: {
		name: "Please enter your name",
		tel: "Please enter your phone number",
		email: "Please enter a valid email address"
	  },
	  // Make sure the form is submitted to the destination defined
	  // in the "action" attribute of the form when valid
	  submitHandler: function(form) {
		form.submit();
	  }
	});
  });
