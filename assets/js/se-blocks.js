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
} )();
