import './editor.scss';
import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
	URLInput,
	RichText,
	InspectorControls,
	BlockControls,
} = wp.editor;
const {
	Fragment,
} = wp.element;
const {
	Dashicon,
	PanelBody,
	PanelRow,
	ColorPalette,
	RadioControl,
	Icon,
	SelectControl,
	IconButton,
	Toolbar,
	TextControl,
} = wp.components;

const iconEl = () => (
	<Icon
		icon={
			<svg width="24" height="24" role="img" aria-hidden="true" focusable="false">
				<path fill="none" d="M0,0h24v24H0V0z"></path>
				<path d="M19,6H5c-1.1,0-2,.9-2,2v8c0,1.1.9,2,2,2h14c1.1,0,2-.9,2-2V8c0-1.1-.9-2-2-2zm0,10H5V8h14v8z"></path>
			</svg>
		}
	/>
);

registerBlockType( 'wjd/button', {
	title: __( 'Button' ),
	icon: iconEl,
	category: 'common',
	keywords: [
		'button',
		'knopf',
	],
	attributes: {
		buttonText: {
			type: 'string',
		},
		buttonUrl: {
			type: 'string',
		},
		mainColor: {
			type: 'string',
			default: '#013493',
		},
		buttonType: {
			type: 'string',
			default: 'default',
		},
		icons: {
			type: 'string',
			default: 'none',
		},
		iconType: {
			type: 'string',
			default: 'none',
		},
		buttonAlignment: {
			type: 'string',
			default: 'left',
		},
		faFreeText: {
			type: 'string',
		},
	},
	edit: function( props ) {
		const {
			className,
			attributes: {
				buttonText,
				buttonUrl,
				mainColor,
				buttonType,
				icons,
				iconType,
				buttonAlignment,
				faFreeText,
			},
			setAttributes,
			isSelected,
		} = props;
		const colors = [
			{ name: 'blue', color: '#013493' },
			{ name: 'mint', color: '#41d4ae' },
			{ name: 'orange', color: '#f8a102' },
		];
		const onChangeIcon = ( value ) => {
			{ setAttributes( { faFreeText: '' } ); }
			{ setAttributes( { iconType: value } ); }
		};
		const onChangeFA = ( value ) => {
			{ setAttributes( { iconType: '' } ); }
			{ setAttributes( { faFreeText: value } ); }
		};
		return (
			<div className={ className }>
				<Fragment>
					<InspectorControls>
						<PanelBody title="Style">
							<PanelRow>
								<RadioControl
									help="Darstellung des Buttons"
									selected={ buttonType }
									options={ [
										{ label: 'Standard', value: 'default' },
										{ label: 'Gefüllt', value: 'solid' },
										{ label: 'Transparent', value: 'inverted' },
									] }
									onChange={ ( value ) => {
										setAttributes( { buttonType: value } );
									} }
								/>
							</PanelRow>
						</PanelBody>
						<PanelBody title="Icon">
							<PanelRow>
								<SelectControl
									label="Icons einfügen"
									value={ icons }
									options={ [
										{ label: 'Keins', value: 'none' },
										{ label: 'Vorne', value: 'start' },
										{ label: 'Hinten', value: 'end' },
										{ label: 'Beides', value: 'both' },
									] }
									onChange={ ( value ) => {
										setAttributes( { icons: value } );
									} }
								/>
							</PanelRow>
							{ icons !== 'none' && (
								<Fragment>
									<PanelRow>
										<RadioControl
											className="icon-select"
											help="Icon auswählen"
											selected={ iconType }
											options={ [
												{ label: 'Stern', value: 'star' },
												{ label: 'Pfeil rechts', value: 'angle-right' },
												{ label: 'Pfeil links', value: 'angle-left' },
											] }
											onChange={ onChangeIcon }
										/>
									</PanelRow>
									<PanelRow>
										<TextControl
											label="FontAwesome Icon Name"
											value={ faFreeText }
											onChange={ onChangeFA }
											help="Name eines FontAwesome Icons eingeben"
										/>
									</PanelRow>
									<strong><a href="https://fontawesome.com/icons?d=gallery&s=solid&m=free" target="_blank">Liste von Icons</a></strong>
								</Fragment>
							) }
						</PanelBody>
						<PanelBody title="Farbeinstellungen">
							<PanelRow>
								<ColorPalette
									colors={ colors }
									value={ mainColor }
									onChange={ ( value ) => setAttributes( { mainColor: value } ) }
								/>
							</PanelRow>
						</PanelBody>
					</InspectorControls>
				</Fragment>
				<BlockControls>
					<Toolbar>
						<IconButton
							className="components-toolbar__control"
							label={ __( 'Button links ausrichten' ) }
							icon={ 'align-left' }
							onClick={ () => setAttributes( { buttonAlignment: 'left' } ) }
						/>
						<IconButton
							className="components-toolbar__control"
							label={ __( 'Button mittig ausrichten' ) }
							icon={ 'align-center' }
							onClick={ () => setAttributes( { buttonAlignment: 'center' } ) }
						/>
						<IconButton
							className="components-toolbar__control"
							label={ __( 'Button rechts ausrichten' ) }
							icon={ 'align-right' }
							onClick={ () => setAttributes( { buttonAlignment: 'right' } ) }
						/>
					</Toolbar>
				</BlockControls>
				<div className={ `button-wrapper ${ buttonAlignment }` }>
					<RichText
						tagName="div"
						className={ `wjd-button is-${ buttonType } color-palette-${ findWithAttr( colors, 'color', mainColor ) } icon-${ icons } icon-type-${ iconType } fa-${ faFreeText }` }
						placeholder={ 'Text hier eigeben' }
						value={ buttonText }
						onChange={ ( value ) => setAttributes( { buttonText: value } ) }
					/>
					{ isSelected && (
						<div className="link-controls">
							<Dashicon icon="admin-links" />
							<URLInput
								value={ buttonUrl }
								onChange={ ( value ) => setAttributes( { buttonUrl: value } ) }
							/>
						</div>
					) }
				</div>
			</div>
		);
	},
	save: function( props ) {
		return ( props );
	},
} );

function findWithAttr( array, attr, value ) {
	for ( let i = 0; i < array.length; i += 1 ) {
		if ( array[ i ][ attr ] === value ) {
			return i;
		}
	}
	return -1;
}
