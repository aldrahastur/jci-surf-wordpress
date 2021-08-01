import './editor.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { 
    BlockControls,
    MediaUpload,
    RichText,
    InspectorControls,
} = wp.editor;
const {
    Fragment,
} = wp.element;
const {
    Button,
    ToggleControl,
    Toolbar,
    IconButton,
    PanelBody,
    PanelRow,
    Icon,
} = wp.components;

const iconEl = () => (
	<Icon
		icon={
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false">
                <path fill="none" d="M0 0h24v24H0V0z"></path>
                <path d="M18.62 18h-5.24l2-4H13V6h8v7.24L18.62 18zm-2-2h.76L19 12.76V8h-4v4h3.62l-2 4zm-8 2H3.38l2-4H3V6h8v7.24L8.62 18zm-2-2h.76L9 12.76V8H5v4h3.62l-2 4z"></path>
            </svg>
		}
	/>
);

registerBlockType( 'wjd/cite', {
    title: __( 'Zitat' ),
    icon: iconEl,
    category: 'common',
    keywords: [
        'zitat',
    ],
    attributes: {
        mediaID: {
			type: 'number',
			src: 'attribute',
			selector: 'img',
			attribute: 'data-media-id',
		},
		mediaURL: {
			type: 'string',
			src: 'attribute',
			selector: 'img',
			attribute: 'src',
		},
        cite: {
            type: 'string'
        },
        person: {
            type: 'string'
        },
        enterprise: {
            type: 'string'
        },
        citeStyle: {
            type: 'boolean',
            default: false
        }
    },
    edit: function( props ) {
        const {
            className,
            attributes: {
                mediaID,
				mediaURL,
                cite,
                person,
                enterprise,
                citeStyle,
            },
            setAttributes,
        } = props;
        return (
            <div class={`wjd-quote ${citeStyle?'is-highlight':'is-detail'}`} >
                    <Fragment>
                        <InspectorControls key='inspector'>
                            <PanelBody title="Zitateigenschaften">
                                <PanelRow>
                                    <ToggleControl
                                        label="Highlight Stil"
                                        checked={ !! citeStyle }
                                        onChange={ () => { setAttributes( { citeStyle: !citeStyle } ) } }
                                    />
                                </PanelRow>
                            </PanelBody>
                        </InspectorControls>
                        <BlockControls>
                            <Toolbar>
                                <MediaUpload
                                    allowedTypes={ [ 'image' ] }
                                    value={ mediaID }
                                    onSelect={ ( image ) => setAttributes( { mediaID: image.id, mediaURL: image.url } ) }
                                    render={ ( { open } ) => (
                                        <IconButton
                                            className="components-toolbar__control"
                                            label={ __( 'Bild ändern' ) }
                                            icon={ 'edit' }
                                            onClick={ open }
                                        />
                                    ) }
                                />
                                <IconButton
                                    className="components-toolbar__control"
                                    label={ __( 'Bild entfernen' ) }
                                    icon={ 'no' }
                                    onClick={ () => setAttributes( { mediaID: undefined } ) }
                                />
                            </Toolbar>
                        </BlockControls>
                        <div>
                            <MediaUpload
                                onSelect={ ( image ) =>
                                    setAttributes( {
                                        mediaID: image.id,
                                        mediaURL: image.url,
                                    } ) }
                                type="image"
                                value={ mediaID }
                                render={ ( { open } ) => (
                                    <Button className={ mediaID ? 'image-button' : 'button button-large' } onClick={ open }>
                                        { ! mediaID ? __( 'Zitatbild wählen' ) : <img src={ mediaURL } alt={ __( 'Zitatbild wählen' ) } data-media-id={ mediaID } /> }
                                    </Button>
                                ) }
                            />
                        </div>
                        <div class="cite-content">
                            <Fragment>
                                <RichText
                                    tagName="h3"
                                    placeholder={ 'Zitatstext' }
                                    value={cite}
                                    onChange={ ( value ) => setAttributes( { cite: value } ) }
                                />
                                <RichText
                                    tagName="strong"
                                    placeholder={ 'Zitierte Person' }
                                    value={person}
                                    onChange={ ( value ) => setAttributes( { person: value } ) }
                                />
                                <RichText
                                    tagName="p"
                                    placeholder={ 'Titel der Person' }
                                    value={enterprise}
                                    onChange={ ( value ) => setAttributes( { enterprise: value } ) }
                                />
                            </Fragment>
                        </div>
                    </Fragment>
                </div>
        );
    },
    save: function( props ) {
        return (props);
    },
} );