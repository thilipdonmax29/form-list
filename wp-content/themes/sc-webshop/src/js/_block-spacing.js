import assign from 'lodash/assign';
import classnames from 'classnames';
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, SelectControl } = wp.components;

// Enable margin control on the following blocks
const enableSpacingControlOnBlocks = [ 'core/cover', 'core/group' ];

// Available margin control options
const marginControlOptions = [
	{
		label: __( 'Bottom' ),
		value: 'margin-bottom',
	},
	{
		label: __( 'Top' ),
		value: 'margin-top',
	},
	{
		label: __( 'Top & Bottom' ),
		value: 'margin-top-bottom',
	},
	{
		label: __( 'None' ),
		value: 'no-margin',
	},
];

// Available padding control options
const paddingControlOptions = [
	{
		label: __( 'None' ),
		value: 'no-padding',
	},
	{
		label: __( 'Top' ),
		value: 'padding-top',
	},
	{
		label: __( 'Bottom' ),
		value: 'padding-bottom',
	},
	{
		label: __( 'Top & Bottom' ),
		value: 'padding-top-bottom',
	},
	{
		label: __( 'Double Top & Bottom' ),
		value: 'padding-top-bottom-double',
	},
];

/**
 * Add margin control attribute to block.
 *
 * @param {Object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @return {Object} Modified block settings.
 */
const addSpacingControlAttribute = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! enableSpacingControlOnBlocks.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		margin: {
			type: 'string',
			default: marginControlOptions[ 0 ].value,
		},
		padding: {
			type: 'string',
			default: paddingControlOptions[ 0 ].value,
		},
	} );

	return settings;
};

addFilter(
	'blocks.registerBlockType',
	'block-spacing/attributes',
	addSpacingControlAttribute
);

/**
 * Create HOC to add spacing control to inspector controls of block.
 */
const withSpacingControl = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		// Do nothing if it's another block than our defined ones.
		if ( ! enableSpacingControlOnBlocks.includes( props.name ) ) {
			return <BlockEdit { ...props } />;
		}

		const { margin, padding, className } = props.attributes;

		// add margin classes to block
		// eslint-disable-next-line no-shadow
		const selectedMarginOption = ( margin ) => {
			let classes = className ? className.split( ' ' ) : [];

			classes = classes.filter( ( x ) => {
				return ! marginControlOptions.filter(
					( option ) => 'has-spacing-' + option.value === x
				).length;
			} );

			props.setAttributes( {
				margin,
				className: classnames( `has-spacing-${ margin }`, classes ),
			} );
		};

		// add padding classes to block
		// eslint-disable-next-line no-shadow
		const selectedPaddingOption = ( padding ) => {
			let classes = className ? className.split( ' ' ) : [];

			classes = classes.filter( ( x ) => {
				return ! paddingControlOptions.filter(
					( option ) => 'has-spacing-' + option.value === x
				).length;
			} );

			props.setAttributes( {
				padding,
				className: classnames( `has-spacing-${ padding }`, classes ),
			} );
		};

		return (
			<Fragment>
				<BlockEdit { ...props } />
				<InspectorControls>
					<PanelBody title={ __( 'Spacing' ) } initialOpen={ true }>
						<SelectControl
							label={ __( 'Margin' ) }
							value={ margin }
							options={ marginControlOptions }
							onChange={ selectedMarginOption }
						/>
						<SelectControl
							label={ __( 'Padding' ) }
							value={ padding }
							options={ paddingControlOptions }
							onChange={ selectedPaddingOption }
						/>
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);
	};
}, 'withSpacingControl' );

addFilter(
	'editor.BlockEdit',
	'block-spacing/with-spacing-control',
	withSpacingControl
);
