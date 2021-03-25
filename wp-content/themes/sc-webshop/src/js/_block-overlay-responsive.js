const responsiveOverlayImage = ( windowSize ) => {
	const overlayContainer = document.querySelector( '.overlay-image' );
	const mobileImage = overlayContainer.dataset.mobileImage;
	const image = overlayContainer.dataset.image;

	if ( !! mobileImage && windowSize.matches ) {
		// If media query matches
		overlayContainer.style.backgroundImage = 'url(' + mobileImage + ')';
	} else {
		overlayContainer.style.backgroundImage = 'url(' + image + ')';
	}
};

const windowSize = window.matchMedia( '(max-width: 768px)' );
windowSize.addListener( responsiveOverlayImage );
