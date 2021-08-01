<?php
namespace WJD\Shortcodes;

defined('ABSPATH') or die();

class CF7 {

    public function __construct()
    {
        add_shortcode('form_row', array($this, 'wjd_cf7_form_row_shortcode'));
    }

    public function wjd_cf7_form_row_shortcode($atts, $content) {
 
        $atts = shortcode_atts([
            'label' => '',
            'type' => 'text',
            'error-name' => ''
        ], $atts, 'wjd_cf7_form_row_shortcode');
        ob_start();
        ?>
        <div class="webform-flex--container" data-error="<?=$atts['error-name']?>">
            <div class="form-item js-form-type-<?=$atts['type']?>">
                <?php if($atts['label']): ?>
                    <label for="edit-function"><?=$atts['label']?></label>
                <?php endif; ?>
                <?=$content?>
            </div>
        </div>
        <?php 
        $return = ob_get_clean();
        return $return; 
    }
}