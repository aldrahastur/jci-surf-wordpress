import './editor.scss';
import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { 
    BlockControls,
    MediaUpload,
    InnerBlocks,
    RichText,
    URLInput,
    InspectorControls,
} = wp.editor;
const {
    Fragment,
} = wp.element;
const {
    Button,
    SelectControl,
    ColorPalette,
    RadioControl,
    Toolbar,
    IconButton,
    PanelBody,
    PanelRow,
} = wp.components;

let today = new Date().toJSON();
today = today.slice(8, 10) + '.' + today.slice(5, 7) + '.' + today.slice(0, 4);
registerBlockType( 'wjd/card', {
    title: __( 'Karte' ),
    icon: 'editor-table',
    category: 'common',
    keywords: [
        'card',
        'karte',
        'block'
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
        cardHeadline: {
            type: 'string'
        },
        imageAttribution: {
            type: 'string'
        },
        imageAlignment: {
            type: 'string',
            default: 'left'
        },
        cardTag: {
            type: 'string'
        },
        cardDate: {
            type: 'string',
        },
        cardLink: {
            type: 'string'
        },
        cardLinkText: {
            type: 'string'
        },
        cardStyle: {
            type: 'string',
            default: 'is-plain'
        },
        linkType: {
            type: 'string',
            default: 'link-more'
        },
        cardColor: {
            type: 'string',
            default: '#e5eaf4'
        }
    },
    edit: function( props ) {
        const {
            className,
            attributes: {
                mediaID,
				mediaURL,
                cardHeadline,
                imageAttribution,
                imageAlignment,
                cardTag,
                cardDate,
                cardLink,
                cardLinkText,
                cardStyle,
                linkType,
                cardColor
            },
            setAttributes,
            isSelected
        } = props;
        const ALLOWED_BLOCKS = [
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/table',
            'core/spacer',
            'core-embed/twitter',
        ]
        const colors = [
            { name: 'lightblue', color: '#e5eaf4' },
            { name: 'blue', color: '#013493' },
        ];
        return (
            <div className={ className }>
                <div class={`color-palette-${findWithAttr(colors, 'color', cardColor)} ${cardStyle}`} >
                    <Fragment>
                        <InspectorControls key='inspector'>
                            <PanelBody title="Karteneigenschaften">
                                <PanelRow>
                                    <SelectControl
                                        label="Kartenstil wählen"
                                        value={ cardStyle }
                                        options={ [
                                            { label: 'Plaintext', value: 'is-plain' },
                                            { label: 'Linksbündig', value: 'v-card default' },
                                            { label: 'Gespiegelt', value: 'v-card is-mirrored' },
                                            { label: 'Vertikal', value: 'v-card is-vertical' },
                                        ] }
                                        onChange={ (value) => { setAttributes( { cardStyle: value } ) } }
                                    />
                                </PanelRow>
                                <PanelRow>
                                    <RadioControl
                                        className="link-type"
                                        help="Link Art auswählen"
                                        selected={ linkType }
                                        options={ [
                                            { label: 'Mehr lesen Link', value: 'link-more' },
                                            { label: 'Datei Link', value: 'link-file' }
                                        ] }
                                        onChange={ ( value ) => { setAttributes( { linkType: value } ) } }
                                    />
                                </PanelRow>
                                <PanelRow>
                                    <ColorPalette 
                                            colors={ colors }
                                            value={ cardColor }
                                            onChange={ (value) => { setAttributes( { cardColor: value } ) } }
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
                            { cardStyle == 'is-plain' && (
                                <Toolbar>
                                    <IconButton
                                        className="components-toolbar__control"
                                        label={ __( 'Bild links ausrichten' ) }
                                        icon={ 'align-left' }
                                        onClick={ () => setAttributes( { imageAlignment: 'left' } ) }
                                    />
                                    <IconButton
                                        className="components-toolbar__control"
                                        label={ __( 'Bild rechts ausrichten' ) }
                                        icon={ 'align-right' }
                                        onClick={ () => setAttributes( { imageAlignment: 'right' } ) }
                                    />
                                </Toolbar>
                            ) }
                        </BlockControls>
                        { cardStyle == 'is-plain' && (
                            <Fragment>
                                <div class="card-meta">
                                    <RichText
                                            tagName="small"
                                            className= "card__meta-date"
                                            placeholder={ today }
                                            value={cardDate}
                                            onChange={ ( value ) => setAttributes( { cardDate: value } ) }
                                    />
                                    <RichText
                                            tagName="small"
                                            className= "card__meta-text"
                                            placeholder={ 'Kartenkategorie' }
                                            value={cardTag}
                                            onChange={ ( value ) => setAttributes( { cardTag: value } ) }
                                    />
                                </div>
                                <div class="card-headline">
                                    <RichText
                                            tagName="h3"
                                            className= "card__headline"
                                            placeholder={ 'Kartenüberschrift' }
                                            value={cardHeadline}
                                            onChange={ ( value ) => setAttributes( { cardHeadline: value } ) }
                                    />
                                </div>
                            </Fragment>
                        ) }
                        <div class={`card-media ${ imageAlignment }`}>
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
                                        { ! mediaID ? __( 'Kartenbild wählen' ) : <img src={ mediaURL } alt={ __( 'Kartenbild wählen' ) } data-media-id={ mediaID } /> }
                                    </Button>
                                ) }
                            />
                            {mediaID && (
                                <RichText
                                    tagName="small"
                                    className= "card__image-credit"
                                    placeholder={ 'Bildattribution' }
                                    value={imageAttribution}
                                    onChange={ ( value ) => setAttributes( { imageAttribution: value } ) }
                                />
                            )}
                        </div>
                        <div class="card-content">
                            { cardStyle != 'is-plain' && (
                                <Fragment>
                                    <div class="card-meta">
                                        <RichText
                                                tagName="small"
                                                className= "card__meta-date"
                                                placeholder={ today }
                                                value={cardDate}
                                                onChange={ ( value ) => setAttributes( { cardDate: value } ) }
                                        />
                                        <RichText
                                                tagName="small"
                                                className= "card__meta-text"
                                                placeholder={ 'Kartenkategorie' }
                                                value={cardTag}
                                                onChange={ ( value ) => setAttributes( { cardTag: value } ) }
                                        />
                                    </div>
                                    <div class="card-headline">
                                        <RichText
                                                tagName="h3"
                                                className= "card__headline"
                                                placeholder={ 'Kartenüberschrift' }
                                                value={cardHeadline}
                                                onChange={ ( value ) => setAttributes( { cardHeadline: value } ) }
                                        />
                                    </div>
                                </Fragment>
                            ) }
                            <InnerBlocks
                                allowedBlocks={ ALLOWED_BLOCKS }
                            />
                        </div>
                        <div class="link-controls">
                            <small>Kartenverlinkung:</small>
                            <RichText
                                    tagName="span"
                                    placeholder={ 'Kartenlink-Text' }
                                    value={cardLinkText}
                                    onChange={ ( value ) => setAttributes( { cardLinkText: value } ) }
                            />
                            <URLInput
                                value={ cardLink }
                                onChange={ ( value ) => setAttributes( { cardLink: value } ) }
                            />
                        </div>
                    </Fragment>
                </div>
            </div>
        );
    },
    save: function( props ) {
        return (
            <InnerBlocks.Content />
        );
    },
} );

function findWithAttr(array, attr, value) {
    for(var i = 0; i < array.length; i += 1) {
        if(array[i][attr] === value) {
            return i;
        }
    }
    return -1;
}