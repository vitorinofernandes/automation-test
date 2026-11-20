( function () {
	// Mobile menu (below 900 px): the menu button opens the links as a full-width panel.
	document.querySelectorAll( '[data-se-header]' ).forEach( function ( header ) {
		var toggle = header.querySelector( '[data-se-header-toggle]' );
		var panel = toggle && document.getElementById( toggle.getAttribute( 'aria-controls' ) );
		if ( ! toggle || ! panel ) {
			return;
		}
		var setOpen = function ( open, focusToggle ) {
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			header.classList.toggle( 'is-open', open );
			if ( open ) {
				var first = panel.querySelector( 'a' );
				if ( first ) {
					first.focus();
				}
			} else if ( focusToggle ) {
				toggle.focus();
			}
		};
		toggle.addEventListener( 'click', function () {
			setOpen( toggle.getAttribute( 'aria-expanded' ) !== 'true', false );
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key && header.classList.contains( 'is-open' ) ) {
				setOpen( false, true );
			}
		} );
		panel.addEventListener( 'click', function ( e ) {
			if ( e.target.closest( 'a' ) ) {
				setOpen( false, false );
			}
		} );
		window.matchMedia( '(min-width: 901px)' ).addEventListener( 'change', function ( mq ) {
			if ( mq.matches ) {
				setOpen( false, false );
			}
		} );
	} );
} )();
