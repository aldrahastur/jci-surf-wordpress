/* eslint-disable */
import './editor.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { 
    MediaUpload,
    RichText,
	InspectorControls,
} = wp.editor;
const { Button,
	PanelBody,
    PanelRow,
	SelectControl,
	FormToggle,
	TextControl,
} = wp.components;

registerBlockType( 'wjd/hero', {
    title: __( 'Hero' ),
    icon: 'format-gallery',
    category: 'common',
    keywords: [
        __('hero'),
        __('slider'),
    ],
    attributes: {
        images : {
            type: 'array',
        },
        headline: {
            type: 'string'
        },
        subheadline: {
            type: 'string'
        },
        heroHeight: {
            type: 'string'
        },
        heroDetailHorizontalSelect: {
            type: 'string'
        },
        heroDetailVerticalSelect: {
            type: 'string'
        },
        heroImageSize: {
            type: 'boolean',
            default: true
        }
    },
    edit({ attributes, className, setAttributes }) {
        
        const {
            images = [],
            headline,
            subheadline,
            heroHeight,
            heroDetailHorizontalSelect,
            heroDetailVerticalSelect,
            heroImageSize
        } = attributes;
        
        const removeImage = (removeImage) => {
            const newImages = images.filter( (image) => {
                if(image.id != removeImage.id) {
                    return image;
                }
            });
            setAttributes({
                images:newImages,
            })
        }
        const displayImages = (images) => {
            return (
                images.map( (image) => {
                    return (
                    <div className="gallery-item-container">
                            <img className='gallery-item' src={image.url} key={ images.id } />
                            <div className='remove-item' onClick={() => removeImage(image)}><span class="dashicons dashicons-trash"></span></div>
                            <div className='caption-text'>{image.caption[0]}</div>
                    </div>
                    )
                })
            )
        }

        return (
            <div>
                <div className="gallery-grid">
                    {displayImages(images)}
                </div>
                <br/>
                <InspectorControls>
                    <PanelBody title="Hero Einstellungen">
                        <PanelRow>
                            <TextControl
                                label="Hero Höhe in px eingeben"
                                value={ heroHeight }
                                type="number"
                                onChange={ (value) => {
                                    setAttributes( { heroHeight: value } )
                                } }
                            />
                        </PanelRow>
                        <PanelRow>
                            <SelectControl
                                label="Horizontalen Bidlausschnitt wählen"
                                value={ heroDetailHorizontalSelect }
                                options={ [
                                    { label: 'Rechts', value: 'right' },
                                    { label: 'Zentriert', value: 'center' },
                                    { label: 'Links', value: 'left' },
                                ] }
                                onChange={ ( value ) => {
                                    setAttributes( { heroDetailHorizontalSelect: value } );
                                } }
                            />
                        </PanelRow>
                        <PanelRow>
                            <SelectControl
                                label="Vertikalen Bidlausschnitt wählen"
                                value={ heroDetailVerticalSelect }
                                options={ [
                                    { label: 'Oben', value: 'top' },
                                    { label: 'Mittig', value: 'center' },
                                    { label: 'Unten', value: 'bottom' },
                                ] }
                                onChange={ ( value ) => {
                                    setAttributes( { heroDetailVerticalSelect: value } );
                                } }
                            />
                        </PanelRow>
                        <PanelRow className={'image-size'}>
                            <FormToggle
                                label="Bild füllend darstellen"
                                checked={ heroImageSize }
                                onChange={ () => {
                                    setAttributes( { heroImageSize: !heroImageSize } )
                                } }
                            />
                            <span>Bild füllend darstellen</span>
                        </PanelRow>
                    </PanelBody>
                </InspectorControls>
                <MediaUpload
                    onSelect={(media) => {setAttributes({images: [...images, ...media]});}}
                    type="image"
                    multiple={true}
                    value={images}
                    render={({open}) => (
                        <Button className="select-images-button is-button is-default is-large" onClick={open}>
                            Bilder hinzufügen
                        </Button>
                    )}
                />
                <RichText
                    tagName="h3"
                    className= "hero__subheadline"
                    placeholder='Hero obere Überschrift'
                    value={subheadline}
                    onChange={ ( value ) => setAttributes( { subheadline: value } ) }
                />
                <RichText
                    tagName="h1"
                    className= "hero__headline"
                    placeholder='Hero Überschrift'
                    value={headline}
                    onChange={ ( value ) => setAttributes( { headline: value } ) }
                />
            </div>

        );
    },
        
    save({attributes}) {
        const { images = [] } = attributes;
        const displayImages = (images) => {
            return (
                images.map( (image,index) => {
                    return (
                        <img
                            className='gallery-item'
                            key={images.id}
                            src={image.url}
                            data-slide-no={index}
                            data-caption={image.caption[0]}
                            alt={image.alt}
                        />
                    )
                })
            )
        }
        return (
            <div>
                <div className="gallery-grid" data-total-slides={images.length}>{ displayImages(images) }</div>
            </div>
        );

    },
});