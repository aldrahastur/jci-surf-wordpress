function addCoverAttribute(settings, name) {
    if (typeof settings.attributes !== 'undefined') {
        if (name == 'wjd/hero') {
            settings.attributes = Object.assign(settings.attributes, {
                useSlider: {
                    type: 'boolean'
                }
            });
        }
    }

    return settings;
}

wp.hooks.addFilter('blocks.registerBlockType', 'awp/cover-custom-attribute', addCoverAttribute);
const coverAdvancedControls = wp.compose.createHigherOrderComponent(BlockEdit => {
    return props => {
        const {
            Fragment
        } = wp.element;
        const {
            ToggleControl
        } = wp.components;
        const {
            InspectorAdvancedControls
        } = wp.blockEditor;
        const {
            attributes,
            setAttributes,
            isSelected
        } = props;
        return /*#__PURE__*/React.createElement(Fragment, null, /*#__PURE__*/React.createElement(BlockEdit, props), isSelected && props.name == 'wjd/hero' && /*#__PURE__*/React.createElement(InspectorAdvancedControls, null, /*#__PURE__*/React.createElement(ToggleControl, {
            label: wp.i18n.__('Slider verwenden?', 'awp'),
            checked: !!attributes.useSlider,
            onChange: newval => setAttributes({
                useSlider: !attributes.useSlider
            })
        })));
    };
}, 'coverAdvancedControls');
wp.hooks.addFilter('editor.BlockEdit', 'awp/cover-advanced-control', coverAdvancedControls);