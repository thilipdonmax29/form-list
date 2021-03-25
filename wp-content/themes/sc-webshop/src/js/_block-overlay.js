import assign from 'lodash/assign';
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;
const { createHigherOrderComponent } = wp.compose;
const { Fragment, cloneElement, createElement } = wp.element;
const { InspectorControls, MediaUpload, MediaUploadCheck } = wp.blockEditor;
const { Button, PanelBody, SelectControl } = wp.components;

const ALLOWED_MEDIA_TYPES = [ 'image' ];

// Enable margin control on the following blocks
const enableOverlayControlOnBlocks = [ 'core/cover' ];

// Available margin control options
const overlayPlacementXOptions = [
	{
		label: __( 'Left' ),
		value: 'left',
	},
	{
		label: __( 'Center' ),
		value: 'center',
	},
	{
		label: __( 'Right' ),
		value: 'right',
	},
];

const overlayPlacementYOptions = [
	{
		label: __( 'Top' ),
		value: 'top',
	},
	{
		label: __( 'Center' ),
		value: 'center',
	},
	{
		label: __( 'Bottom' ),
		value: 'bottom',
	},
];
const overlaySizeOptions = [
	{
		label: __( 'Auto' ),
		value: 'auto',
	},
	{
		label: __( 'Cover' ),
		value: 'cover',
	},
	{
		label: __( 'Contain' ),
		value: 'contain',
	},
];

const defaultOverlayStyles = {
	backgroundPosition: 'bottom center',
	backgroundSize: 'auto',
	backgroundRepeat: 'no-repeat',
	bottom: 0,
	left: 0,
	pointerEvents: 'none',
	position: 'absolute',
	right: 0,
	top: 0,
	zIndex: 0,
};

/**
 * Add margin control attribute to block.
 *
 * @param {Object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @return {Object} Modified block settings.
 */
const addOverlayControlAttribute = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! enableOverlayControlOnBlocks.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		placementX: {
			type: 'string',
			default: overlayPlacementXOptions[ 0 ].value,
		},
		placementY: {
			type: 'string',
			default: overlayPlacementYOptions[ 2 ].value,
		},
		bgSize: {
			type: 'string',
			default: overlaySizeOptions[ 0 ].value,
		},
		overlayImage: {
			type: 'string',
			default: undefined,
		},
		overlayMobileImage: {
			type: 'string',
			default: undefined,
		},
	} );

	return settings;
};

addFilter(
	'blocks.registerBlockType',
	'block-overlay/attributes',
	addOverlayControlAttribute
);

/**
 * Create HOC to add overlay control to inspector controls of block.
 */
// eslint-disable-next-line no-unused-vars
const withOverlayControl = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		// Do nothing if it's another block than our defined ones.
		if ( ! enableOverlayControlOnBlocks.includes( props.name ) ) {
			return <BlockEdit { ...props } />;
		}

		const { attributes, setAttributes } = props;
		const {
			placementX,
			placementY,
			bgSize,
			overlayImage,
			overlayMobileImage,
		} = attributes;
		const instructions = (
			<p>
				{ __(
					'To edit the background image, you need permission to upload media.',
					'image-selector-example'
				) }
			</p>
		);

		const onUpdateImage = ( image ) => {
			setAttributes( {
				overlayImage: image.url,
			} );
		};

		const onRemoveImage = () => {
			setAttributes( {
				overlayImage: undefined,
			} );
		};

		const onUpdateMobileImage = ( image ) => {
			setAttributes( {
				overlayMobileImage: image.url,
			} );
		};

		const onRemoveMobileImage = () => {
			setAttributes( {
				overlayMobileImage: undefined,
			} );
		};

		return (
			<Fragment>
				<div
					style={ {
						position: 'relative',
					} }
				>
					<BlockEdit { ...props } />
					{ !! overlayImage &&
						createElement( 'div', {
							className: 'overlay-image',
							style: {
								...defaultOverlayStyles,
								backgroundImage: 'url(' + overlayImage + ')',
								backgroundPosition:
									placementY + ' ' + placementX,
								backgroundSize: bgSize,
							},
							'data-image': attributes.overlayImage,
							'data-mobile-image': attributes.overlayMobileImage,
						} ) }
				</div>
				<InspectorControls>
					<PanelBody
						title={ __( 'Overlay Image' ) }
						initialOpen={ true }
					>
						<div
							style={ {
								marginBottom: '24px',
							} }
						>
							<MediaUploadCheck fallback={ instructions }>
								<MediaUpload
									title={ __(
										'Overlay image',
										'image-selector-example'
									) }
									onSelect={ onUpdateImage }
									allowedTypes={ ALLOWED_MEDIA_TYPES }
									value={ overlayImage }
									render={ ( { open } ) => (
										<Button
											className={
												! overlayImage
													? 'editor-post-featured-image__toggle'
													: 'editor-post-featured-image__preview'
											}
											onClick={ open }
										>
											{ !! overlayImage && (
												<img
													src={ overlayImage }
													alt={ __(
														'Change overlay image',
														'image-selector-example'
													) }
												/>
											) }
											{ ! overlayImage &&
												__(
													'Set overlay image',
													'image-selector-example'
												) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
							{ !! overlayImage && (
								<MediaUploadCheck>
									<Button
										onClick={ onRemoveImage }
										isLink
										isDestructive
									>
										{ __(
											'Remove overlay image',
											'image-selector-example'
										) }
									</Button>
								</MediaUploadCheck>
							) }
						</div>
						<div
							style={ {
								marginBottom: '24px',
							} }
						>
							<MediaUploadCheck fallback={ instructions }>
								<MediaUpload
									title={ __(
										'Overlay mobile image',
										'image-selector-example'
									) }
									onSelect={ onUpdateMobileImage }
									allowedTypes={ ALLOWED_MEDIA_TYPES }
									value={ overlayMobileImage }
									render={ ( { open } ) => (
										<Button
											className={
												! overlayMobileImage
													? 'editor-post-featured-image__toggle'
													: 'editor-post-featured-image__preview'
											}
											onClick={ open }
										>
											{ !! overlayMobileImage && (
												<img
													src={ overlayMobileImage }
													alt={ __(
														'Change overlay mobile image',
														'image-selector-example'
													) }
												/>
											) }
											{ ! overlayMobileImage &&
												__(
													'Set overlay mobile image',
													'image-selector-example'
												) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
							{ !! overlayMobileImage && (
								<MediaUploadCheck>
									<Button
										onClick={ onRemoveMobileImage }
										isLink
										isDestructive
									>
										{ __(
											'Remove overlay mobile image',
											'image-selector-example'
										) }
									</Button>
								</MediaUploadCheck>
							) }
						</div>
						<SelectControl
							label={ __( 'Image Y Position' ) }
							value={ placementY }
							options={ overlayPlacementYOptions }
							onChange={ ( selectedPlacementYOption ) => {
								props.setAttributes( {
									placementY: selectedPlacementYOption,
								} );
							} }
						/>
						<SelectControl
							label={ __( 'Image X Position' ) }
							value={ placementX }
							options={ overlayPlacementXOptions }
							onChange={ ( selectedPlacementXOption ) => {
								props.setAttributes( {
									placementX: selectedPlacementXOption,
								} );
							} }
						/>
						<SelectControl
							label={ __( 'Image Size' ) }
							value={ bgSize }
							options={ overlaySizeOptions }
							onChange={ ( selectedBgSizeOption ) => {
								props.setAttributes( {
									bgSize: selectedBgSizeOption,
								} );
							} }
						/>
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);
	};
}, 'withOverlayControl' );

addFilter(
	'editor.BlockEdit',
	'block-overlay/with-overlay-control',
	withOverlayControl
);

const addOverlayElement = ( element, blockType, attributes ) => {
	if ( ! enableOverlayControlOnBlocks.includes( blockType.name ) ) {
		return element;
	}

	const positionX = attributes.placementX ? attributes.placementX : 'bottom';
	const positionY = attributes.placementY ? attributes.placementY : 'bottom';
	const bgSize = attributes.bgSize ? attributes.bgSize : 'bottom';

	if ( undefined !== attributes.overlayImage ) {
		const styles = {
			...defaultOverlayStyles,
			backgroundImage: 'url(' + attributes.overlayImage + ')',
			backgroundPosition: positionY + ' ' + positionX,
			backgroundSize: bgSize,
		};

		return cloneElement(
			element,
			{},
			element.props.children,
			createElement( 'div', {
				className: 'overlay-image',
				style: styles,
				'data-image': attributes.overlayImage,
				'data-mobile-image': attributes.overlayMobileImage,
			} )
		);
	}

	return element;
};

addFilter(
	'blocks.getSaveElement',
	'block-overlay/add-overlay-element',
	addOverlayElement
);
