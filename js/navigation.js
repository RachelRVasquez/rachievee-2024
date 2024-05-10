/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const menuToggleBtn = document.getElementById('menu-toggle');

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof menuToggleBtn ) {
		return;
	}

	const mobileMenu = document.getElementById('mobile-menu');

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof mobileMenu ) {
		menuToggleBtn.style.display = 'none';
		return;
	}

	// Toggle the .active class and the aria-expanded value each time the button is clicked.
	menuToggleBtn.addEventListener( 'click', () => {
		menuToggleBtn.classList.toggle( 'active' );
		mobileMenu.classList.toggle( 'active' );
		document.body.classList.toggle('mobile-menu-active');

		if ( menuToggleBtn.getAttribute( 'aria-expanded' ) === 'true' ) {
			menuToggleBtn.setAttribute( 'aria-expanded', 'false' );
		} else {
			menuToggleBtn.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	// Get all the link elements within the menu.
	const links = mobileMenu.getElementsByTagName( 'a' );

	// Get all the link elements with children within the menu.
	const linksWithChildren = mobileMenu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}

	const skipLink = document.querySelector('.skip-link');

	if ( 'undefined' === typeof skipLink ) {
		return;
	}

	//Skip link is the next focus point after header menus so if the mobile menu is open, close it on focus
	skipLink.addEventListener( 'focus', function( event ) {
		console.log('testing this');
		if ( document.body.classList.contains('mobile-menu-active')) {
			mobileMenu.classList.remove( 'active' );
			menuToggleBtn.classList.remove( 'active' );
			menuToggleBtn.setAttribute( 'aria-expanded', 'false' );
			document.body.classList.remove('mobile-menu-active');
		}
	} );
}() );
