( function () {
	// Services carousel.
	document.querySelectorAll( '[data-se-carousel]' ).forEach( function ( root ) {
		var track = root.querySelector( '.se-carousel__track' );
		root.querySelectorAll( '[data-dir]' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var card = track.firstElementChild;
				var step = card ? card.getBoundingClientRect().width + 16 : 320;
				track.scrollBy( { left: step * Number( btn.dataset.dir ), behavior: 'smooth' } );
			} );
		} );
	} );

	// Reels: click a tile to play or pause its video.
	document.querySelectorAll( '[data-se-reel]' ).forEach( function ( tile ) {
		var video = tile.querySelector( 'video' );
		var btn = tile.querySelector( '[data-se-reel-play]' );
		if ( ! video || ! btn ) {
			return;
		}
		var toggle = function () {
			if ( video.paused ) {
				video.play();
			} else {
				video.pause();
			}
		};
		btn.addEventListener( 'click', toggle );
		video.addEventListener( 'click', toggle );
		video.addEventListener( 'play', function () {
			tile.classList.add( 'is-playing' );
		} );
		video.addEventListener( 'pause', function () {
			tile.classList.remove( 'is-playing' );
		} );
	} );

	// Tabs: price explorer and FAQ.
	document.querySelectorAll( '[data-se-tabs]' ).forEach( function ( root ) {
		var tabs = root.querySelectorAll( '[data-se-tab]' );
		var panels = root.querySelectorAll( '[data-se-panel]' );
		tabs.forEach( function ( tab, i ) {
			tab.addEventListener( 'click', function () {
				tabs.forEach( function ( t, j ) {
					t.classList.toggle( 'is-active', i === j );
					t.setAttribute( 'aria-selected', i === j ? 'true' : 'false' );
				} );
				panels.forEach( function ( p, j ) {
					p.hidden = i !== j;
				} );
			} );
		} );
	} );

	// Contact: send the block's form to its Contact Form 7 form (REST feedback endpoint).
	document.querySelectorAll( '[data-se-contact]' ).forEach( function ( form ) {
		var status = form.querySelector( '.se-contact__response' );
		var button = form.querySelector( '[type="submit"]' );
		form.addEventListener( 'submit', function ( e ) {
			e.preventDefault();
			form.querySelectorAll( '.is-invalid' ).forEach( function ( f ) {
				f.classList.remove( 'is-invalid' );
			} );
			form.querySelectorAll( '[aria-invalid]' ).forEach( function ( c ) {
				c.removeAttribute( 'aria-invalid' );
			} );
			if ( button ) {
				button.disabled = true;
			}
			fetch( form.action, { method: 'POST', body: new FormData( form ), headers: { Accept: 'application/json' } } )
				.then( function ( r ) {
					return r.json();
				} )
				.then( function ( res ) {
					var ok = res && 'mail_sent' === res.status;
					( res.invalid_fields || [] ).forEach( function ( inv ) {
						var control = form.querySelector( '[name="' + String( inv.field ).replace( /"/g, '' ) + '"]' );
						if ( control ) {
							control.setAttribute( 'aria-invalid', 'true' );
							var wrap = control.closest( '.se-contact__field' );
							if ( wrap ) {
								wrap.classList.add( 'is-invalid' );
							}
						}
					} );
					if ( status ) {
						status.textContent = ( res && res.message ) || '';
						status.classList.toggle( 'is-error', ! ok );
					}
					if ( ok ) {
						form.reset();
					}
				} )
				.catch( function () {
					if ( status ) {
						status.textContent = 'Sorry, the message could not be sent. Please call us.';
						status.classList.add( 'is-error' );
					}
				} )
				.finally( function () {
					if ( button ) {
						button.disabled = false;
					}
				} );
		} );
	} );
} )();
