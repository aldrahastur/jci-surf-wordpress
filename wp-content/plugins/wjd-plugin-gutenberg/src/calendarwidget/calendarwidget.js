const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { 
    RichText,
} = wp.editor;
const { 
    Icon,
} = wp.components;

const iconEl = () => (
	<Icon
		icon={
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false">
                <path fill="none" d="M0 0h24v24H0V0z"></path>
                <g>
                    <path d="M7 11h2v2H7v-2zm14-5v14c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2l.01-14c0-1.1.88-2 1.99-2h1V2h2v2h8V2h2v2h1c1.1 0 2 .9 2 2zM5 8h14V6H5v2zm14 12V10H5v10h14zm-4-7h2v-2h-2v2zm-4 0h2v-2h-2v2z"></path>
                </g>
            </svg>
		}
	/>
);


registerBlockType( 'wjd/calendarwidget', {
    title: __( 'Events Kalender' ),
    icon: iconEl,
    category: 'common',
    keywords: [
        'kalender',
        'events',
        'event',
        'termin',
        'calendar'
    ],
    attributes: {
        title: {
            type: 'string',
        },
    },
    edit: function( props ) {
        const {
            className,
            attributes: {
                title,
            },
            setAttributes,
        } = props;
        return (
            <div className={ className }>
                <RichText
                    tagName="h3"
                    placeholder={ __( 'Widgetüberschrift' ) }
                    value={ title }
                    onChange={ ( value ) => setAttributes( { title: value } ) }
                />
            </div>
        );
    },
    save: function( props ) {
        return (props);
    },
} );