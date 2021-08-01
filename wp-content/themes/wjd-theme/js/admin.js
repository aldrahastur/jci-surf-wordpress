jQuery(document).ready(function() {
    jQuery(document).on('change','.editor-page-attributes__template #inspector-select-control-1', function(e) {
        if (jQuery(e.target).val() === 'blog-template.php') {
            jQuery('.edit-post-meta-boxes-area').slideDown();
        } else {
            jQuery('.edit-post-meta-boxes-area').slideUp();
        }
    });
    setTimeout(function() {        
        if (jQuery('.editor-page-attributes__template select').val() === 'blog-template.php') {
            jQuery('.edit-post-meta-boxes-area').show();
        } else {
            jQuery('.edit-post-meta-boxes-area').hide();
        }
    }, 1000);
});