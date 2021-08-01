wp.domReady(() => {
    wp.blocks.unregisterBlockStyle('core/image', 'circle-mask');

    jQuery(document).click('.wp-block-gallery, .components-button.components-panel__body-toggle', (e) => {
        if (wp.data.select('core/editor').getSelectedBlock() && wp.data.select('core/editor').getSelectedBlock().name === 'core/gallery') {
            jQuery('.components-button.components-panel__body-toggle').each((k,v)=> {
                v = jQuery(v);
                if (v.text() == 'Galerie-Einstellungen') {
                    v.closest('.components-panel__body').find('.components-range-control').addClass('hidden');
                    v.closest('.components-panel__body').find('.components-toggle-control .components-toggle-control__label').text('Teasergalerie');
                    v.closest('.components-panel__body').find('.components-toggle-control .components-base-control__help').text('Nur die ersten sieben Bilder werden in der Vorschau dargestellt');
                }
            })
        }
    });
})
