/**
 * Generic sidebar editor for the se/* blocks.
 * Every attribute in a block's block.json becomes a sidebar field:
 * strings -> text/textarea, names ending in Image/Video -> media picker,
 * arrays of objects -> repeater. The preview is rendered by PHP.
 */
( function ( wp ) {
	const el = wp.element.createElement;
	const { Fragment } = wp.element;
	const { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } = wp.blockEditor;
	const { PanelBody, TextControl, TextareaControl, Button } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const TEXTAREA = [ 'heading', 'intro', 'text', 'a', 'included', 'quote', 'statement', 'hint', 'body' ];

	const label = ( key ) => key.replace( /([A-Z])/g, ' $1' ).replace( /^./, ( c ) => c.toUpperCase() );

	function field( key, value, onChange ) {
		if ( /(image|video)$/i.test( key ) ) {
			const isVideo = /video$/i.test( key );
			return el(
				'div',
				{ key, style: { marginBottom: 16 } },
				el( TextControl, { label: label( key ) + ' (URL)', value: value || '', onChange } ),
				el(
					MediaUploadCheck,
					null,
					el( MediaUpload, {
						allowedTypes: [ isVideo ? 'video' : 'image' ],
						onSelect: ( m ) => onChange( m.url ),
						render: ( { open } ) => el( Button, { variant: 'secondary', onClick: open }, 'Choose from Media Library' )
					} )
				)
			);
		}
		if ( TEXTAREA.indexOf( key ) !== -1 ) {
			return el( TextareaControl, { key, label: label( key ), value: value || '', onChange, rows: 3 } );
		}
		return el( TextControl, { key, label: label( key ), value: value || '', onChange } );
	}

	function makeEdit( attrs, name ) {
		return function Edit( props ) {
			const { attributes, setAttributes } = props;
			const simple = [];
			const repeaters = [];
			Object.keys( attrs ).forEach( ( key ) => {
				const def = attrs[ key ];
				if ( def.type === 'array' && def.items && def.items.properties ) {
					const props2 = Object.keys( def.items.properties );
					const list = attributes[ key ] || [];
					const update = ( next ) => setAttributes( { [ key ]: next } );
					repeaters.push(
						el(
							PanelBody,
							{ key, title: label( key ) + ' (' + list.length + ')', initialOpen: false },
							list.map( ( item, i ) =>
								el(
									PanelBody,
									{ key: i, title: ( i + 1 ) + '. ' + ( item[ props2[ 0 ] ] || '' ).toString().slice( 0, 28 ), initialOpen: false },
									props2.map( ( p ) =>
										field( p, item[ p ], ( v ) => update( list.map( ( it, j ) => ( j === i ? { ...it, [ p ]: v } : it ) ) ) )
									),
									el( Button, { isDestructive: true, variant: 'link', onClick: () => update( list.filter( ( _, j ) => j !== i ) ) }, 'Remove' )
								)
							),
							el(
								Button,
								{
									variant: 'secondary',
									onClick: () => update( list.concat( [ props2.reduce( ( o, p ) => ( { ...o, [ p ]: '' } ), {} ) ] ) )
								},
								'Add item'
							)
						)
					);
				} else if ( def.type === 'string' || def.type === 'integer' ) {
					simple.push( field( key, attributes[ key ], ( v ) => setAttributes( { [ key ]: v } ) ) );
				}
			} );
			return el(
				Fragment,
				null,
				el( InspectorControls, null, el( PanelBody, { title: 'Content', initialOpen: true }, simple ), repeaters ),
				el( 'div', useBlockProps( { className: 'alignfull' } ), el( ServerSideRender, { block: name, attributes } ) )
			);
		};
	}

	// Register every se/* block in the editor (they are rendered by PHP; the editor needs a JS
	// registration too, or it shows "Your site doesn't include support for this block").
	const defs = window.seBlocks || {};
	Object.keys( defs ).forEach( function ( name ) {
		if ( wp.blocks.getBlockType( name ) ) {
			return;
		}
		const d = defs[ name ];
		wp.blocks.registerBlockType( name, {
			apiVersion: 3,
			title: d.title,
			description: d.description,
			category: d.category,
			icon: d.icon,
			attributes: d.attributes,
			supports: { html: false },
			edit: makeEdit( d.attributes || {}, name ),
			save: () => null,
		} );
	} );
} )( window.wp );
