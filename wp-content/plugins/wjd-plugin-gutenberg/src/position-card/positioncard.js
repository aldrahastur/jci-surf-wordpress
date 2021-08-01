import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { InspectorControls } = wp.editor; // Import registerBlockType() from wp.blocks
const { SelectControl, PanelBody, PanelRow, CheckboxControl, ColorPalette } = wp.components;
const { Component, Fragment } = wp.element;


class mySelectPosts extends Component {
    // Method for setting the initial state.
    static getInitialState( selectedPost ) {
        return {
            posts: [],
            selectedPost: selectedPost,
            post: {}, 
        };
    }
    // Constructing our component. With super() we are setting everything to 'this'.
    // Now we can access the attributes with this.props.attributes
    constructor() {
        super( ...arguments );
        this.state = this.constructor.getInitialState( this.props.attributes.selectedPost );
        // Bind so we can use 'this' inside the method.
        this.getOptions = this.getOptions.bind(this);
        // Load posts.
        this.getOptions();
        this.onChangeSelectPost = this.onChangeSelectPost.bind(this);
        this.onChangeSelectCardType = this.onChangeSelectCardType.bind(this);
        this.setChecked = this.setChecked.bind(this);
        this.setColor = this.setColor.bind(this);
    }
    getOptions() {
        const CustomPosts = wp.api.collections.Posts.extend( {
            url: wpApiSettings.root + 'wp/v2/positionen',
        });
        const someCustomPosts = new CustomPosts();

        return (someCustomPosts).fetch().then( ( posts ) => {
            if( posts && 0 !== this.state.selectedPost ) {
                // If we have a selected Post, find that post and add it.
                const post = posts.find( ( item ) => { return item.id == this.state.selectedPost } );
                // This is the same as { post: post, posts: posts }
                this.setState( { post, posts } );
            } else {
                this.setState({ posts });
            }
        });
    }
    onChangeSelectPost( value ) {
        // Find the post
        const post = this.state.posts.find( ( item ) => { return item.id == parseInt( value ) } );
        // Set the state
        
        if (post) {
            // Set the attributes
            if(post.featured_media) {
                new wp.api.models.Media({id:post.featured_media}).fetch().then((image) => {
                    if (image.caption) {
                        this.props.setAttributes({
                            selectedImageCaption: image.caption.rendered.replace(/(<([^>]+)>)/ig, '')
                        });
                    }
                    this.props.setAttributes( {
                        selectedImage: image.source_url,
                        selectedPost: parseInt( value ),
                        title: post.title.rendered,
                        content: post.content.rendered.replace( /[\r\n]+/gm, "" ).replace(/(<div class="card__image-credit"([^<]+)<\/div>)/ig, "").replace(/(<([^>]+)>)/ig, '').slice(0,300)+'...',
                        link: post.link
                    });
                    this.setState( { selectedPost: parseInt( value ), post } );
                })
            } else {
                this.props.setAttributes( {
                    selectedPost: parseInt( value ),
                    title: post.title.rendered,
                    content: post.content.rendered.replace( /[\r\n]+/gm, "" ).replace(/(<div class="card__image-credit"([^<]+)<\/div>)/ig, "").replace(/(<([^>]+)>)/ig, '').slice(0,300)+'...',
                    link: post.link
                });
                this.setState( { selectedPost: parseInt( value ), post } );                
            }
        } else {
            this.props.setAttributes( {
                selectedPost: -1
            });
            this.setState( { selectedPost: parseInt( value ), post } );
        }
    }
    onChangeSelectCardType( value ) {
        this.setState( { cardStyle: value } )
        this.props.setAttributes({
            cardStyle: value
        })
    }
    setChecked( value ) {
        this.setState( { isCTA: value })
        this.props.setAttributes({
            isCTA: value
        })
    }
    setColor( value ) {
        this.setState( { cardColor: value })
        this.props.setAttributes({
            cardColor: value
        })
    }

    render() {
        let options = [ { value: 0, label: __( 'Wählen Sie einen Beitrag' ) } ];
        let output  = __( 'Lade Beiträge' );
        this.props.className += ' lade';
        if( this.state.posts.length > 0 ) {
            let loading = '';
            if (this.state.posts.length > 1) {
                loading = __( '%d Beiträge gefunden. Bitte wählen Sie einen.' );
            } else {
                loading = __( '%d Beitrag gefunden. Bitte wählen Sie einen.' );
            }
            output = loading.replace( '%d', this.state.posts.length );
            this.state.posts.forEach((post) => {
                options.push({value:post.id, label:post.title.rendered});
            });
        } else {
            output = __( 'Keine Beiträge vorhanden. Bitte schreiben Sie zuerst einen' );
        }
        // Checking if we have anything in the object
        if( this.state.post ) {
            if (this.state.post.featured_media) {
                this.props.className += ' has-post';
                output = <div 
                            className={ this.props.attributes.cardStyle } 
                            style={ (this.props.attributes.cardColor === '#013493') ? {backgroundColor:this.props.attributes.cardColor, color:'#fff'} : {backgroundColor:this.props.attributes.cardColor} }
                        >
                            <div class="card__image-wrapper">
                                <figure class="figure">
                                    <div class="figure__image-wrapper is-highlighted">
                                        <div class="figure__image">
                                            <img src={ this.props.attributes.selectedImage } />
                                        </div>
                                    </div>
                                </figure>
                                <div class="card__image-credit">
                                    { this.props.attributes.selectedImageCaption }
                                </div>
                            </div>
                            <div class="card__content">
                                <div class="card__main">
                                    <h3 class="card__headline" dangerouslySetInnerHTML={ { __html: this.state.post.title.rendered } }></h3>
                                    <div class="rte-content v-margin-collapse">
                                        <p dangerouslySetInnerHTML={ { __html: this.state.post.content.rendered.replace( /[\r\n]+/gm, "" ).replace(/(<div class="card__image-credit"([^<]+)<\/div>)/ig, "").replace(/(<([^>]+)>)/ig, '').slice(0,460)+'...' } }></p>
                                    </div>
                                </div>
                                { this.props.attributes.isCTA && (
                                    <div class="card__footer">
                                        <a href="#default" ref="cta" class="card__cta is-link" target="_self" style={ (this.props.attributes.cardColor === '#013493') ? {color:'#fff'} : {} }>
                                            Mehr lesen
                                            <i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                ) }
                            </div>
                        </div>;
            } else if (this.state.post.id && !this.state.post.featured_media) {
                this.props.className += ' has-post';
                output = <div 
                            className={ this.props.attributes.cardStyle } 
                            style={ (this.props.attributes.cardColor === '#013493') ? {backgroundColor:this.props.attributes.cardColor, color:'#fff'} : {backgroundColor:this.props.attributes.cardColor} }
                        >
                            <div class="card__content">
                                <div class="card__main">
                                    <h3 class="card__headline" dangerouslySetInnerHTML={ { __html: this.state.post.title.rendered } }></h3>
                                    <div class="rte-content v-margin-collapse">
                                        <p dangerouslySetInnerHTML={ { __html: this.state.post.content.rendered.replace( /[\r\n]+/gm, "" ).replace(/(<div class="card__image-credit"([^<]+)<\/div>)/ig, "").replace(/(<([^>]+)>)/ig, '').slice(0,460)+'...' } }></p>
                                    </div>
                                </div>
                                { this.props.attributes.isCTA && (
                                    <div class="card__footer">
                                        <a href="#default" ref="cta" class="card__cta is-link" target="_self" style={ (this.props.attributes.cardColor === '#013493') ? {color:'#fff'} : {} }>
                                            Mehr lesen
                                            <i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                ) }
                            </div>
                        </div>;
            }
        } else {
            this.props.className += ' no-post';
        }
        return [
            !! this.props.isSelected && ( 
            <Fragment>
                <InspectorControls key='inspector'>
                    <PanelBody title="Beitrag">
                        <PanelRow>
                            <SelectControl 
                                onChange={this.onChangeSelectPost} 
                                value={ this.props.attributes.selectedPost } 
                                label={ __( 'Select a Post' ) } 
                                options={ options } />
                        </PanelRow>
                    </PanelBody>
                    <PanelBody title="Karteneigenschaften">
                        <PanelRow>
                            <SelectControl
                                label="Kartenstil wählen"
                                value={ this.props.attributes.cardStyle }
                                options={ [
                                    { label: 'Standard', value: 'v-card default' },
                                    { label: 'Gespiegelt', value: 'v-card is-mirrored' },
                                    { label: 'Vertikal', value: 'v-card is-vertical' },
                                ] }
                                onChange={ this.onChangeSelectCardType }
                            />
                        </PanelRow>
                        <PanelRow>
                            <CheckboxControl
                                label="Mehr lesen Link"
                                checked={ this.props.attributes.isCTA }
                                onChange={ this.setChecked }
                            />
                        </PanelRow>
                        <PanelRow>
                            <ColorPalette 
                                    colors={ [
                                        { name: 'lightblue', color: '#e5eaf4' },
                                        { name: 'blue', color: '#013493' },
                                    ] }
                                    value={ this.props.attributes.cardColor }
                                    onChange={ this.setColor }
                                />
                        </PanelRow>
                    </PanelBody>
                </InspectorControls>
            </Fragment>
            ), 
            <div className={this.props.className}>{output}</div>
        ]
    }
}

registerBlockType( 'wjd/positioncard', {
    title: __( 'Positions-Karte' ),
    icon: 'editor-table',
    category: 'common',
    keywords: [
        'card',
        'karte',
        'block',
        'beitrag',
        'termin',
        'post'
    ],
    attributes: {
        content: {
            type: 'string',
            selector: 'p',
        },
        title: {
            type: 'string',
            selector: 'h2'
        },
        link: {
            type: 'string',
            selector: 'a'
        },
        selectedPost: {
            type: 'number',
            default: 0,
        },
        selectedImage: {
            type: 'string'
        },
        selectedImageCaption: {
            type: 'string'
        },
        selectedCategory: {
            type: 'string'
        },
        cardStyle: {
            type: 'string',
            default: 'v-card default'
        },
        isCTA: {
            type: 'boolean',
        },
        cardColor: {
            type: 'string',
            default: '#e5eaf4'
        }
    },
    edit: mySelectPosts,
    save: function( props ) {
        return (props);
    },
} );