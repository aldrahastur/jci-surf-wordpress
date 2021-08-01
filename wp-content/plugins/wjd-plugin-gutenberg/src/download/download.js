import './editor.scss';
import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
    MediaUpload,
    RichText,
    MediaUploadCheck
} = wp.editor;
const {
    Fragment,
} = wp.element;
const {
    Button
} = wp.components;



registerBlockType( 'wjd/download', {
    title: __( 'Download' ),
    icon: 'download',
    category: 'common',
    keywords: [
        'download',
        'datei',
        'herunterladen',
        'laden'
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
        mediaType: {
            type: 'string'
        },
        downloadText: {
            type: 'string'
        }
    },
    edit: function( props ) {
        const {
            className,
            attributes: {
                mediaID,
                mediaURL,
                mediaType,
                downloadText
            },
            setAttributes,
        } = props;
        return (
            <div className={ className }>
                <Fragment>
                    <MediaUploadCheck>
                        <MediaUpload
                            onSelect={ ( image ) =>
                                {
                                    console.log(image);
                                    if (image.type == 'image') {
                                        setAttributes( {
                                            mediaID: image.id,
                                            mediaURL: image.url,
                                            mediaType: image.type
                                        })
                                    } else {
                                        setAttributes({
                                            mediaID: image.id,
                                            mediaURL: window.location.origin + '/wp-content/plugins/wjd-guten-blocks/src/download/file.svg',
                                            mediaType: image.type
                                        })
                                    }
                                }
                            }                            
                            type="image"
                            value={ mediaID }
                            render={ ( { open } ) => (
                                <Button className={ mediaID ? 'image-button' : 'button button-large' } onClick={ open }>
                                    { ! mediaID ? __( 'Datei wählen' ) : <img className={ mediaType } src={ mediaURL } alt={ __( 'Datei wählen' ) } data-media-id={ mediaID } /> }
                                </Button>
                            ) }
                        />
                    </MediaUploadCheck>
                    <RichText
                        tagName="p"
                        placeholder={ 'Downloadtext' }
                        value={downloadText}
                        onChange={ ( value ) => setAttributes( { downloadText: value } ) }
                    />
                </Fragment>
            </div>
        );
    },
    save: function( props ) {
        return (props);
    },
} );