import './editor.scss';
import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { 
    RichText,
    InnerBlocks,
    BlockControls,
    AlignmentToolbar,
    InspectorControls
} = wp.editor;
const { 
    Icon,    
    SelectControl,
    PanelBody,
    PanelRow,
} = wp.components;

const iconEl = () => (
	<Icon
		icon={
			<svg width="24" height="24" role="img" aria-hidden="true" focusable="false">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9,8a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1v4a1,1,0,0,1-1,1h-1v3a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1v-4a1,1,0,0,1,1-1h1V8zm2,3h4V9h-4v2zm2,2H9v2h4v-2z"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2,4.732A2,2,0,1,1,4.732,2h14.536A2,2,0,1,1,22,4.732v14.536A2,2,0,1,1,19.268,22H4.732A2,2,0,1,1,2,19.268V4.732zM4.732,4h14.536c.175.304.428.557.732.732v14.536a2.01,2.01,0,0,0-.732.732H4.732A2.01,2.01,0,0,0,4,19.268V4.732A2.01,2.01,0,0,0,4.732,4z"></path>
            </svg>
		}
	/>
);


registerBlockType( 'wjd/group', {
    title: __( 'Sektion' ),
    icon: iconEl,
    category: 'common',
    keywords: [
        'sektion',
        'gruppe',
        'abschnitt',
        'container'
    ],
    attributes: {
        title: {
            type: 'string',
        },        
        alignment: {
            type: 'string',
            default: 'center',
        },
        sectionType: {
            type: 'string',
            default: 'default',
        },
    },
    edit: function( props ) {
        const {
            className,
            attributes: {
                title,
                alignment,
                sectionType
            },
            setAttributes,
        } = props;
        const onChangeAlignment = ( newAlignment ) => {
            props.setAttributes( { alignment: newAlignment === undefined ? 'none' : newAlignment } );
        };
        return (
            <div className={ className }>     
                <InspectorControls>
                    <PanelBody title="Style">
                        <PanelRow>
                            <SelectControl
                                help="Darstellung Sektion"
                                selected={ sectionType }
                                options={ [
                                    { label: 'Standard', value: 'default' },
                                    { label: 'Fullwidth / Funky', value: 'funky' },
                                ] }
                                onChange={ ( value ) => { setAttributes( { sectionType: value } ) } }
                            />
                        </PanelRow>
                    </PanelBody>
                </InspectorControls>  
                <BlockControls>
                    <AlignmentToolbar
                        value={ alignment }
                        onChange={ onChangeAlignment }
                    />
                </BlockControls>            
                <RichText
                    tagName="h3"
                    style={ { textAlign: alignment } }
                    placeholder={ __( 'Sektionsüberschrift' ) }
                    value={ title }
                    onChange={ ( value ) => setAttributes( { title: value } ) }
                />
                <InnerBlocks/>
            </div>
        );
    },
    save: function( props ) {
        return (
            <div>
                <InnerBlocks.Content />
            </div>
        );
    },
} );